<?php

declare(strict_types=1);

namespace Tests\Unit\Scheduling\Domain;

use DateTimeImmutable;
use DateTimeZone;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;
use Src\Scheduling\Domain\EarliestStartPolicy;

final class EarliestStartPolicyTest extends TestCase
{
    public function test_it_rejects_sowing_before_the_day_after_the_reference_date_in_ist(): void
    {
        $this->expectException(InvalidArgumentException::class);

        (new EarliestStartPolicy)->assertSowingDateIsAllowed(
            sowDate: $this->date('2026-10-14 23:59:00'),
            referenceDateTime: $this->date('2026-10-14 12:00:00'),
        );
    }

    private function date(string $value): DateTimeImmutable
    {
        return new DateTimeImmutable($value, new DateTimeZone('Asia/Kolkata'));
    }
}
