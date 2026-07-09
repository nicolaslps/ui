<?php

declare(strict_types=1);

namespace HarmonyUI\Tests\Twig;

use HarmonyUI\Twig\UniqueIdExtension;
use PHPUnit\Framework\TestCase;

final class UniqueIdExtensionTest extends TestCase
{
    public function testGeneratedIdsAreUniquePerPrefix(): void
    {
        $extension = new UniqueIdExtension();

        $first = $extension->generate('accordion');
        $second = $extension->generate('accordion');

        self::assertMatchesRegularExpression('/^hui-accordion-[0-9a-f]{8}$/', $first);
        self::assertNotSame($first, $second);
    }

    public function testGeneratedIdsAreDeterministicAcrossInstances(): void
    {
        self::assertSame(
            (new UniqueIdExtension())->generate('accordion'),
            (new UniqueIdExtension())->generate('accordion'),
        );
    }

    public function testResetRestartsTheCounters(): void
    {
        $extension = new UniqueIdExtension();

        $first = $extension->generate('accordion');
        $extension->reset();

        self::assertSame($first, $extension->generate('accordion'));
    }
}
