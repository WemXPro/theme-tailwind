<?php

return [

    'name' => 'Tailwind',
    'version' => '1.0.0',
    'wemx_version' => '1.0.0',
    'author' => 'Mubeen',

    // Below are assets for the theme
    'folder' => 'tailwind',

    // Wrapper are used by addon developers to display the contents of a module
    // A wrapper should be a blank page with menu, user settings around it
    'wrapper' => 'layouts/wrapper',
    'assets' => '/assets/themes/default/',

    'theme_presets' => [
        'default' => [
            'name' => 'Default',
            'image' => '/assets/core/img/theme-presets/metalic_gray.png',
            'colors' => '{"50": "#F9FAFB","100": "#F3F4F6","200": "#E5E7EB","300": "#D1D5DB","400": "#9CA3AF","500": "#6B7280","600": "#4B5563","700": "#374151","800": "#1F2937","900": "#111827"}',
        ],
        'space_black' => [
            'name' => 'Space Black',
            'image' => '/assets/core/img/theme-presets/space_black.png',
            'colors' => '{"50": "#F9FAFB", "100": "#F3F4F6", "200": "#E5E7EB", "300": "#D1D5DB", "400": "#9CA3AF", "500": "#6B7280", "600": "#232b37", "700": "#141c27", "800": "#0c1219", "900": "#000000"}',
        ],
        'midnight_purple' => [
            'name' => 'Midnight Purple',
            'image' => '/assets/core/img/theme-presets/midnight_purple.png',
            'colors' => '{"50": "#F9FAFB","100": "#F3F4F6","200": "#E5E7EB","300": "#D1D5DB","400": "#9CA3AF","500": "#6B7280","600": "#32324a","700": "#1d1d2f","800": "#171725","900": "#11111d"}',
        ],
        'dark_purple' =>  [
            'name' => 'Dark Purple',
            'image' => '/assets/core/img/theme-presets/dark_purple.png',
            'colors' => '{"50": "#F9FAFB","100": "#F3F4F6","200": "#E5E7EB","300": "#D1D5DB","400": "#9CA3AF","500": "#6B7280","600": "#4c4f6d","700": "#2f3247","800": "#252839","900": "#1f2133"}',
        ],
    ],

    'category_structures' => [
        'grid' => [
            'name' => 'Grid',
            'image' => '/assets/core/img/category-presets/grid.png',
        ],
        'small_grid' => [
            'name' => 'Small Grid',
            'image' => '/assets/core/img/category-presets/small_grid.png',
        ],
        'block' => [
            'name' => 'Block',
            'image' => '/assets/core/img/category-presets/block.png',
        ],
    ],

    'tailwind_colors' => [
        'rose',
        'pink',
        'fuchsia',
        'purple',
        'violet',
        'indigo',
        'blue',
        'sky',
        'cyan',
        'teal',
        'emerald',
        'green',
        'lime',
        'yellow',
        'amber',
        'orange',
        'red',
        'stone',
        'neutral',
        'zinc',
        'gray',
        'slate',
    ],

    'navigation' => [
        'navbar' => [
            'name' => 'Navbar',
            'image' => '/assets/core/img/navigation/navbar.png',
        ],
        'sidebar' => [
            'name' => 'Sidebar',
            'image' => '/assets/core/img/navigation/sidebar.png',
        ],
    ],

    'socials' => ['discord', 'github', 'twitter'],

    'footer_types' => ['default', 'minimal'],

];
