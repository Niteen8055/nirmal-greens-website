<?php

declare(strict_types=1);

namespace Src\Catalog\Domain\Variety;

interface VarietyRepository
{
    public function findBySlug(string $slug): ?Variety;

    /**
     * @return Variety[]
     */
    public function findAllActive(): array;

    public function save(Variety $variety): void;
}
