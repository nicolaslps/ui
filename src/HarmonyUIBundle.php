<?php

declare(strict_types=1);

namespace HarmonyUI;

use HarmonyUI\Style\ComponentStyle;
use LogicException;
use Symfony\Component\AssetMapper\AssetMapper;
use Symfony\Component\Config\Definition\Configurator\DefinitionConfigurator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
use Symfony\Component\HttpKernel\Bundle\AbstractBundle;

use function dirname;
use function is_string;
use function sprintf;

use const GLOB_ONLYDIR;

final class HarmonyUIBundle extends AbstractBundle
{
    public function getPath(): string
    {
        return dirname(__DIR__);
    }

    public function configure(DefinitionConfigurator $definition): void
    {
        $definition->import('../config/definition.php');
    }

    /**
     * @param array{theme: string, components?: array<string, array<string, mixed>>} $config
     */
    public function loadExtension(array $config, ContainerConfigurator $container, ContainerBuilder $builder): void
    {
        $container->import(dirname(__DIR__).'/config/services.php');

        $builder->getDefinition('harmonyui.twig.component_styles')
            ->replaceArgument(0, $config['components'] ?? []);
    }

    public function prependExtension(ContainerConfigurator $container, ContainerBuilder $builder): void
    {
        foreach ($builder->getExtensionConfig($this->extensionAlias) as $config) {
            if (isset($config['components'])) {
                throw new LogicException(sprintf('The "%s.components" option cannot be set in the bundle configuration. Define component styles in "config/harmony_ui/*.php" instead.', $this->extensionAlias));
            }
        }

        // Prepend priority: selected theme < app config/harmony_ui/*.php. Themes are
        // standalone: selecting one does not inherit the "default" theme styles.
        $projectStyles = $this->loadStyles($builder, $builder->getParameter('kernel.project_dir').'/config/harmony_ui');
        if ([] !== $projectStyles) {
            $builder->prependExtensionConfig($this->extensionAlias, ['components' => $projectStyles]);
        }

        $builder->prependExtensionConfig($this->extensionAlias, [
            'components' => $this->loadStyles($builder, dirname(__DIR__).'/config/styles/'.$this->resolveTheme($builder)),
        ]);

        if ($builder->hasExtension('framework') && class_exists(AssetMapper::class)) {
            $builder->prependExtensionConfig('framework', [
                'asset_mapper' => [
                    'paths' => [
                        dirname(__DIR__).'/assets' => '@harmonyui',
                    ],
                ],
            ]);
        }

        if ($builder->hasExtension('twig')) {
            $builder->prependExtensionConfig('twig', [
                'paths' => [
                    dirname(__DIR__).'/templates' => 'ui',
                ],
            ]);
        }

        if (!$builder->hasExtension('twig_component')) {
            return;
        }

        // Both keys are mandatory; provide defaults so consuming apps don't have to.
        $builder->prependExtensionConfig('twig_component', [
            'defaults' => [],
            'anonymous_template_directory' => 'components',
        ]);
    }

    /**
     * Prepends run before the configuration is processed, so the theme is read from the raw extension configs.
     */
    private function resolveTheme(ContainerBuilder $builder): string
    {
        $theme = 'default';
        foreach ($builder->getExtensionConfig($this->extensionAlias) as $config) {
            if (isset($config['theme'])) {
                $theme = $config['theme'];
            }
        }

        if (!is_string($theme) || !is_dir(dirname(__DIR__).'/config/styles/'.$theme)) {
            $available = array_map(basename(...), glob(dirname(__DIR__).'/config/styles/*', GLOB_ONLYDIR) ?: []);

            throw new LogicException(sprintf('Unknown HarmonyUI theme "%s". Available themes: "%s".', is_string($theme) ? $theme : get_debug_type($theme), implode('", "', $available)));
        }

        return $theme;
    }

    /**
     * @return array<string, array<string, mixed>>
     */
    private function loadStyles(ContainerBuilder $builder, string $dir): array
    {
        if (!$builder->fileExists($dir, '/\.php$/')) {
            return [];
        }

        $components = [];
        foreach (glob($dir.'/*.php') ?: [] as $file) {
            foreach (require $file as $name => $style) {
                if (!$style instanceof ComponentStyle) {
                    throw new LogicException(sprintf('"%s" must return an array of "%s" instances, got "%s" for component "%s".', $file, ComponentStyle::class, get_debug_type($style), $name));
                }

                $components[$name] = $style->toConfig();
            }
        }

        return $components;
    }
}
