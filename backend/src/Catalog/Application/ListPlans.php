<?php

declare(strict_types=1);

namespace Src\Catalog\Application;

use Src\Catalog\Domain\Plan\Plan;
use Src\Catalog\Domain\Plan\PlanRepository;

class ListPlans
{
    public function __construct(
        private PlanRepository $repository,
    ) {}

    /**
     * @return Plan[]
     */
    public function __invoke(): array
    {
        return $this->repository->findAllActive();
    }
}
