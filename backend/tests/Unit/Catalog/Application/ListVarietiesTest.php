<?php

declare(strict_types=1);

namespace Tests\Unit\Catalog\Application;

use Mockery;
use PHPUnit\Framework\TestCase;
use Src\Catalog\Application\ListVarieties;
use Src\Catalog\Domain\Variety\Variety;
use Src\Catalog\Domain\Variety\VarietyRepository;

final class ListVarietiesTest extends TestCase
{
    protected function tearDown(): void
    {
        Mockery::close();
        parent::tearDown();
    }

    public function test_it_returns_all_active_varieties_from_the_repository(): void
    {
        $variety = new Variety(
            slug: 'broccoli',
            name: 'Broccoli',
            growDays: 10,
        );

        $repository = Mockery::mock(VarietyRepository::class);
        $repository->shouldReceive('findAllActive')
            ->once()
            ->andReturn([$variety]);

        $handler = new ListVarieties($repository);

        $result = $handler();

        $this->assertSame([$variety], $result);
    }

    public function test_it_returns_an_empty_array_when_no_varieties_are_active(): void
    {
        $repository = Mockery::mock(VarietyRepository::class);
        $repository->shouldReceive('findAllActive')
            ->once()
            ->andReturn([]);

        $handler = new ListVarieties($repository);

        $result = $handler();

        $this->assertSame([], $result);
    }
}
