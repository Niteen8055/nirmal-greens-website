<?php

declare(strict_types=1);

namespace Tests\Feature\Api\V1\Catalog;

use Illuminate\Foundation\Testing\LazilyRefreshDatabase;
use Src\Catalog\Infrastructure\Persistence\Eloquent\VarietyModel;
use Tests\TestCase;

class VarietiesEndpointTest extends TestCase
{
    use LazilyRefreshDatabase;

    public function test_it_returns_active_varieties_as_json(): void
    {
        VarietyModel::create([
            'slug' => 'broccoli',
            'name' => 'Broccoli',
            'grow_days' => 10,
            'is_active' => true,
            'content' => [],
        ]);

        VarietyModel::create([
            'slug' => 'sunflower',
            'name' => 'Sunflower',
            'grow_days' => 12,
            'is_active' => false,
            'content' => [],
        ]);

        $response = $this->get('/api/v1/catalog/varieties');

        $response->assertOk();
        $response->assertJsonStructure([
            'status',
            'data' => [
                '*' => [
                    'slug', 'name', 'latin', 'grow_days',
                    'yield_min_g', 'yield_max_g', 'tag',
                    'is_active', 'content',
                ],
            ],
        ]);
        $response->assertJson([
            'status' => 'ok',
            'data' => [
                [
                    'slug' => 'broccoli',
                    'name' => 'Broccoli',
                    'latin' => null,
                    'grow_days' => 10,
                    'is_active' => true,
                    'content' => [],
                ],
            ],
        ]);
    }

    public function test_it_excludes_inactive_varieties(): void
    {
        VarietyModel::create([
            'slug' => 'fenugreek',
            'name' => 'Fenugreek',
            'grow_days' => 8,
            'is_active' => false,
            'content' => [],
        ]);

        $response = $this->get('/api/v1/catalog/varieties');

        $response->assertOk();
        $response->assertJson([
            'status' => 'ok',
            'data' => [],
        ]);
    }

    public function test_it_returns_all_mapped_fields(): void
    {
        VarietyModel::create([
            'slug' => 'radish',
            'name' => 'Radish',
            'latin' => 'Raphanus sativus',
            'grow_days' => 8,
            'yield_min_g' => 20,
            'yield_max_g' => 30,
            'tag' => 'spicy',
            'is_active' => true,
            'content' => ['timeline' => '8 days', 'health' => 'anti-inflammatory'],
        ]);

        $response = $this->get('/api/v1/catalog/varieties');

        $response->assertOk();
        $response->assertJson([
            'status' => 'ok',
            'data' => [
                [
                    'slug' => 'radish',
                    'name' => 'Radish',
                    'latin' => 'Raphanus sativus',
                    'grow_days' => 8,
                    'yield_min_g' => 20,
                    'yield_max_g' => 30,
                    'tag' => 'spicy',
                    'is_active' => true,
                    'content' => ['timeline' => '8 days', 'health' => 'anti-inflammatory'],
                ],
            ],
        ]);
    }
}
