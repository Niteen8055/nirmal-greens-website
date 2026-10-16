<?php

declare(strict_types=1);

namespace Tests\Feature\Catalog\Infrastructure;

use Illuminate\Foundation\Testing\LazilyRefreshDatabase;
use Src\Catalog\Domain\Variety\Variety;
use Src\Catalog\Infrastructure\Persistence\Eloquent\EloquentVarietyRepository;
use Src\Catalog\Infrastructure\Persistence\Eloquent\VarietyModel;
use Tests\TestCase;

final class EloquentVarietyRepositoryTest extends TestCase
{
    use LazilyRefreshDatabase;

    private EloquentVarietyRepository $repository;

    protected function setUp(): void
    {
        parent::setUp();
        $this->repository = new EloquentVarietyRepository;
    }

    public function test_it_returns_a_variety_for_an_existing_slug(): void
    {
        VarietyModel::create([
            'slug' => 'broccoli',
            'name' => 'Broccoli',
            'latin' => 'Brassica oleracea',
            'grow_days' => 10,
            'yield_min_g' => 25,
            'yield_max_g' => 35,
            'tag' => 'rich-in-protein',
            'is_active' => true,
            'content' => ['timeline' => '10 days to harvest'],
        ]);

        $variety = $this->repository->findBySlug('broccoli');

        $this->assertInstanceOf(Variety::class, $variety);
        $this->assertSame('broccoli', $variety->slug());
        $this->assertSame('Broccoli', $variety->name());
        $this->assertSame('Brassica oleracea', $variety->latin());
        $this->assertSame(10, $variety->growDays());
        $this->assertSame(25, $variety->yieldMinG());
        $this->assertSame(35, $variety->yieldMaxG());
        $this->assertSame('rich-in-protein', $variety->tag());
        $this->assertTrue($variety->isActive());
        $this->assertSame(['timeline' => '10 days to harvest'], $variety->content());
    }

    public function test_it_returns_null_when_no_variety_matches_the_slug(): void
    {
        $this->assertNull($this->repository->findBySlug('nonexistent'));
    }

    public function test_it_lists_only_active_varieties(): void
    {
        VarietyModel::create([
            'slug' => 'broccoli',
            'name' => 'Broccoli',
            'grow_days' => 10,
            'is_active' => true,
        ]);

        VarietyModel::create([
            'slug' => 'sunflower',
            'name' => 'Sunflower',
            'grow_days' => 12,
            'is_active' => false,
        ]);

        $result = $this->repository->findAllActive();

        $this->assertIsArray($result);
        $this->assertCount(1, $result);
        $this->assertInstanceOf(Variety::class, $result[0]);
        $this->assertSame('broccoli', $result[0]->slug());
    }

    public function test_it_persists_a_new_variety(): void
    {
        $variety = new Variety(
            slug: 'radish',
            name: 'Radish',
            growDays: 8,
        );

        $this->repository->save($variety);

        $this->assertDatabaseHas('varieties', [
            'slug' => 'radish',
            'name' => 'Radish',
            'grow_days' => 8,
        ]);

        $found = $this->repository->findBySlug('radish');
        $this->assertInstanceOf(Variety::class, $found);
        $this->assertTrue($found->isActive());
        $this->assertSame('radish', $found->slug());
        $this->assertSame([], $found->content());
    }

    public function test_it_updates_an_existing_variety_by_slug_without_a_duplicate(): void
    {
        VarietyModel::create([
            'slug' => 'fenugreek',
            'name' => 'Fenugreek',
            'grow_days' => 8,
            'is_active' => true,
        ]);

        $updated = new Variety(
            slug: 'fenugreek',
            name: 'Fenugreek Microgreens',
            growDays: 9,
            isActive: false,
        );

        $this->repository->save($updated);

        $this->assertDatabaseHas('varieties', [
            'slug' => 'fenugreek',
            'name' => 'Fenugreek Microgreens',
            'grow_days' => 9,
            'is_active' => false,
        ]);
        $this->assertDatabaseMissing('varieties', [
            'slug' => 'fenugreek',
            'name' => 'Fenugreek',
        ]);
        $this->assertSame(1, VarietyModel::where('slug', 'fenugreek')->count());
    }

    public function test_it_preserves_nullable_fields_and_content_through_mapping(): void
    {
        VarietyModel::create([
            'slug' => 'pink-radish',
            'name' => 'Pink Radish',
            'latin' => null,
            'grow_days' => 9,
            'yield_min_g' => null,
            'yield_max_g' => null,
            'tag' => null,
            'is_active' => false,
            'content' => null,
        ]);

        $variety = $this->repository->findBySlug('pink-radish');

        $this->assertNotNull($variety);
        $this->assertNull($variety->latin());
        $this->assertNull($variety->yieldMinG());
        $this->assertNull($variety->yieldMaxG());
        $this->assertNull($variety->tag());
        $this->assertFalse($variety->isActive());
        $this->assertSame([], $variety->content());

        $withContent = new Variety(
            slug: 'mustard',
            name: 'Mustard',
            growDays: 9,
            content: ['timeline' => '9 days', 'health' => 'detoxifying'],
        );

        $this->repository->save($withContent);

        $found = $this->repository->findBySlug('mustard');

        $this->assertNotNull($found);
        $this->assertSame(['timeline' => '9 days', 'health' => 'detoxifying'], $found->content());
    }
}
