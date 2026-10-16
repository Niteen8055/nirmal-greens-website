<?php

declare(strict_types=1);

namespace Tests\Feature\Api\V1\Catalog;

use Illuminate\Foundation\Testing\LazilyRefreshDatabase;
use Src\Catalog\Infrastructure\Persistence\Eloquent\PlanModel;
use Tests\TestCase;

class PlansEndpointTest extends TestCase
{
    use LazilyRefreshDatabase;

    public function test_it_returns_active_plans_with_the_expected_json_fields(): void
    {
        PlanModel::create([
            'code' => 'test-plan',
            'name' => 'Test Plan',
            'weight_g' => 50,
            'price_paise' => 149900,
            'trays_per_cycle' => 4,
            'rules' => [],
            'razorpay_plan_id' => null,
            'is_active' => true,
        ]);

        $response = $this->get('/api/v1/catalog/plans');

        $response->assertOk();
        $response->assertJsonStructure([
            'status',
            'data' => [
                '*' => [
                    'code',
                    'name',
                    'weight_g',
                    'price_paise',
                    'trays_per_cycle',
                    'rules',
                    'razorpay_plan_id',
                    'is_active',
                ],
            ],
        ]);
        $response->assertJson([
            'status' => 'ok',
            'data' => [
                [
                    'code' => 'test-plan',
                    'name' => 'Test Plan',
                    'weight_g' => 50,
                    'price_paise' => 149900,
                    'trays_per_cycle' => 4,
                    'rules' => [],
                    'razorpay_plan_id' => null,
                    'is_active' => true,
                ],
            ],
        ]);
    }

    public function test_it_excludes_inactive_plans(): void
    {
        PlanModel::create([
            'code' => 'inactive-test-plan',
            'name' => 'Inactive Test Plan',
            'weight_g' => 50,
            'price_paise' => 149900,
            'trays_per_cycle' => 4,
            'rules' => [],
            'razorpay_plan_id' => null,
            'is_active' => false,
        ]);

        $response = $this->get('/api/v1/catalog/plans');

        $response->assertOk();
        $response->assertJson([
            'status' => 'ok',
            'data' => [],
        ]);
    }
}
