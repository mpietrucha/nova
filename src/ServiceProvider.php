<?php

namespace Mpietrucha\Nova;

use Mpietrucha\Utility\Filesystem\Path;

class ServiceProvider extends \Illuminate\Support\ServiceProvider
{
    public function boot(): void
    {
        $translations = Path::build('../lang', __DIR__);

        $this->loadTranslationsFrom($translations, 'mpietrucha-nova');

        $this->publishes([
            $translations => $this->app->langPath('vendor/mpietrucha/nova'),
        ]);
    }
}
