<?php

namespace Mpietrucha\Nova\Fields\Media;

use Mpietrucha\Nova\Concerns\InteractsWithRequest;
use Mpietrucha\Nova\Contracts\InteractsWithRequestInterface;
use Mpietrucha\Nova\Fields\Delegate\Concerns\Delegable;
use Mpietrucha\Nova\Fields\Text;
use Mpietrucha\Utility\Concerns\Compatible;
use Mpietrucha\Utility\Contracts\CompatibleInterface;
use Mpietrucha\Utility\Normalizer;

/**
 * @mixin \Mpietrucha\Nova\Fields\Audio|\Mpietrucha\Nova\Fields\Avatar
 */
class External extends Text implements CompatibleInterface, InteractsWithRequestInterface
{
    use Compatible, Delegable, InteractsWithRequest;

    public static function preview(string $url): string
    {
        return $url;
    }

    public static function thumbnail(string $url): string
    {
        return $url;
    }

    protected static function compatibility(): bool
    {
        if (static::request()->isPresentationRequest()) {
            return false;
        }

        return static::request()->has('search') |> Normalizer::not(...);
    }
}
