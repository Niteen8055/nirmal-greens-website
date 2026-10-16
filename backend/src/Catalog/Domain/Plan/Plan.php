<?php

declare(strict_types=1);

namespace Src\Catalog\Domain\Plan;

use InvalidArgumentException;

final class Plan
{
    private readonly string $code;

    private string $name;

    private int $weightG;

    private int $pricePaise;

    private int $traysPerCycle;

    /** @var array<string, mixed> */
    private array $rules;

    private ?string $razorpayPlanId;

    private bool $isActive;

    /**
     * @param  array<string, mixed>  $rules
     */
    public function __construct(
        string $code,
        string $name,
        int $weightG,
        int $pricePaise,
        int $traysPerCycle,
        array $rules,
        ?string $razorpayPlanId = null,
        bool $isActive = true,
    ) {
        $this->assertValidWeightG($weightG);
        $this->assertValidPricePaise($pricePaise);
        $this->assertValidTraysPerCycle($traysPerCycle);

        $this->code = $this->normalizeRequiredText($code, 'Plan code');
        $this->name = $this->normalizeRequiredText($name, 'Plan name');
        $this->weightG = $weightG;
        $this->pricePaise = $pricePaise;
        $this->traysPerCycle = $traysPerCycle;
        $this->rules = $rules;
        $this->razorpayPlanId = $this->normalizeOptionalText($razorpayPlanId);
        $this->isActive = $isActive;
    }

    public function code(): string
    {
        return $this->code;
    }

    public function name(): string
    {
        return $this->name;
    }

    public function weightG(): int
    {
        return $this->weightG;
    }

    public function pricePaise(): int
    {
        return $this->pricePaise;
    }

    public function traysPerCycle(): int
    {
        return $this->traysPerCycle;
    }

    /** @return array<string, mixed> */
    public function rules(): array
    {
        return $this->rules;
    }

    public function razorpayPlanId(): ?string
    {
        return $this->razorpayPlanId;
    }

    public function isActive(): bool
    {
        return $this->isActive;
    }

    public function rename(string $name): void
    {
        $this->name = $this->normalizeRequiredText($name, 'Plan name');
    }

    public function changeWeightG(int $weightG): void
    {
        $this->assertValidWeightG($weightG);

        $this->weightG = $weightG;
    }

    public function changePricePaise(int $pricePaise): void
    {
        $this->assertValidPricePaise($pricePaise);

        $this->pricePaise = $pricePaise;
    }

    public function changeTraysPerCycle(int $traysPerCycle): void
    {
        $this->assertValidTraysPerCycle($traysPerCycle);

        $this->traysPerCycle = $traysPerCycle;
    }

    /** @param array<string, mixed> $rules */
    public function updateRules(array $rules): void
    {
        $this->rules = $rules;
    }

    public function updateRazorpayPlanId(?string $razorpayPlanId): void
    {
        $this->razorpayPlanId = $this->normalizeOptionalText($razorpayPlanId);
    }

    public function activate(): void
    {
        $this->isActive = true;
    }

    public function deactivate(): void
    {
        $this->isActive = false;
    }

    private function assertValidWeightG(int $weightG): void
    {
        if ($weightG < 1) {
            throw new InvalidArgumentException(
                'Plan weight must be at least 1 gram.'
            );
        }
    }

    private function assertValidPricePaise(int $pricePaise): void
    {
        if ($pricePaise < 0) {
            throw new InvalidArgumentException(
                'Plan price cannot be negative.'
            );
        }
    }

    private function assertValidTraysPerCycle(int $traysPerCycle): void
    {
        if ($traysPerCycle < 1) {
            throw new InvalidArgumentException(
                'Plan trays per cycle must be at least 1.'
            );
        }
    }

    private function normalizeRequiredText(string $value, string $field): string
    {
        $value = trim($value);

        if ($value === '') {
            throw new InvalidArgumentException(
                $field.' cannot be empty.'
            );
        }

        return $value;
    }

    private function normalizeOptionalText(?string $value): ?string
    {
        if ($value === null) {
            return null;
        }

        $value = trim($value);

        return $value === '' ? null : $value;
    }
}
