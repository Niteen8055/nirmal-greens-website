<?php

declare(strict_types=1);

namespace Src\Catalog\Infrastructure\Persistence\Eloquent;

use Src\Catalog\Domain\Plan\Plan;
use Src\Catalog\Domain\Plan\PlanRepository;

class EloquentPlanRepository implements PlanRepository
{
    public function findByCode(string $code): ?Plan
    {
        $model = PlanModel::where('code', $code)->first();

        if ($model === null) {
            return null;
        }

        return $this->toDomain($model);
    }

    /**
     * @return Plan[]
     */
    public function findAllActive(): array
    {
        return PlanModel::where('is_active', true)
            ->get()
            ->map(fn (PlanModel $model) => $this->toDomain($model))
            ->all();
    }

    public function save(Plan $plan): void
    {
        PlanModel::updateOrCreate(
            ['code' => $plan->code()],
            [
                'name' => $plan->name(),
                'weight_g' => $plan->weightG(),
                'price_paise' => $plan->pricePaise(),
                'trays_per_cycle' => $plan->traysPerCycle(),
                'rules' => $plan->rules(),
                'razorpay_plan_id' => $plan->razorpayPlanId(),
                'is_active' => $plan->isActive(),
            ],
        );
    }

    private function toDomain(PlanModel $model): Plan
    {
        return new Plan(
            code: $model->code,
            name: $model->name,
            weightG: $model->weight_g,
            pricePaise: $model->price_paise,
            traysPerCycle: $model->trays_per_cycle,
            rules: $model->rules,
            razorpayPlanId: $model->razorpay_plan_id,
            isActive: $model->is_active,
        );
    }
}
