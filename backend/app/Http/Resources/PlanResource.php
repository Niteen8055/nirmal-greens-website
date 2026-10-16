<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Src\Catalog\Domain\Plan\Plan;

class PlanResource extends JsonResource
{
    /**
     * @param  Request  $request
     * @return array<string, mixed>
     */
    public function toArray($request): array
    {
        /** @var Plan $this->resource */
        return [
            'code' => $this->resource->code(),
            'name' => $this->resource->name(),
            'weight_g' => $this->resource->weightG(),
            'price_paise' => $this->resource->pricePaise(),
            'trays_per_cycle' => $this->resource->traysPerCycle(),
            'rules' => $this->resource->rules(),
            'razorpay_plan_id' => $this->resource->razorpayPlanId(),
            'is_active' => $this->resource->isActive(),
        ];
    }
}
