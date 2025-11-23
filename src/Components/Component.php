<?php

namespace Mpietrucha\Nova\Components;

use Illuminate\Routing\Events\ResponsePrepared;
use Illuminate\Support\Facades\Event;
use Laravel\Nova\Events\ServingNova;
use Laravel\Nova\Nova;
use Mpietrucha\Nova\Components\Contracts\ResourceInterface;
use Mpietrucha\Utility\Collection;
use Mpietrucha\Utility\Enumerable\Contracts\EnumerableInterface;
use Mpietrucha\Utility\Forward;

/**
 * @mixin \Mpietrucha\Nova\Components\Asset
 *
 * @phpstan-import-type MixedArray from \Mpietrucha\Utility\Arr
 */
abstract class Component
{
    /**
     * @var \Mpietrucha\Utility\Collection<int, \Mpietrucha\Nova\Components\Contracts\ResourceInterface>
     */
    protected static ?Collection $resources = null;

    /**
     * @param  MixedArray  $arguments
     */
    public static function __callStatic(string $method, array $arguments): ResourceInterface
    {
        $forward = Asset::class |> Forward::create(...);

        $forward->eval($method, $arguments);

        return Asset::flush() |> static::use(...);
    }

    /**
     * @param  \Mpietrucha\Utility\Enumerable\Contracts\EnumerableInterface<int, \Laravel\Nova\Asset>  $assets
     */
    protected static function use(EnumerableInterface $assets): ResourceInterface
    {
        static::bootstrap();

        return static::resources()->push(...) |> Resource::create($assets)->tap(...);
    }

    protected static function bootstrap(): void
    {
        if (static::resources()->isNotEmpty()) {
            return;
        }

        static::serve(...) |> Nova::serving(...);

        static::synchronize(...) |> Event::listen(...);
    }

    protected static function serve(ServingNova $event): void
    {
        $event->request |> static::resources()->each->serve(...);
    }

    protected static function synchronize(ResponsePrepared $event): void
    {
        static::resources()->each->synchronize($event->request, $event->response);
    }

    /**
     * @return \Mpietrucha\Utility\Collection<int, \Mpietrucha\Nova\Components\Contracts\ResourceInterface>
     */
    protected static function resources(): Collection
    {
        return static::$resources ??= Collection::create();
    }
}
