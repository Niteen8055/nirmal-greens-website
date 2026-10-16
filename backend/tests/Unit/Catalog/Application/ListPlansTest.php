<?php

declare(strict_types=1);

namespace Tests\Unit\Catalog\Application;

use Mockery;
use PHPUnit\Framework\TestCase;
use Src\Catalog\Application\ListPlans;
use Src\Catalog\Domain\Plan\Plan;
use Src\Catalog\Domain\Plan\PlanRepository;

final class ListPlansTest extends TestCase
{
    protected function tearDown(): void
    {
        Mockery::close();
        parent::tearDown();
    }

    public function test_it_returns_all_active_plans_from_the_repository(): void
    {
        $plan = new Plan(
            code: 'example',
            name: 'Example Plan',
            weightG: 50,
            pricePaise: 149900,
            traysPerCycle: 4,
            rules: [],
        );

        $repository = Mockery::mock(PlanRepository::class);
        $repository->shouldReceive('findAllActive')
            ->once()
            ->andReturn([$plan]);

        $handler = new ListPlans($repository);

        $result = $handler();

        $this->assertSame([$plan], $result);
    }

    public function test_it_returns_an_empty_array_when_no_plans_are_active(): void
    {
        $repository = Mockery::mock(PlanRepository::class);
        $repository->shouldReceive('findAllActive')
            ->once()
            ->andReturn([]);

        $handler = new ListPlans($repository);

        $result = $handler();

        $this->assertSame([], $result);
    }
}
