<?php

declare(strict_types=1);

namespace Tests\Unit\Scheduling\Domain;

use DateTimeImmutable;
use DateTimeZone;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;
use Src\Catalog\Domain\Plan\Plan;
use Src\Catalog\Domain\Variety\Variety;
use Src\Scheduling\Domain\CutoffPolicy;
use Src\Scheduling\Domain\Delivery;
use Src\Scheduling\Domain\EarliestStartPolicy;
use Src\Scheduling\Domain\ScheduleBuilder;

final class ScheduleBuilderTest extends TestCase
{
    public function test_it_builds_weekly_deliveries_with_sow_dates_and_ist_cutoffs(): void
    {
        $varieties = [
            $this->variety('broccoli', 10),
            $this->variety('radish', 8),
            $this->variety('mustard', 9),
            $this->variety('sunflower', 12),
        ];
        $builder = $this->builder();

        $deliveries = $builder->build(
            plan: $this->plan(),
            varieties: $varieties,
            startDate: $this->date('2026-11-02 00:00:00'),
            referenceDateTime: $this->date('2026-10-22 23:59:00'),
        );

        $this->assertCount(4, $deliveries);

        foreach ($deliveries as $sequence => $delivery) {
            $this->assertInstanceOf(Delivery::class, $delivery);
            $this->assertSame($varieties[$sequence], $delivery->variety());
            $this->assertSame(
                (new DateTimeImmutable('2026-11-02', $this->timezone()))
                    ->modify(sprintf('+%d weeks', $sequence))
                    ->format('Y-m-d'),
                $delivery->deliveryDate()->format('Y-m-d'),
            );
            $this->assertSame('Asia/Kolkata', $delivery->deliveryDate()->getTimezone()->getName());
            $this->assertSame('21:00:00', $delivery->lockAt()->format('H:i:s'));
            $this->assertSame('Asia/Kolkata', $delivery->lockAt()->getTimezone()->getName());
        }

        $this->assertSame('2026-10-23', $deliveries[0]->sowDate()->format('Y-m-d'));
        $this->assertSame('2026-11-01', $deliveries[1]->sowDate()->format('Y-m-d'));
        $this->assertSame('2026-11-07', $deliveries[2]->sowDate()->format('Y-m-d'));
        $this->assertSame('2026-11-11', $deliveries[3]->sowDate()->format('Y-m-d'));
        $this->assertSame('2026-10-31', $deliveries[0]->lockAt()->format('Y-m-d'));
        $this->assertSame('2026-11-07', $deliveries[1]->lockAt()->format('Y-m-d'));
        $this->assertSame('2026-11-14', $deliveries[2]->lockAt()->format('Y-m-d'));
        $this->assertSame('2026-11-21', $deliveries[3]->lockAt()->format('Y-m-d'));
    }

    public function test_it_rejects_a_start_date_that_is_not_monday_in_ist(): void
    {
        $this->expectException(InvalidArgumentException::class);

        $this->builder()->build(
            plan: $this->plan(),
            varieties: $this->fourVarieties(),
            startDate: $this->date('2026-11-03 00:00:00'),
            referenceDateTime: $this->date('2026-10-14 12:00:00'),
        );
    }

    public function test_it_rejects_a_variety_count_that_does_not_match_the_plan(): void
    {
        $this->expectException(InvalidArgumentException::class);

        $this->builder()->build(
            plan: $this->plan(),
            varieties: [
                $this->variety('broccoli', 10),
                $this->variety('radish', 8),
                $this->variety('mustard', 9),
            ],
            startDate: $this->date('2026-11-02 00:00:00'),
            referenceDateTime: $this->date('2026-10-14 12:00:00'),
        );
    }

    public function test_it_rejects_a_schedule_with_sowing_before_tomorrow(): void
    {
        $this->expectException(InvalidArgumentException::class);

        $this->builder()->build(
            plan: $this->plan(),
            varieties: [
                $this->variety('sunflower', 12),
                $this->variety('broccoli', 10),
                $this->variety('radish', 8),
                $this->variety('mustard', 9),
            ],
            startDate: $this->date('2026-10-19 00:00:00'),
            referenceDateTime: $this->date('2026-10-14 12:00:00'),
        );
    }

    private function builder(): ScheduleBuilder
    {
        return new ScheduleBuilder(
            earliestStartPolicy: new EarliestStartPolicy,
            cutoffPolicy: new CutoffPolicy,
        );
    }

    private function plan(): Plan
    {
        return new Plan(
            code: 'test-plan',
            name: 'Test Plan',
            weightG: 50,
            pricePaise: 149900,
            traysPerCycle: 4,
            rules: [],
        );
    }

    /**
     * @return list<Variety>
     */
    private function fourVarieties(): array
    {
        return [
            $this->variety('broccoli', 10),
            $this->variety('radish', 8),
            $this->variety('mustard', 9),
            $this->variety('sunflower', 12),
        ];
    }

    private function variety(string $slug, int $growDays): Variety
    {
        return new Variety(
            slug: $slug,
            name: ucfirst($slug),
            growDays: $growDays,
        );
    }

    private function date(string $value): DateTimeImmutable
    {
        return new DateTimeImmutable($value, $this->timezone());
    }

    private function timezone(): DateTimeZone
    {
        return new DateTimeZone('Asia/Kolkata');
    }
}
