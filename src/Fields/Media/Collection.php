<?php

namespace Mpietrucha\Nova\Fields\Media;

use Mpietrucha\Nova\Fields\Media\Contracts\InteractsWithMediaInterface;
use Mpietrucha\Nova\Fields\Media\Exception\CollectionFieldException;
use Mpietrucha\Nova\Fields\Media\Exception\CollectionFieldsException;
use Mpietrucha\Nova\Fields\Repeatable\Repeater;
use Mpietrucha\Utility\Arr;

class Collection extends Repeater
{
    /**
     * @param  list<\Mpietrucha\Nova\Fields\Media\Contracts\InteractsWithMediaInterface>  $fields
     */
    public function __construct(string $name, array $fields)
    {
        parent::__construct(Transformer::create(), $name);

        $this->field($fields) |> Repeatable::use(...);

        Repeatable::make() |> $this->repeatables(...);
    }

    /**
     * @param  list<\Mpietrucha\Nova\Fields\Media\Contracts\InteractsWithMediaInterface>  $fields
     */
    protected function field(array $fields): InteractsWithMediaInterface
    {
        Arr::count($fields) > 1 && CollectionFieldsException::create()->throw();

        $field = Arr::first($fields);

        return $field instanceof InteractsWithMediaInterface ? $field : CollectionFieldException::create()->throw();
    }
}
