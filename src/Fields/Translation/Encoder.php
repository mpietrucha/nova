<?php

namespace Mpietrucha\Nova\Fields\Translation;

class Encoder extends \Mpietrucha\Nova\Fields\Repeatable\Encoder
{
    /**
     * @param  RepeatableTransformerInputFrame  $translation
     * @return RepeatableTransformerOutputFrame
     */
    public function __invoke(array $translation): array
    {
        $fields = static::fields($translation);

        return [
            Select::property() |> $fields->get(...) => Text::property() |> $fields->get(...),
        ];
    }
}
