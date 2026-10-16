<?php

declare(strict_types=1);

namespace Src\Scheduling\Domain;

use DateTimeImmutable;
use Src\Catalog\Domain\Variety\Variety;

final class Delivery
{
    public function __construct(
        private readonly DateTimeImmutable $deliveryDate,
        private readonly Variety $variety,
        private readonly DateTimeImmutable $sowDate,
        private readonly DateTimeImmutable $lockAt,
    ) {}

    public function deliveryDate(): DateTimeImmutable
    {
        return $this->deliveryDate;
    }

    public function variety(): Variety
    {
        return $this->variety;
    }

    public function sowDate(): DateTimeImmutable
    {
        return $this->sowDate;
    }

    public function lockAt(): DateTimeImmutable
    {
        return $this->lockAt;
    }
}
