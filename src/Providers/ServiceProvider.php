<?php

namespace Mpietrucha\Nova\Providers;

use Mpietrucha\Laravel\Package\Builder;

class ServiceProvider extends \Mpietrucha\Laravel\Package\ServiceProvider
{
    public function configure(Builder $package): void
    {
        $package->name('mpietrucha-nova');

        $package->hasNovaComponent();
        $package->hasNovaTranslations();

        $package->hasTranslations();
        $package->hasExternalTranslations('mpietrucha/laravel-filterable');
    }
}
