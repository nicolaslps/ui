<?php

declare(strict_types=1);

use HarmonyUI\Style\ComponentStyle;

return [
    'badge' => new ComponentStyle(
        base: [
            "group/badge inline-flex w-fit shrink-0 items-center justify-center overflow-hidden rounded-4xl border border-transparent text-xs font-medium whitespace-nowrap transition-all",
            "focus-visible:border-ring focus-visible:ring-[3px] focus-visible:ring-ring/50",
            "aria-invalid:border-destructive aria-invalid:ring-destructive/20 dark:aria-invalid:ring-destructive/40",
            "[&>svg]:pointer-events-none",
        ],
        variants: [
            'size' => [
                'sm' => [
                    "h-4 gap-1 px-1.5 [&>svg]:size-2.5!",
                    "ltr:has-data-[icon=inline-end]:pr-1 rtl:has-data-[icon=inline-end]:pe-1",
                    "ltr:has-data-[icon=inline-start]:pl-1 rtl:has-data-[icon=inline-start]:ps-1",
                ],
                'md' => [
                    "h-5 gap-1 px-2 py-0.5 [&>svg]:size-3!",
                    "ltr:has-data-[icon=inline-end]:pr-1.5 rtl:has-data-[icon=inline-end]:pe-1.5",
                    "ltr:has-data-[icon=inline-start]:pl-1.5 rtl:has-data-[icon=inline-start]:ps-1.5",
                ],
                'lg' => [
                    "h-6 gap-1.5 px-2.5 py-1 [&>svg]:size-3.5!",
                    "ltr:has-data-[icon=inline-end]:pr-2 rtl:has-data-[icon=inline-end]:pe-2",
                    "ltr:has-data-[icon=inline-start]:pl-2 rtl:has-data-[icon=inline-start]:ps-2",
                ],
            ],
            'variant' => [
                'default' => "bg-primary text-primary-foreground [a]:hover:bg-primary/80",
                'secondary' => "bg-secondary text-secondary-foreground [a]:hover:bg-secondary/80",
                'outline' => "border-border text-foreground [a]:hover:bg-muted [a]:hover:text-muted-foreground",
                'danger' => [
                    "bg-destructive/10 text-destructive-foreground",
                    "focus-visible:ring-destructive/20 dark:bg-destructive/20 dark:focus-visible:ring-destructive/40",
                    "[a]:hover:bg-destructive/20",
                ],
                'info' => [
                    "bg-info/10 text-info-foreground",
                    "focus-visible:ring-info/20 dark:bg-info/20 dark:focus-visible:ring-info/40",
                    "[a]:hover:bg-info/20",
                ],
                'success' => [
                    "bg-success/10 text-success-foreground",
                    "focus-visible:ring-success/20 dark:bg-success/20 dark:focus-visible:ring-success/40",
                    "[a]:hover:bg-success/20",
                ],
                'warning' => [
                    "bg-warning/10 text-warning-foreground",
                    "focus-visible:ring-warning/20 dark:bg-warning/20 dark:focus-visible:ring-warning/40",
                    "[a]:hover:bg-warning/20",
                ],
            ],
        ],
    ),
];
