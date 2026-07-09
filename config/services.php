<?php

declare(strict_types=1);

use HarmonyUI\Twig\ComponentStylesExtension;
use HarmonyUI\Twig\UniqueIdExtension;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
use TalesFromADev\Twig\Extra\Tailwind\TailwindExtension;
use TalesFromADev\Twig\Extra\Tailwind\TailwindRuntime;
use Twig\Extra\Html\HtmlExtension;

use function Symfony\Component\DependencyInjection\Loader\Configurator\abstract_arg;
use function Symfony\Component\DependencyInjection\Loader\Configurator\service;

return static function (ContainerConfigurator $container): void {
    $services = $container->services();

    // twig/html-extra's extension: provides the `html_cva` function.
    // Registered here so it works without twig/extra-bundle in the consuming app.
    $services
        ->set('harmonyui.twig.html_extension', HtmlExtension::class)
        ->tag('twig.extension');

    $services
        ->set('harmonyui.twig.tailwind_extension', TailwindExtension::class)
        ->tag('twig.extension');

    $services
        ->set('harmonyui.twig.tailwind_runtime', TailwindRuntime::class)
        ->args([
            [],
            service('cache.app'),
        ])
        ->tag('twig.runtime');

    $services
        ->set('harmonyui.twig.component_styles', ComponentStylesExtension::class)
        ->args([abstract_arg('merged component styles')])
        ->tag('twig.extension');

    $services
        ->set('harmonyui.twig.unique_id', UniqueIdExtension::class)
        ->tag('twig.extension')
        // Counters must not leak between requests on worker-mode runtimes.
        ->tag('kernel.reset', ['method' => 'reset']);
};
