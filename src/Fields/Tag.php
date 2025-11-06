<?php

namespace Mpietrucha\Nova\Fields;

use Laravel\Nova\Fields\SupportsWithTrashedRelatables;
use Mpietrucha\Nova\Concerns\InteractsWithRequest;
use Mpietrucha\Nova\Contracts\InteractsWithRequestInterface;
use Mpietrucha\Nova\Fields\Replicate\Concerns\Replicatable;
use Mpietrucha\Nova\Fields\Replicate\Contracts\ReplicatableInterface;
use Mpietrucha\Nova\Fields\Resource\Concerns\Guessable;
use Mpietrucha\Utility\Concerns\Compatible;
use Mpietrucha\Utility\Contracts\CompatibleInterface;
use Mpietrucha\Utility\Normalizer;

class Tag extends \Laravel\Nova\Fields\Tag implements CompatibleInterface, InteractsWithRequestInterface, ReplicatableInterface
{
    use Compatible, Guessable, InteractsWithRequest, Replicatable\Relation, SupportsWithTrashedRelatables;

    /**
     * @var string
     */
    public $style = self::LIST_STYLE;

    protected static function compatibility(): bool
    {
        if (static::request()->isInlineCreateRequest()) {
            return false;
        }

        if (static::request()->boolean('relatable')) {
            return false;
        }

        return static::request()->isPresentationRequest() |> Normalizer::not(...);
    }
}
