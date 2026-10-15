<?php

declare(strict_types=1);

namespace Tests\Unit\Catalog\Domain\Variety;

use InvalidArgumentException;
use PHPUnit\Framework\TestCase;
use Src\Catalog\Domain\Variety\Variety;

final class VarietyTest extends TestCase
{
    public function test_it_creates_a_valid_variety(): void
    {
        $variety = new Variety(
            slug: 'broccoli',
            name: 'Broccoli',
            growDays: 10,
        );

        $this->assertSame('broccoli', $variety->slug());
        $this->assertSame('Broccoli', $variety->name());
        $this->assertSame(10, $variety->growDays());
        $this->assertTrue($variety->isActive());
    }

    public function test_it_rejects_an_invalid_slug(): void
    {
        $this->expectException(InvalidArgumentException::class);

        new Variety(
            slug: 'Broccoli!',
            name: 'Broccoli',
            growDays: 10,
        );
    }

    public function test_it_rejects_an_empty_name(): void
    {
        $this->expectException(InvalidArgumentException::class);

        new Variety(
            slug: 'broccoli',
            name: '   ',
            growDays: 10,
        );
    }

    public function test_it_rejects_zero_grow_days(): void
    {
        $this->expectException(InvalidArgumentException::class);

        new Variety(
            slug: 'broccoli',
            name: 'Broccoli',
            growDays: 0,
        );
    }

    public function test_it_rejects_a_negative_minimum_yield(): void
    {
        $this->expectException(InvalidArgumentException::class);

        new Variety(
            slug: 'broccoli',
            name: 'Broccoli',
            growDays: 10,
            yieldMinG: -1,
        );
    }

    public function test_it_rejects_an_invalid_yield_range(): void
    {
        $this->expectException(InvalidArgumentException::class);

        new Variety(
            slug: 'broccoli',
            name: 'Broccoli',
            growDays: 10,
            yieldMinG: 100,
            yieldMaxG: 50,
        );
    }

    public function test_it_can_change_grow_days(): void
    {
        $variety = new Variety(
            slug: 'broccoli',
            name: 'Broccoli',
            growDays: 10,
        );

        $variety->changeGrowDays(12);

        $this->assertSame(12, $variety->growDays());
    }

    public function test_it_rejects_invalid_grow_days_when_updating(): void
    {
        $variety = new Variety(
            slug: 'broccoli',
            name: 'Broccoli',
            growDays: 10,
        );

        $this->expectException(InvalidArgumentException::class);

        $variety->changeGrowDays(0);
    }

    public function test_it_can_be_deactivated(): void
    {
        $variety = new Variety(
            slug: 'broccoli',
            name: 'Broccoli',
            growDays: 10,
        );

        $variety->deactivate();

        $this->assertFalse($variety->isActive());
    }
}
