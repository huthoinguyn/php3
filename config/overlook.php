<?php

return [
    'includes'               => [
        //         App\Filament\Resources\Blog\AuthorResource::class,
        App\Filament\Resources\ProductResource::class,
        App\Filament\Resources\UserResource::class,
        App\Filament\Resources\PostResource::class,
    ],
    'excludes'               => [
        //         App\Filament\Resources\Blog\AuthorResource::class,
    ],
    'should_convert_count'   => TRUE,
    'enable_convert_tooltip' => TRUE,
    'grid'                   => [
        'default' => 2,
        'sm'      => 2,
        'md'      => 3,
        'lg'      => 4,
        'xl'      => 5,
        '2xl'     => NULL,
    ],
    'disable_css'            => FALSE,
    'disable_sorting'        => FALSE,
];
