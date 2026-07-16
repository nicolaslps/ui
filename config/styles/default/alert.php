<?php

declare(strict_types=1);

use HarmonyUI\Style\ComponentStyle;

$adaptiveMuted = "[--alert-muted-foreground:oklch(from_var(--alert-foreground)_l_calc(c*0.6)_h)]";

$adaptiveForeground = "[--alert-foreground:oklch(from_var(--alert-color)_0.5_c_h)] dark:[--alert-foreground:oklch(from_var(--alert-color)_0.75_c_h)] " . $adaptiveMuted;

return [
    'alert' => new ComponentStyle(
        base: [
            "@container/alert relative grid w-full items-start gap-x-2 gap-y-0.5 rounded-xl border px-3.5 py-3 text-start text-sm",
            "border-(--alert-color)/32 bg-(--alert-color)/4 text-(--alert-foreground) [&>svg]:text-(--alert-color)",
            "has-[>svg]:grid-cols-[calc(var(--spacing)*4)_1fr] has-data-[slot=alert-action]:grid-cols-[1fr_auto] has-[>svg]:has-data-[slot=alert-action]:grid-cols-[calc(var(--spacing)*4)_1fr_auto]",
            "[&>svg]:h-lh [&>svg]:w-4",
        ],
        variants: [
            'variant' => [
                'default' => "[--alert-color:var(--color-muted-foreground)] [--alert-foreground:var(--color-card-foreground)] [--alert-muted-foreground:var(--color-muted-foreground)]",
                'danger' => ["[--alert-color:var(--color-destructive)] [--alert-foreground:var(--color-destructive-foreground)]", $adaptiveMuted],
                'info' => ["[--alert-color:var(--color-info)] [--alert-foreground:var(--color-info-foreground)]", $adaptiveMuted],
                'success' => ["[--alert-color:var(--color-success)] [--alert-foreground:var(--color-success-foreground)]", $adaptiveMuted],
                'warning' => ["[--alert-color:var(--color-warning)] [--alert-foreground:var(--color-warning-foreground)]", $adaptiveMuted],
            ],
            'color' => [
                'red' => ["[--alert-color:var(--color-red-500)]", $adaptiveForeground],
                'orange' => ["[--alert-color:var(--color-orange-500)]", $adaptiveForeground],
                'amber' => ["[--alert-color:var(--color-amber-500)]", $adaptiveForeground],
                'yellow' => ["[--alert-color:var(--color-yellow-500)]", $adaptiveForeground],
                'lime' => ["[--alert-color:var(--color-lime-500)]", $adaptiveForeground],
                'green' => ["[--alert-color:var(--color-green-500)]", $adaptiveForeground],
                'emerald' => ["[--alert-color:var(--color-emerald-500)]", $adaptiveForeground],
                'teal' => ["[--alert-color:var(--color-teal-500)]", $adaptiveForeground],
                'cyan' => ["[--alert-color:var(--color-cyan-500)]", $adaptiveForeground],
                'sky' => ["[--alert-color:var(--color-sky-500)]", $adaptiveForeground],
                'blue' => ["[--alert-color:var(--color-blue-500)]", $adaptiveForeground],
                'indigo' => ["[--alert-color:var(--color-indigo-500)]", $adaptiveForeground],
                'violet' => ["[--alert-color:var(--color-violet-500)]", $adaptiveForeground],
                'purple' => ["[--alert-color:var(--color-purple-500)]", $adaptiveForeground],
                'fuchsia' => ["[--alert-color:var(--color-fuchsia-500)]", $adaptiveForeground],
                'pink' => ["[--alert-color:var(--color-pink-500)]", $adaptiveForeground],
                'rose' => ["[--alert-color:var(--color-rose-500)]", $adaptiveForeground],
                'slate' => ["[--alert-color:var(--color-slate-500)]", $adaptiveForeground],
                'gray' => ["[--alert-color:var(--color-gray-500)]", $adaptiveForeground],
                'zinc' => ["[--alert-color:var(--color-zinc-500)]", $adaptiveForeground],
                'neutral' => ["[--alert-color:var(--color-neutral-500)]", $adaptiveForeground],
                'stone' => ["[--alert-color:var(--color-stone-500)]", $adaptiveForeground],
                'mauve' => ["[--alert-color:var(--color-mauve-500)]", $adaptiveForeground],
                'olive' => ["[--alert-color:var(--color-olive-500)]", $adaptiveForeground],
                'mist' => ["[--alert-color:var(--color-mist-500)]", $adaptiveForeground],
                'taupe' => ["[--alert-color:var(--color-taupe-500)]", $adaptiveForeground],
            ],
        ],
    ),
    'alert-title' => new ComponentStyle(
        base: "col-start-1 font-medium [svg~&]:col-start-2",
    ),
    'alert-description' => new ComponentStyle(
        base: "col-start-1 flex flex-col gap-2.5 text-(--alert-muted-foreground) [svg~&]:col-start-2",
    ),
    'alert-action' => new ComponentStyle(
        base: "flex gap-1",
        variants: [
            'inline' => [
                'true' => "@max-lg/alert:mt-2 @max-lg/alert:col-start-1 @max-lg/alert:-col-end-1 @max-lg/alert:[svg~&]:col-start-2 @lg/alert:-col-start-2 @lg/alert:row-start-1 @lg/alert:row-end-3 @lg/alert:self-center",
                'false' => "mt-2 col-start-1 -col-end-1 [svg~&]:col-start-2",
            ],
        ],
        defaultVariants: ['inline' => 'true'],
    ),
];
