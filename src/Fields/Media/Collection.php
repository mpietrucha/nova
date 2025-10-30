<?php

namespace Mpietrucha\Nova\Fields\Media;

use Laravel\Nova\Fields\File;
use Mpietrucha\Nova\Fields\Media\Contracts\InteractsWithMediaInterface;
use Mpietrucha\Nova\Fields\Media\Exception\CollectionFieldException;
use Mpietrucha\Nova\Fields\Media\Exception\CollectionFieldsException;
use Mpietrucha\Nova\Fields\Repeater;
use Mpietrucha\Utility\Arr;

/**
 * @phpstan-type TMedia \Mpietrucha\Nova\Fields\Media\Contracts\InteractsWithMediaInterface
 */
class Collection extends Repeater
{
    /**
     * @param  list<TMedia>  $fields
     */
    public function __construct(string $name, array $fields)
    {
        $field = static::field($fields);

        parent::__construct(Transformer::create($field), $name);

        Repeatable::use($field);

        Validation::inherit($field, $this);

        Repeatable::make() |> $this->repeatables(...);
    }

    /**
     * @param  TMedia|list<TMedia>  $fields
     * @return TMedia&\Laravel\Nova\Fields\File
     */
    public static function field(array|InteractsWithMediaInterface $fields): InteractsWithMediaInterface
    {
        $fields = Arr::wrap($fields);

        Arr::count($fields) > 1 && CollectionFieldsException::create()->throw();

        $field = Arr::first($fields);

        if ($field instanceof File && $field instanceof InteractsWithMediaInterface) {
            return $field;
        }

        CollectionFieldException::create()->throw();
    }
}
