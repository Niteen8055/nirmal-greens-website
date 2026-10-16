<?php

declare(strict_types=1);

namespace Src\Catalog\Domain\Variety;

use InvalidArgumentException;

final class Variety
{
    private string $name;

    private ?string $latin;

    private int $growDays;

    private ?int $yieldMinG;

    private ?int $yieldMaxG;

    private ?string $tag;

    private bool $isActive;

    /** @var array<string, mixed> */
    private array $content;

    public function __construct(
        private readonly string $slug,
        string $name,
        int $growDays,
        ?string $latin = null,
        ?int $yieldMinG = null,
        ?int $yieldMaxG = null,
        ?string $tag = null,
        bool $isActive = true,
        array $content = [],
    ) {
        $this->assertValidSlug($slug);
        $this->assertValidGrowDays($growDays);
        $this->assertValidYieldRange($yieldMinG, $yieldMaxG);

        $this->name = $this->normalizeRequiredText($name);
        $this->latin = $this->normalizeOptionalText($latin);
        $this->growDays = $growDays;
        $this->yieldMinG = $yieldMinG;
        $this->yieldMaxG = $yieldMaxG;
        $this->tag = $this->normalizeOptionalText($tag);
        $this->isActive = $isActive;
        $this->content = $content;
    }

    public function slug(): string
    {
        return $this->slug;
    }

    public function name(): string
    {
        return $this->name;
    }

    public function latin(): ?string
    {
        return $this->latin;
    }

    public function growDays(): int
    {
        return $this->growDays;
    }

    public function yieldMinG(): ?int
    {
        return $this->yieldMinG;
    }

    public function yieldMaxG(): ?int
    {
        return $this->yieldMaxG;
    }

    public function tag(): ?string
    {
        return $this->tag;
    }

    public function isActive(): bool
    {
        return $this->isActive;
    }

    /** @return array<string, mixed> */
    public function content(): array
    {
        return $this->content;
    }

    public function rename(string $name): void
    {
        $this->name = $this->normalizeRequiredText($name);
    }

    public function changeGrowDays(int $growDays): void
    {
        $this->assertValidGrowDays($growDays);

        $this->growDays = $growDays;
    }

    public function updateYieldRange(
        ?int $yieldMinG,
        ?int $yieldMaxG,
    ): void {
        $this->assertValidYieldRange($yieldMinG, $yieldMaxG);

        $this->yieldMinG = $yieldMinG;
        $this->yieldMaxG = $yieldMaxG;
    }

    public function updateLatin(?string $latin): void
    {
        $this->latin = $this->normalizeOptionalText($latin);
    }

    public function updateTag(?string $tag): void
    {
        $this->tag = $this->normalizeOptionalText($tag);
    }

    /** @param array<string, mixed> $content */
    public function updateContent(array $content): void
    {
        $this->content = $content;
    }

    public function activate(): void
    {
        $this->isActive = true;
    }

    public function deactivate(): void
    {
        $this->isActive = false;
    }

    private function assertValidSlug(string $slug): void
    {
        if (! preg_match('/^[a-z0-9]+(?:-[a-z0-9]+)*$/', $slug)) {
            throw new InvalidArgumentException(
                'The variety slug must contain lowercase letters, numbers, and hyphens only.'
            );
        }
    }

    private function assertValidGrowDays(int $growDays): void
    {
        if ($growDays < 1) {
            throw new InvalidArgumentException(
                'Grow days must be at least 1.'
            );
        }
    }

    private function assertValidYieldRange(
        ?int $yieldMinG,
        ?int $yieldMaxG,
    ): void {
        if ($yieldMinG !== null && $yieldMinG < 0) {
            throw new InvalidArgumentException(
                'Minimum yield cannot be negative.'
            );
        }

        if ($yieldMaxG !== null && $yieldMaxG < 0) {
            throw new InvalidArgumentException(
                'Maximum yield cannot be negative.'
            );
        }

        if (
            $yieldMinG !== null
            && $yieldMaxG !== null
            && $yieldMinG > $yieldMaxG
        ) {
            throw new InvalidArgumentException(
                'Minimum yield cannot exceed maximum yield.'
            );
        }
    }

    private function normalizeRequiredText(string $value): string
    {
        $value = trim($value);

        if ($value === '') {
            throw new InvalidArgumentException(
                'Variety name cannot be empty.'
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
