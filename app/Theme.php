<?php

namespace Templates\Tailwind;

use Illuminate\Support\ServiceProvider;

class Theme extends ServiceProvider
{
    private string $moduleNameLower = 'tailwind';
    private string $moduleName = 'Tailwind';

    public function boot(): void
    {
        $this->publishes([module_path($this->moduleNameLower).'/assets' => public_path('assets/themes/tailwind')], $this->moduleNameLower.'-assets');
        $this->registerConfig();
        $this->registerTranslations();
    }

    public function register()
    {
    }

    protected function registerConfig(): void
    {
        $this->publishes([
            module_path($this->moduleName, 'app/config/config.php') => config_path($this->moduleNameLower . '.php'),
        ], 'config');
        $this->mergeConfigFrom(
            module_path($this->moduleName, 'app/config/config.php'), $this->moduleNameLower
        );
    }

    protected function registerTranslations(): void
    {
        $langPath = module_path($this->moduleName, 'app/lang');
        if (is_dir($langPath)) {
            $this->loadTranslationsFrom($langPath, $this->moduleNameLower);
            $this->loadJsonTranslationsFrom($langPath);
        } else {
            $this->loadTranslationsFrom(module_path($this->moduleName, 'lang'), $this->moduleNameLower);
            $this->loadJsonTranslationsFrom(module_path($this->moduleName, 'lang'));
        }
    }
}
