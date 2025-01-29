<?php

namespace Templates\Tailwind;

use Illuminate\Support\ServiceProvider;

class Provider extends ServiceProvider
{
    private string $id = 'tailwind';
    public function boot(): void
    {
        $this->publishes([module_path($this->id).'/assets' => public_path('assets/themes/tailwind')], $this->id.'-assets');
    }

    public function register()
    {
    }
}
