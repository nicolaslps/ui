<?php

declare(strict_types=1);

use HarmonyUI\Style\ComponentStyle;

return [
    'alert' => new ComponentStyle(
        base: [
            "@container/alert relative grid w-full items-start gap-x-2 gap-y-0.5 rounded-xl border px-3.5 py-3 text-start text-sm",
            "has-[>svg]:grid-cols-[calc(var(--spacing)*4)_1fr] has-data-[slot=alert-action]:grid-cols-[1fr_auto] has-[>svg]:has-data-[slot=alert-action]:grid-cols-[calc(var(--spacing)*4)_1fr_auto]",
            "[&>svg]:h-lh [&>svg]:w-4 [&>svg]:text-current",
        ],
        variants: [
            'variant' => [
                'default' => "border-muted-foreground/32 bg-muted-foreground/4 text-card-foreground",
                'danger' => "border-destructive/32 bg-destructive/4 text-destructive-foreground [&>svg]:text-destructive",
                'info' => "border-info/32 bg-info/4 text-info-foreground [&>svg]:text-info",
                'success' => "border-success/32 bg-success/4 text-success-foreground [&>svg]:text-success",
                'warning' => "border-warning/32 bg-warning/4 text-warning-foreground [&>svg]:text-warning",
            ],
        ],
    ),
    'alert-title' => new ComponentStyle(
        base: "col-start-1 font-medium [svg~&]:col-start-2",
    ),
    'alert-description' => new ComponentStyle(
        base: "col-start-1 flex flex-col gap-2.5 text-muted-foreground [svg~&]:col-start-2",
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
