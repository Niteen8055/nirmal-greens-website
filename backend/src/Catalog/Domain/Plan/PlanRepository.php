<?php

declare(strict_types=1);

namespace Src\Catalog\Domain\Plan;

interface PlanRepository
{
    public function findByCode(string $code): ?Plan;

    /**
     * @return Plan[]
     */
    public function findAllActive(): array;

    public function save(Plan $plan): void;
}
