<?php

namespace Mpietrucha\Nova\Fields\Resource\Concerns;

use Mpietrucha\Nova\Fields\Resource\Guesser;

/**
 * phpstan-require-implements \Laravel\Nova\Contracts\RelatableField
 */
trait Guessable
{
    /**
     * @template TModel of \Illuminate\Database\Eloquent\Model
     * @template TResource of \Laravel\Nova\Resource<TModel>
     *
     * @param  class-string<TResource>|null  $resource
     */
    public function __construct(string $name, ?string $attribute = null, ?string $resource = null)
    {
        parent::__construct($name, $attribute, Guesser::guess($name, $resource));
    }
}
