<?php

declare(strict_types=1);

namespace Tests\Feature\Catalog\Infrastructure;

use Illuminate\Foundation\Testing\LazilyRefreshDatabase;
use Src\Catalog\Domain\Plan\Plan;
use Src\Catalog\Infrastructure\Persistence\Eloquent\EloquentPlanRepository;
use Src\Catalog\Infrastructure\Persistence\Eloquent\PlanModel;
use Tests\TestCase;

final class EloquentPlanRepositoryTest extends TestCase
{
    use LazilyRefreshDatabase;

    private EloquentPlanRepository $repository;

    protected function setUp(): void
    {
        parent::setUp();
        $this->repository = new EloquentPlanRepository;
    }

    public function test_it_returns_a_plan_entity_for_an_existing_code(): void
    {
        $rules = ['allow_repeats' => true, 'priority_slot' => false];
        $this->createPlanModel([
            'code' => 'existing-plan',
            'name' => 'Existing Plan',
            'weight_g' => 75,
            'price_paise' => 1234567,
            'trays_per_cycle' => 6,
            'rules' => $rules,
            'razorpay_plan_id' => 'test-plan-id',
            'is_active' => true,
        ]);

        $plan = $this->repository->findByCode('existing-plan');

        $this->assertInstanceOf(Plan::class, $plan);
        $this->assertSame('existing-plan', $plan->code());
        $this->assertSame('Existing Plan', $plan->name());
        $this->assertSame(75, $plan->weightG());
        $this->assertSame(1234567, $plan->pricePaise());
        $this->assertSame(6, $plan->traysPerCycle());
        $this->assertSame($rules, $plan->rules());
        $this->assertSame('test-plan-id', $plan->razorpayPlanId());
        $this->assertTrue($plan->isActive());
    }

    public function test_it_returns_null_when_no_plan_matches_the_code(): void
    {
        $this->assertNull($this->repository->findByCode('missing-plan'));
    }

    public function test_it_returns_only_active_plans_as_a_plain_array(): void
    {
        $this->createPlanModel([
            'code' => 'active-plan',
            'is_active' => true,
        ]);
        $this->createPlanModel([
            'code' => 'inactive-plan',
            'is_active' => false,
        ]);

        $plans = $this->repository->findAllActive();

        $this->assertIsArray($plans);
        $this->assertCount(1, $plans);
        $this->assertInstanceOf(Plan::class, $plans[0]);
        $this->assertSame('active-plan', $plans[0]->code());
        $this->assertTrue($plans[0]->isActive());
    }

    public function test_it_persists_a_new_plan_with_integer_values_and_active_state(): void
    {
        $plan = new Plan(
            code: 'new-plan',
            name: 'New Plan',
            weightG: 100,
            pricePaise: 249900,
            traysPerCycle: 4,
            rules: ['split_trays' => false],
            razorpayPlanId: null,
            isActive: false,
        );

        $this->repository->save($plan);

        $this->assertDatabaseHas('plans', [
            'code' => 'new-plan',
            'name' => 'New Plan',
            'weight_g' => 100,
            'price_paise' => 249900,
            'trays_per_cycle' => 4,
            'razorpay_plan_id' => null,
            'is_active' => false,
        ]);
    }

    public function test_it_updates_an_existing_plan_by_code_without_a_duplicate(): void
    {
        $this->createPlanModel([
            'code' => 'update-plan',
            'name' => 'Original Plan',
        ]);
        $updatedPlan = new Plan(
            code: 'update-plan',
            name: 'Updated Plan',
            weightG: 200,
            pricePaise: 349900,
            traysPerCycle: 4,
            rules: ['allow_repeats' => false],
            razorpayPlanId: 'updated-test-plan-id',
            isActive: false,
        );

        $this->repository->save($updatedPlan);

        $this->assertDatabaseHas('plans', [
            'code' => 'update-plan',
            'name' => 'Updated Plan',
            'weight_g' => 200,
            'price_paise' => 349900,
            'trays_per_cycle' => 4,
            'razorpay_plan_id' => 'updated-test-plan-id',
            'is_active' => false,
        ]);
        $this->assertDatabaseMissing('plans', [
            'code' => 'update-plan',
            'name' => 'Original Plan',
        ]);
        $this->assertSame(1, PlanModel::where('code', 'update-plan')->count());
    }

    public function test_it_preserves_rules_and_nullable_razorpay_id_in_both_directions(): void
    {
        $rules = [
            'split_trays' => ['enabled' => true, 'limit' => 2],
        ];
        $this->createPlanModel([
            'code' => 'read-rules-plan',
            'rules' => $rules,
            'razorpay_plan_id' => null,
        ]);

        $foundPlan = $this->repository->findByCode('read-rules-plan');

        $this->assertNotNull($foundPlan);
        $this->assertSame($rules, $foundPlan->rules());
        $this->assertNull($foundPlan->razorpayPlanId());

        $plan = new Plan(
            code: 'write-rules-plan',
            name: 'Write Rules Plan',
            weightG: 50,
            pricePaise: 149900,
            traysPerCycle: 4,
            rules: $rules,
            razorpayPlanId: null,
        );

        $this->repository->save($plan);

        $savedModel = PlanModel::where('code', 'write-rules-plan')->firstOrFail();
        $this->assertSame($rules, $savedModel->rules);
        $this->assertNull($savedModel->razorpay_plan_id);
    }

    /**
     * @param  array<string, mixed>  $overrides
     */
    private function createPlanModel(array $overrides = []): PlanModel
    {
        return PlanModel::create(array_replace([
            'code' => 'test-plan',
            'name' => 'Test Plan',
            'weight_g' => 50,
            'price_paise' => 149900,
            'trays_per_cycle' => 4,
            'rules' => [],
            'razorpay_plan_id' => null,
            'is_active' => true,
        ], $overrides));
    }
}
