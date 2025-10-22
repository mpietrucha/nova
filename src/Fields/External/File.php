<?php

namespace Mpietrucha\Nova\Fields\External;

use Mpietrucha\Nova\Fields\Concerns\InteractsWithRequest;
use Mpietrucha\Nova\Fields\Contracts\InteractsWithRequestInterface;
use Mpietrucha\Nova\Fields\External\Contracts\InteractsWithExternalInterface;
use Mpietrucha\Nova\Fields\External\Contracts\PropertyInterface;
use Mpietrucha\Nova\Fields\External\Property\Preview;
use Mpietrucha\Nova\Fields\External\Property\Thumbnail;
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
    use Compatible, InteractsWithRequest;

    /**
     * @param  string  $method
     * @param  array<array-key, mixed>  $arguments
     */
    public function __call($method, $arguments): static
    {
        if (static::hasMacro($method)) {
            return parent::__call($method, $arguments);
        }

        return $this;
    }

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
