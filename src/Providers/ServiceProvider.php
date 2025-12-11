<?php

namespace Mpietrucha\Nova\Providers;

use Mpietrucha\Laravel\Filterable\Query;
use Mpietrucha\Laravel\Package\Builder;
use Mpietrucha\Nova\Cards\Filterable\Validator;

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

    public function bootingPackage(): void
    {
        parent::bootingPackage();

        Validator::create() |> Query::validate(...);
    }
}
