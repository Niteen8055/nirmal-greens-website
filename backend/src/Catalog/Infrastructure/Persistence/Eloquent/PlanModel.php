<?php

declare(strict_types=1);

namespace Src\Catalog\Infrastructure\Persistence\Eloquent;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;

#[Fillable([
    'code',
    'name',
    'weight_g',
    'price_paise',
    'trays_per_cycle',
    'rules',
    'razorpay_plan_id',
    'is_active',
])]
class PlanModel extends Model
{
    protected $table = 'plans';

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'weight_g' => 'integer',
            'price_paise' => 'integer',
            'trays_per_cycle' => 'integer',
            'rules' => 'array',
            'is_active' => 'boolean',
        ];
    }
}
