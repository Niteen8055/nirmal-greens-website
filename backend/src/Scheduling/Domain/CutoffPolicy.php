<?php

declare(strict_types=1);

namespace Src\Scheduling\Domain;

use DateTimeImmutable;
use DateTimeZone;

final class CutoffPolicy
{
    private const TIMEZONE = 'Asia/Kolkata';

    public function lockAt(DateTimeImmutable $deliveryDate): DateTimeImmutable
    {
        return $deliveryDate
            ->setTimezone(new DateTimeZone(self::TIMEZONE))
            ->modify('-2 days')
            ->setTime(21, 0);
    }
}
