<?php

namespace Mpietrucha\Nova\Fields\Media;

use Laravel\Nova\Fields\File;
use Mpietrucha\Nova\Fields\Media\Contracts\InteractsWithMediaInterface;
use Mpietrucha\Nova\Fields\Media\Exception\CollectionFieldException;
use Mpietrucha\Nova\Fields\Media\Exception\CollectionFieldsException;
use Mpietrucha\Nova\Fields\Repeater;
use Mpietrucha\Utility\Arr;

/**
 * @phpstan-type MediaField \Mpietrucha\Nova\Fields\Media\Contracts\InteractsWithMediaInterface
 *
 * @phpstan-method static static make(string $name, list<MediaField> $fields)
 */
class Collection extends Repeater
{
    /**
     * @param  list<MediaField>  $fields
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
     * @param  MediaField|list<MediaField>  $fields
     * @return MediaField&\Laravel\Nova\Fields\File
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
