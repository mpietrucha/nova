<?php

namespace Mpietrucha\Nova\Fields\Translation;

use Mpietrucha\Utility\Normalizer;

class Encoder extends \Mpietrucha\Nova\Fields\Repeater\Encoder
{
    /**
     * @param  RepeatableTransformerInputFrame  $translation
     * @return RepeatableTransformerOutputFrame
     */
    public function __invoke(array $translation): array
    {
        $fields = static::fields($translation);

        if (Select::property() |> $fields->has(...) |> Normalizer::not(...)) {
            return [];
        }

        return [Select::property() |> $fields->get(...) => Textarea::property() |> $fields->get(...) |> Normalizer::string(...)];
    }
}
