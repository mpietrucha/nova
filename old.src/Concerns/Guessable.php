<?php

namespace App\Nova\Concerns;

use App\Nova\Fields\Guess;

trait Guessable
{
    /**
     * @template TModel of \Illuminate\Database\Eloquent\Model
     * @template TResource of \App\Nova\Resources\Resource<TModel>
     *
     * @param  class-string<TResource>|null  $resource
     */
    public function __construct(string $name, ?string $attribute = null, ?string $resource = null)
    {
        parent::__construct($name, $attribute, Guess::resource($name, $resource));
    }
}
