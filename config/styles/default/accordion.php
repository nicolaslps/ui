<?php

declare(strict_types=1);

use HarmonyUI\Style\ComponentStyle;

return [
    'accordion' => new ComponentStyle(
        base: 'flex w-full flex-col'
    ),
    'accordion-item' => new ComponentStyle(
        base: [
            "not-last:border-b",
            "[interpolate-size:allow-keywords]",
            "details-content:h-0 details-content:overflow-clip details-content:opacity-0",
            "details-content:transition-[height,opacity,content-visibility] details-content:transition-discrete details-content:duration-spring details-content:ease-spring",
            "open:details-content:h-auto open:details-content:opacity-100",
            "motion-reduce:details-content:transition-[opacity,content-visibility] motion-reduce:details-content:duration-200 motion-reduce:details-content:ease-out",
        ],
    ),
    'accordion-header' => new ComponentStyle(
        base: 'flex flex-1 items-start gap-2'
    ),
    'accordion-trigger' => new ComponentStyle(
        base: [
            "relative flex w-full rounded-lg border border-transparent py-2.5 text-start text-sm font-medium outline-none cursor-pointer select-none",
            "transition-[color,background-color,border-color,box-shadow] duration-150 ease-out",
            "list-none [&::-webkit-details-marker]:hidden",
            "hover:underline",
            "active:bg-muted/50",
            "focus-visible:border-ring focus-visible:ring-3 focus-visible:ring-ring/50",
            "aria-disabled:pointer-events-none aria-disabled:opacity-50",
        ],
    ),
    'accordion-indicator' => new ComponentStyle(
        base: [
            "pointer-events-none ms-auto size-4 shrink-0 translate-y-0.5 text-muted-foreground transition-transform duration-spring ease-spring",
            "data-[state=open]:rotate-180",
            "motion-reduce:transition-none",
        ],
    ),
    'accordion-panel' => new ComponentStyle(
        base: [
            "pb-2.5 text-sm",
            "[&_a]:underline [&_a]:underline-offset-3 [&_a]:hover:text-foreground",
            "[&_p:not(:last-child)]:mb-4",
        ],
    ),
];
