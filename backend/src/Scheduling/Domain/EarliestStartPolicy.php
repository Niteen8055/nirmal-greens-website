<?php

declare(strict_types=1);

namespace Src\Scheduling\Domain;

use DateTimeImmutable;
use DateTimeZone;
use InvalidArgumentException;

final class EarliestStartPolicy
{
    private const TIMEZONE = 'Asia/Kolkata';

    public function assertSowingDateIsAllowed(
        DateTimeImmutable $sowDate,
        DateTimeImmutable $referenceDateTime,
    ): void {
        $timezone = new DateTimeZone(self::TIMEZONE);
        $sowingDate = $sowDate->setTimezone($timezone)->setTime(0, 0);
        $earliestSowingDate = $referenceDateTime
            ->setTimezone($timezone)
            ->setTime(0, 0)
            ->modify('+1 day');

        if ($sowingDate < $earliestSowingDate) {
            throw new InvalidArgumentException(
                'Sowing date must be at least tomorrow in Asia/Kolkata.'
            );
        }
    }
}
