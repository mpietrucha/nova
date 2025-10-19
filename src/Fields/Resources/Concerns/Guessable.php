<?php

namespace Mpietrucha\Nova\Fields\Resources\Concerns;

use Mpietrucha\Nova\Fields\Resources\Guesser;

/**
 * phpstan-require-extends \Laravel\Nova\Fields\BelongsTo|\Laravel\Nova\Fields\BelongsToMany|\Laravel\Nova\Fields\HasMany
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
