<?php

namespace Src\Catalog\Infrastructure\Persistence\Eloquent;

use Src\Catalog\Domain\Variety\Variety;
use Src\Catalog\Domain\Variety\VarietyRepository;

class EloquentVarietyRepository implements VarietyRepository
{
    public function findBySlug(string $slug): ?Variety
    {
        $model = VarietyModel::where('slug', $slug)->first();

        if ($model === null) {
            return null;
        }

        return $this->toDomain($model);
    }

    /**
     * @return Variety[]
     */
    public function findAllActive(): array
    {
        return VarietyModel::where('is_active', true)
            ->get()
            ->map(fn (VarietyModel $model) => $this->toDomain($model))
            ->all();
    }

    public function save(Variety $variety): void
    {
        VarietyModel::updateOrCreate(
            ['slug' => $variety->slug()],
            [
                'name' => $variety->name(),
                'latin' => $variety->latin(),
                'grow_days' => $variety->growDays(),
                'yield_min_g' => $variety->yieldMinG(),
                'yield_max_g' => $variety->yieldMaxG(),
                'tag' => $variety->tag(),
                'is_active' => $variety->isActive(),
                'content' => $variety->content(),
            ],
        );
    }

    private function toDomain(VarietyModel $model): Variety
    {
        return new Variety(
            slug: $model->slug,
            name: $model->name,
            growDays: $model->grow_days,
            latin: $model->latin,
            yieldMinG: $model->yield_min_g,
            yieldMaxG: $model->yield_max_g,
            tag: $model->tag,
            isActive: $model->is_active,
            content: $model->content ?? [],
        );
    }
}
