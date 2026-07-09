<?php

declare(strict_types=1);

namespace HarmonyUI\Style;

use function implode;
use function is_array;

/**
 * CVA styles of a single component part, backing the `hui()` Twig function.
 */
final readonly class ComponentStyle
{
    public string $base;

    /** @var array<string, array<string, string>> */
    public array $variants;

    /**
     * @param string|list<string> $base Classes always applied to the component
     * @param array<string, array<string, string|list<string>>> $variants Map of category => { variant name => classes }
     * @param list<array<string, string|list<string>>> $compoundVariants List of { category => matching variant(s), ..., 'class' => classes }
     * @param array<string, string> $defaultVariants Map of category => variant name applied when no value is passed
     */
    public function __construct(
        string|array $base = '',
        array $variants = [],
        public array $compoundVariants = [],
        public array $defaultVariants = [],
    )
    {
        $this->base = self::join($base);
        $this->variants = array_map(
            static fn(array $classes): array => array_map(self::join(...), $classes),
            $variants,
        );
    }

    /**
     * Empty values are omitted so a partial style never clobbers the values it doesn't set.
     *
     * @return array{
     *     base?: string,
     *     variants?: array<string, array<string, string>>,
     *     compound_variants?: list<array<string, string|list<string>>>,
     *     default_variants?: array<string, string>,
     * }
     */
    public function toConfig(): array
    {
        return array_filter([
            'base' => $this->base,
            'variants' => $this->variants,
            'compound_variants' => $this->compoundVariants,
            'default_variants' => $this->defaultVariants,
        ], static fn(string|array $value): bool => [] !== $value && '' !== $value);
    }

    /**
     * @param string|list<string> $classes
     */
    private static function join(string|array $classes): string
    {
        return is_array($classes) ? implode(' ', $classes) : $classes;
    }
}
