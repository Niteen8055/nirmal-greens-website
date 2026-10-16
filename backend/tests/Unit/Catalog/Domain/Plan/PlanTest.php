<?php

declare(strict_types=1);

namespace Tests\Unit\Catalog\Domain\Plan;

use InvalidArgumentException;
use PHPUnit\Framework\TestCase;
use Src\Catalog\Domain\Plan\Plan;
use TypeError;

final class PlanTest extends TestCase
{
    public function test_it_creates_a_valid_plan(): void
    {
        $rules = [
            'allow_repeats' => true,
            'priority_slot' => false,
        ];
        $plan = $this->createPlan([
            'rules' => $rules,
            'razorpayPlanId' => 'provided-plan-id',
        ]);

        $this->assertSame('example', $plan->code());
        $this->assertSame('Example Plan', $plan->name());
        $this->assertSame(50, $plan->weightG());
        $this->assertSame(149900, $plan->pricePaise());
        $this->assertSame(4, $plan->traysPerCycle());
        $this->assertSame($rules, $plan->rules());
        $this->assertSame('provided-plan-id', $plan->razorpayPlanId());
        $this->assertTrue($plan->isActive());
    }

    public function test_it_rejects_an_empty_code(): void
    {
        $this->expectException(InvalidArgumentException::class);

        $this->createPlan(['code' => '  ']);
    }

    public function test_it_rejects_an_empty_name(): void
    {
        $this->expectException(InvalidArgumentException::class);

        $this->createPlan(['name' => '  ']);
    }

    public function test_it_rejects_a_non_positive_weight(): void
    {
        $this->expectException(InvalidArgumentException::class);

        $this->createPlan(['weightG' => 0]);
    }

    public function test_it_rejects_a_negative_weight(): void
    {
        $this->expectException(InvalidArgumentException::class);

        $this->createPlan(['weightG' => -1]);
    }

    public function test_it_rejects_a_negative_price(): void
    {
        $this->expectException(InvalidArgumentException::class);

        $this->createPlan(['pricePaise' => -1]);
    }

    public function test_it_accepts_a_zero_price(): void
    {
        $plan = $this->createPlan(['pricePaise' => 0]);

        $this->assertSame(0, $plan->pricePaise());
    }

    public function test_it_rejects_a_non_integer_price(): void
    {
        $this->expectException(TypeError::class);

        $this->createPlan(['pricePaise' => 100.5]);
    }

    public function test_it_rejects_a_non_positive_tray_count(): void
    {
        $this->expectException(InvalidArgumentException::class);

        $this->createPlan(['traysPerCycle' => 0]);
    }

    public function test_it_rejects_a_negative_tray_count(): void
    {
        $this->expectException(InvalidArgumentException::class);

        $this->createPlan(['traysPerCycle' => -1]);
    }

    public function test_it_preserves_rules_as_an_array(): void
    {
        $rules = ['split_trays' => ['enabled' => true, 'limit' => 2]];

        $plan = $this->createPlan(['rules' => $rules]);

        $this->assertSame($rules, $plan->rules());
    }

    public function test_razorpay_plan_id_can_be_null(): void
    {
        $plan = $this->createPlan(['razorpayPlanId' => null]);

        $this->assertNull($plan->razorpayPlanId());
    }

    public function test_it_can_be_deactivated_and_activated(): void
    {
        $plan = $this->createPlan();

        $plan->deactivate();
        $this->assertFalse($plan->isActive());

        $plan->activate();
        $this->assertTrue($plan->isActive());
    }

    public function test_it_can_update_plan_details(): void
    {
        $plan = $this->createPlan();
        $rules = ['allow_repeats' => false];

        $plan->rename(' Updated Plan ');
        $plan->changeWeightG(100);
        $plan->changePricePaise(249900);
        $plan->changeTraysPerCycle(5);
        $plan->updateRules($rules);
        $plan->updateRazorpayPlanId(' updated-id ');

        $this->assertSame('Updated Plan', $plan->name());
        $this->assertSame(100, $plan->weightG());
        $this->assertSame(249900, $plan->pricePaise());
        $this->assertSame(5, $plan->traysPerCycle());
        $this->assertSame($rules, $plan->rules());
        $this->assertSame('updated-id', $plan->razorpayPlanId());
    }

    public function test_it_rejects_invalid_values_when_updating(): void
    {
        $plan = $this->createPlan();

        try {
            $plan->changeWeightG(0);
            $this->fail('Expected invalid plan weight to be rejected.');
        } catch (InvalidArgumentException) {
            $this->assertSame(50, $plan->weightG());
        }

        try {
            $plan->changePricePaise(-1);
            $this->fail('Expected negative plan price to be rejected.');
        } catch (InvalidArgumentException) {
            $this->assertSame(149900, $plan->pricePaise());
        }

        try {
            $plan->changeTraysPerCycle(0);
            $this->fail('Expected invalid tray count to be rejected.');
        } catch (InvalidArgumentException) {
            $this->assertSame(4, $plan->traysPerCycle());
        }
    }

    /**
     * @param  array<string, mixed>  $overrides
     */
    private function createPlan(array $overrides = []): Plan
    {
        return new Plan(
            code: $overrides['code'] ?? 'example',
            name: $overrides['name'] ?? 'Example Plan',
            weightG: $overrides['weightG'] ?? 50,
            pricePaise: $overrides['pricePaise'] ?? 149900,
            traysPerCycle: $overrides['traysPerCycle'] ?? 4,
            rules: $overrides['rules'] ?? [],
            razorpayPlanId: $overrides['razorpayPlanId'] ?? null,
            isActive: $overrides['isActive'] ?? true,
        );
    }
}
