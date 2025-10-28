<?php

namespace Mpietrucha\Nova\Fields\Translation;

use Mpietrucha\Utility\Normalizer;
use Mpietrucha\Utility\Value;

class Decoder extends \Mpietrucha\Nova\Fields\Repeatable\Decoder
{
    /**
     * @return RepeatableTransformerInputFrame
     */
    public function __invoke(string $translation, ?string $language = null): array
    {
        return [
            'type' => Repeatable::key(),
            'fields' => [
                Select::property() => $language,
                Text::property() => $translation,
            ],
        ];
    }

    /**
     * @return RepeatableTransformerInputFrame
     */
    public static function empty(?string $translation = null, ?string $language = null): array
    {
        $evaluation = static::create() |> Value::for(...);

        $translation = Normalizer::string($translation);

        return $evaluation->get($translation, $language);
    }
}
