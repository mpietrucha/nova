<?php

namespace Mpietrucha\Nova\Fields;

use Laravel\Nova\Fields\SupportsWithTrashedRelatables;
use Mpietrucha\Nova\Fields\Concerns\InteractsWithRequest;
use Mpietrucha\Nova\Fields\Contracts\InteractsWithRequestInterface;
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
     * @var array<string, string>
     */
    protected static $replicate = [
        'searchable' => 'preload',
    ];

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
