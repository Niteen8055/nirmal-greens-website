<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;
use Src\Catalog\Infrastructure\Persistence\Eloquent\PlanModel;

class PlanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $plans = [
            [
                'code' => 'nirmal-basics',
                'name' => 'Nirmal Basics',
                'weight_g' => 50,
                'price_paise' => 149900,
                'trays_per_cycle' => 4,
                'rules' => [],
                'razorpay_plan_id' => null,
                'is_active' => true,
            ],
            [
                'code' => 'nirmal-health',
                'name' => 'Nirmal Health',
                'weight_g' => 100,
                'price_paise' => 249900,
                'trays_per_cycle' => 4,
                'rules' => [],
                'razorpay_plan_id' => null,
                'is_active' => true,
            ],
            [
                'code' => 'nirmal-personalized',
                'name' => 'Nirmal Personalized',
                'weight_g' => 200,
                'price_paise' => 349900,
                'trays_per_cycle' => 4,
                'rules' => [],
                'razorpay_plan_id' => null,
                'is_active' => true,
            ],
        ];

        foreach ($plans as $plan) {
            $model = PlanModel::firstOrNew(
                ['code' => $plan['code']],
                $plan,
            );

            $model->fill(Arr::only($plan, [
                'name',
                'weight_g',
                'price_paise',
                'trays_per_cycle',
            ]));

            $model->save();
        }
    }
}
