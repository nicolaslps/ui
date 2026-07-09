<?php

declare(strict_types=1);

namespace HarmonyUI\Tests;

use HarmonyUI\HarmonyUIBundle;
use Symfony\Bundle\FrameworkBundle\FrameworkBundle;
use Symfony\Bundle\FrameworkBundle\Kernel\MicroKernelTrait;
use Symfony\Bundle\TwigBundle\TwigBundle;
use Symfony\Component\Config\Loader\LoaderInterface;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\Compiler\PassConfig;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
use Symfony\Component\HttpKernel\Kernel;
use Symfony\UX\TwigComponent\TwigComponentBundle;

final class TestKernel extends Kernel
{
    use MicroKernelTrait;

    public function registerBundles(): iterable
    {
        return [
            new FrameworkBundle(),
            new TwigBundle(),
            new TwigComponentBundle(),
            new HarmonyUIBundle(),
        ];
    }

    protected function configureContainer(ContainerConfigurator $container, LoaderInterface $loader): void
    {
        $container->extension('framework', [
            'test' => true,
            'secret' => 'test',
            'http_method_override' => false,
            'handle_all_throwables' => true,
            'php_errors' => ['log' => true],
        ]);
    }

    // No controller consumes Twig here, so twig/TwigComponent services would be
    // removed as unused; keep them public so the test trait can fetch them.
    protected function build(ContainerBuilder $container): void
    {
        $container->addCompilerPass(
            new class implements CompilerPassInterface {
                public function process(ContainerBuilder $container): void
                {
                    foreach (['twig', 'ux.twig_component.component_factory'] as $id) {
                        if ($container->hasDefinition($id)) {
                            $container->getDefinition($id)->setPublic(true);
                        }
                    }
                }
            },
            PassConfig::TYPE_BEFORE_REMOVING,
        );
    }

    public function getCacheDir(): string
    {
        return sys_get_temp_dir().'/harmonyui-ui-tests/cache/'.$this->environment;
    }

    public function getLogDir(): string
    {
        return sys_get_temp_dir().'/harmonyui-ui-tests/log';
    }
}
