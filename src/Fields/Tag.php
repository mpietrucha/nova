<?php

namespace Mpietrucha\Nova\Fields;

use Mpietrucha\Nova\Fields\Concerns\InteractsWithRequest;
use Mpietrucha\Nova\Fields\Contracts\InteractsWithRequestInterface;
use Mpietrucha\Nova\Fields\Replicate\Concerns\Replicatable;
use Mpietrucha\Nova\Fields\Replicate\Contracts\ReplicatableInterface;
use Mpietrucha\Nova\Fields\Resources\Concerns\Guessable;
use Mpietrucha\Utility\Concerns\Compatible;
use Mpietrucha\Utility\Contracts\CompatibleInterface;

class Tag extends \Laravel\Nova\Fields\Tag implements CompatibleInterface, InteractsWithRequestInterface, ReplicatableInterface
{
    use Compatible, Guessable, InteractsWithRequest, Replicatable\Relation;

    /**
     * @var array<string, string>
     */
    protected static $replicate = [
        'searchable' => 'preload',
    ];

    protected static function compatibility(): bool
    {
        $request = static::request();

        if ($request->isInlineCreateRequest()) {
            return false;
        }

        if ($request->boolean('relatable')) {
            return false;
        }

        return true;
    }
}
