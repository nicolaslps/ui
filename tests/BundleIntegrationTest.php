<?php

declare(strict_types=1);

namespace HarmonyUI\Tests;

use HarmonyUI\HarmonyUIBundle;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

final class BundleIntegrationTest extends KernelTestCase
{
    protected static function getKernelClass(): string
    {
        return TestKernel::class;
    }

    protected function tearDown(): void
    {
        parent::tearDown();
        restore_exception_handler();
    }

    public function testBundleBootsAndIsRegistered(): void
    {
        self::bootKernel();

        $bundles = self::$kernel->getBundles();

        self::assertArrayHasKey('HarmonyUIBundle', $bundles);
        self::assertInstanceOf(HarmonyUIBundle::class, $bundles['HarmonyUIBundle']);
        self::assertTrue(self::getContainer()->has('kernel'));
    }

    public function testComponentsAreExposedUnderTheUiPrefix(): void
    {
        self::bootKernel();

        $factory = self::getContainer()->get('ux.twig_component.component_factory');

        self::assertSame('@ui/components/Button.html.twig', $factory->metadataFor('ui:Button')->getTemplate());
    }
}
