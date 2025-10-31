<?php

namespace Mpietrucha\Nova\Resources;

use Laravel\Nova\Fields\Field;
use Laravel\Nova\Fields\FieldCollection;
use Mpietrucha\Utility\Concerns\Creatable;
use Mpietrucha\Utility\Contracts\ArrayableInterface;
use Mpietrucha\Utility\Contracts\CreatableInterface;

class Flattener implements CreatableInterface
{
    use Creatable;

    /**
     * @return \Laravel\Nova\Fields\Field|array<int, \Laravel\Nova\Fields\Field>
     */
    public function __invoke(Field $field): array|Field
    {
        if ($field instanceof ArrayableInterface) {
            return $field->toArray();
        }

        return $field;
    }

    /**
     * @param  \Laravel\Nova\Fields\FieldCollection<int, \Laravel\Nova\Fields\Field>  $fields
     * @return \Laravel\Nova\Fields\FieldCollection<int, \Laravel\Nova\Fields\Field>
     */
    public static function flatten(FieldCollection $fields): FieldCollection
    {
        $fields = static::create() |> $fields->map(...);

        return $fields->flatten();
    }
}
