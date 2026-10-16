<?php

declare(strict_types=1);

namespace Tests\Unit\Scheduling\Domain;

use DateTimeImmutable;
use DateTimeZone;
use PHPUnit\Framework\TestCase;
use Src\Scheduling\Domain\CutoffPolicy;

final class CutoffPolicyTest extends TestCase
{
    public function test_it_locks_two_days_before_delivery_at_nine_pm_ist(): void
    {
        $deliveryDate = new DateTimeImmutable(
            '2026-11-02 00:00:00',
            new DateTimeZone('Asia/Kolkata'),
        );

        $lockAt = (new CutoffPolicy)->lockAt($deliveryDate);

        $this->assertSame('2026-10-31 21:00:00', $lockAt->format('Y-m-d H:i:s'));
        $this->assertSame('Asia/Kolkata', $lockAt->getTimezone()->getName());
    }
}
