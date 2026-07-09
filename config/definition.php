<?php

declare(strict_types=1);

use Symfony\Component\Config\Definition\Configurator\DefinitionConfigurator;

// Keys are not normalized: component and variant names may contain dashes.
return static function (DefinitionConfigurator $definition): void {
    $definition->rootNode()
        ->children()
            ->scalarNode('theme')
                ->info('Component style theme (a directory of config/styles/). Themes are standalone and do not inherit from each other.')
                ->defaultValue('default')
                ->cannotBeEmpty()
            ->end()
            ->arrayNode('components')
                ->info('CVA styles per component. Populated by the bundle from the theme and the app config/harmony_ui/*.php files; cannot be set in the bundle configuration.')
                ->useAttributeAsKey('name')
                ->normalizeKeys(false)
                ->arrayPrototype()
                    ->children()
                        ->scalarNode('base')
                            ->info('Classes always applied to the component.')
                        ->end()
                        ->arrayNode('variants')
                            ->info('Map of category => { variant name => classes }.')
                            ->useAttributeAsKey('category')
                            ->normalizeKeys(false)
                            ->arrayPrototype()
                                ->useAttributeAsKey('variant')
                                ->normalizeKeys(false)
                                ->scalarPrototype()->end()
                            ->end()
                        ->end()
                        ->arrayNode('compound_variants')
                            ->info('List of { category => matching variant(s), ..., class: classes }.')
                            ->arrayPrototype()
                                ->normalizeKeys(false)
                                ->variablePrototype()->end()
                            ->end()
                        ->end()
                        ->arrayNode('default_variants')
                            ->info('Map of category => variant name applied when no value is passed.')
                            ->useAttributeAsKey('category')
                            ->normalizeKeys(false)
                            ->scalarPrototype()->end()
                        ->end()
                    ->end()
                ->end()
            ->end()
        ->end();
};
