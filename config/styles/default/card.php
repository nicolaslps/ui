<?php

declare(strict_types=1);

use HarmonyUI\Style\ComponentStyle;

return [
    'card' => new ComponentStyle(
        base: [
            "group/card flex flex-col gap-(--card-spacing) overflow-hidden rounded-xl bg-card py-(--card-spacing) text-sm text-card-foreground ring-1 ring-foreground/10",
            "has-data-[slot=card-footer]:pb-0 has-[>img:first-child]:pt-0",
            "*:[img:first-child]:rounded-t-xl *:[img:last-child]:rounded-b-xl",
        ],
        variants: [
            'size' => [
                'sm' => "[--card-spacing:--spacing(3)]",
                'default' => "[--card-spacing:--spacing(4)]",
                'lg' => "[--card-spacing:--spacing(6)]",
                'xl' => "[--card-spacing:--spacing(8)]",
            ],
        ],
    ),
    'card-header' => new ComponentStyle(
        base: [
            "group/card-header @container/card-header grid auto-rows-min items-start gap-1 rounded-t-xl px-(--card-spacing)",
            "has-data-[slot=card-action]:grid-cols-[1fr_auto]",
            "has-data-[slot=card-description]:grid-rows-[auto_auto]",
            "[.border-b]:pb-(--card-spacing)",
        ],
    ),
    'card-title' => new ComponentStyle(
        base: "text-base leading-snug font-medium group-data-[size=sm]/card:text-sm",
    ),
    'card-description' => new ComponentStyle(
        base: "text-sm text-muted-foreground",
    ),
    'card-action' => new ComponentStyle(
        base: "col-start-2 row-span-2 row-start-1 self-start justify-self-end",
    ),
    'card-content' => new ComponentStyle(
        base: "px-(--card-spacing)",
    ),
    'card-footer' => new ComponentStyle(
        base: "flex items-center rounded-b-xl border-t bg-muted/50 p-(--card-spacing)",
    ),
];
