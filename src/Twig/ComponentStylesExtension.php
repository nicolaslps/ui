<?php

declare(strict_types=1);

namespace HarmonyUI\Twig;

use InvalidArgumentException;
use Twig\Extension\AbstractExtension;
use Twig\Extra\Html\Cva;
use Twig\TwigFunction;

use function array_keys;
use function implode;
use function sprintf;

/**
 * Exposes the configured component styles as `html_cva`-compatible objects
 * through the `hui()` Twig function.
 */
final class ComponentStylesExtension extends AbstractExtension
{
    /** @var array<string, Cva> */
    private array $cvas = [];

    /**
     * @param array<string, array{
     *     base?: string,
     *     variants?: array<string, array<string, string>>,
     *     compound_variants?: list<array<string, string|list<string>>>,
     *     default_variants?: array<string, string>,
     * }> $components Bundle defaults merged with the app configuration
     */
    public function __construct(
        private readonly array $components,
    ) {
    }

    public function getFunctions(): array
    {
        return [
            new TwigFunction('hui', $this->get(...)),
        ];
    }

    public function get(string $component): Cva
    {
        $styles = $this->components[$component] ?? throw new InvalidArgumentException(sprintf('Unknown HarmonyUI component "%s". Known components: "%s".', $component, implode('", "', array_keys($this->components))));

        return $this->cvas[$component] ??= new Cva(
            $styles['base'] ?? '',
            $styles['variants'] ?? [],
            $styles['compound_variants'] ?? [],
            $styles['default_variants'] ?? [],
        );
    }
}
