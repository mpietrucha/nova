<?php

namespace Mpietrucha\Nova\Fields\Resources\Concerns;

use Mpietrucha\Nova\Fields\Resources\Guesser;

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
