<?php

declare(strict_types=1);

namespace Tests\Feature\Api\V1\Catalog;

use Illuminate\Foundation\Testing\LazilyRefreshDatabase;
use Src\Catalog\Infrastructure\Persistence\Eloquent\PlanModel;
use Src\Catalog\Infrastructure\Persistence\Eloquent\VarietyModel;
use Tests\TestCase;

class CatalogEndpointTest extends TestCase
{
    use LazilyRefreshDatabase;

    public function test_it_returns_active_plans_and_varieties_with_the_expected_fields(): void
    {
        PlanModel::create([
            'code' => 'basics',
            'name' => 'Nirmal Basics',
            'weight_g' => 50,
            'price_paise' => 149900,
            'trays_per_cycle' => 4,
            'rules' => [],
            'razorpay_plan_id' => null,
            'is_active' => true,
        ]);
        VarietyModel::create([
            'slug' => 'broccoli',
            'name' => 'Broccoli',
            'latin' => null,
            'grow_days' => 10,
            'yield_min_g' => null,
            'yield_max_g' => null,
            'tag' => null,
            'is_active' => true,
            'content' => [],
        ]);

        $response = $this->get('/api/v1/catalog');

        $response->assertOk();
        $response->assertJsonStructure([
            'status',
            'data' => [
                'plans' => [
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
                'varieties' => [
                    '*' => [
                        'slug',
                        'name',
                        'latin',
                        'grow_days',
                        'yield_min_g',
                        'yield_max_g',
                        'tag',
                        'is_active',
                        'content',
                    ],
                ],
            ],
        ]);
        $response->assertJson([
            'status' => 'ok',
            'data' => [
                'plans' => [
                    [
                        'code' => 'basics',
                        'name' => 'Nirmal Basics',
                        'weight_g' => 50,
                        'price_paise' => 149900,
                        'trays_per_cycle' => 4,
                        'rules' => [],
                        'razorpay_plan_id' => null,
                        'is_active' => true,
                    ],
                ],
                'varieties' => [
                    [
                        'slug' => 'broccoli',
                        'name' => 'Broccoli',
                        'latin' => null,
                        'grow_days' => 10,
                        'yield_min_g' => null,
                        'yield_max_g' => null,
                        'tag' => null,
                        'is_active' => true,
                        'content' => [],
                    ],
                ],
            ],
        ]);
    }

    public function test_it_excludes_inactive_plans_and_varieties(): void
    {
        PlanModel::create([
            'code' => 'inactive-plan',
            'name' => 'Inactive Plan',
            'weight_g' => 50,
            'price_paise' => 149900,
            'trays_per_cycle' => 4,
            'rules' => [],
            'razorpay_plan_id' => null,
            'is_active' => false,
        ]);
        VarietyModel::create([
            'slug' => 'inactive-variety',
            'name' => 'Inactive Variety',
            'grow_days' => 10,
            'is_active' => false,
        ]);

        $response = $this->get('/api/v1/catalog');

        $response->assertOk();
        $response->assertJson([
            'status' => 'ok',
            'data' => [
                'plans' => [],
                'varieties' => [],
            ],
        ]);
    }

    public function test_it_returns_empty_collections_when_no_active_catalog_items_exist(): void
    {
        $response = $this->get('/api/v1/catalog');

        $response->assertOk();
        $response->assertJson([
            'status' => 'ok',
            'data' => [
                'plans' => [],
                'varieties' => [],
            ],
        ]);
    }

    public function test_existing_plan_and_variety_endpoints_remain_available(): void
    {
        $this->get('/api/v1/catalog/plans')->assertOk();
        $this->get('/api/v1/catalog/varieties')->assertOk();
    }
}
