<?php

declare(strict_types=1);

namespace Src\Catalog\Application;

use Src\Catalog\Domain\Variety\Variety;
use Src\Catalog\Domain\Variety\VarietyRepository;

class ListVarieties
{
    public function __construct(
        private VarietyRepository $repository,
    ) {}

    /**
     * @return Variety[]
     */
    public function __invoke(): array
    {
        return $this->repository->findAllActive();
    }
}
