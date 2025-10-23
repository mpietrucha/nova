<?php

namespace Mpietrucha\Nova\Fields\Media\External;

use Mpietrucha\Nova\Fields\Concerns\InteractsWithRequest;
use Mpietrucha\Nova\Fields\Concerns\Proxyable;
use Mpietrucha\Nova\Fields\Contracts\InteractsWithRequestInterface;
use Mpietrucha\Nova\Fields\Media\Contracts\InteractsWithExternalInterface;
use Mpietrucha\Nova\Fields\Media\External\Contracts\PropertyInterface;
use Mpietrucha\Nova\Fields\Text;
use Mpietrucha\Utility\Concerns\Compatible;
use Mpietrucha\Utility\Contracts\CompatibleInterface;
use Mpietrucha\Utility\Normalizer;

/**
 * @mixin \Mpietrucha\Nova\Fields\Audio
 * @mixin \Mpietrucha\Nova\Fields\Avatar
 */
class File extends Text implements CompatibleInterface, InteractsWithRequestInterface
{
    use Compatible, InteractsWithRequest, Proxyable;

    public static function preview(InteractsWithExternalInterface $field): PropertyInterface
    {
        return Preview::create($field);
    }

    public static function thumbnail(InteractsWithExternalInterface $field): PropertyInterface
    {
        return Thumbnail::create($field);
    }

    protected static function compatibility(): bool
    {
        if (static::request()->isPresentationRequest()) {
            return false;
        }

        return static::request()->has('search') |> Normalizer::not(...);
    }
}
