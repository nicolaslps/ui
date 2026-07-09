<?php

declare(strict_types=1);

namespace HarmonyUI\Twig;

use Symfony\Contracts\Service\ResetInterface;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

use function hash;
use function sprintf;
use function substr;

/**
 * Generates unique per-request ids through the `hui_id()` Twig function.
 *
 * Ids are derived from a per-prefix counter so the output is deterministic
 * across renders: snapshots and DOM morphing (e.g. Turbo) stay stable.
 */
final class UniqueIdExtension extends AbstractExtension implements ResetInterface
{
    /** @var array<string, int> */
    private array $counters = [];

    public function getFunctions(): array
    {
        return [
            new TwigFunction('hui_id', $this->generate(...)),
        ];
    }

    public function generate(string $prefix): string
    {
        $this->counters[$prefix] = ($this->counters[$prefix] ?? 0) + 1;

        return sprintf('hui-%s-%s', $prefix, substr(hash('xxh128', $prefix.'-'.$this->counters[$prefix]), 0, 8));
    }

    public function reset(): void
    {
        $this->counters = [];
    }
}
