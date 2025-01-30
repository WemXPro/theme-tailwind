<?php

namespace Templates\Tailwind;

use Illuminate\Support\ServiceProvider;

class Provider extends ServiceProvider
{
    private string $moduleNameLower = 'tailwind';
    private string $moduleName = 'Tailwind';

    public function boot(): void
    {
        $this->publishes([module_path($this->moduleNameLower).'/assets' => public_path('assets/themes/tailwind')], $this->moduleNameLower.'-assets');
        $this->registerConfig();
    }

    public function register()
    {
    }

    protected function registerConfig(): void
    {
        $this->publishes([
            module_path($this->moduleName, 'app/Config/config.php') => config_path($this->moduleNameLower . '.php'),
        ], 'config');
        $this->mergeConfigFrom(
            module_path($this->moduleName, 'app/Config/config.php'), $this->moduleNameLower
        );
    }
}
