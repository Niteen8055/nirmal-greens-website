<?php

declare(strict_types=1);

namespace Src\Scheduling\Domain;

use DateTimeImmutable;
use DateTimeZone;
use InvalidArgumentException;
use Src\Catalog\Domain\Plan\Plan;
use Src\Catalog\Domain\Variety\Variety;

final class ScheduleBuilder
{
    private const TIMEZONE = 'Asia/Kolkata';

    public function __construct(
        private readonly EarliestStartPolicy $earliestStartPolicy,
        private readonly CutoffPolicy $cutoffPolicy,
    ) {}

    /**
     * @param  list<Variety>  $varieties
     * @return list<Delivery>
     */
    public function build(
        Plan $plan,
        array $varieties,
        DateTimeImmutable $startDate,
        DateTimeImmutable $referenceDateTime,
    ): array {
        $timezone = new DateTimeZone(self::TIMEZONE);
        $localStartDate = $startDate->setTimezone($timezone)->setTime(0, 0);

        if ($localStartDate->format('N') !== '1') {
            throw new InvalidArgumentException(
                'Schedule start date must be a Monday in Asia/Kolkata.'
            );
        }

        if (count($varieties) !== $plan->traysPerCycle()) {
            throw new InvalidArgumentException(
                'Selected variety count must match the plan trays per cycle.'
            );
        }

        $deliveries = [];

        foreach (array_values($varieties) as $sequence => $variety) {
            $deliveryDate = $localStartDate->modify(sprintf('+%d weeks', $sequence));
            $sowDate = $deliveryDate->modify(sprintf('-%d days', $variety->growDays()));

            $this->earliestStartPolicy->assertSowingDateIsAllowed(
                $sowDate,
                $referenceDateTime,
            );

            $deliveries[] = new Delivery(
                deliveryDate: $deliveryDate,
                variety: $variety,
                sowDate: $sowDate,
                lockAt: $this->cutoffPolicy->lockAt($deliveryDate),
            );
        }

        return $deliveries;
    }
}
