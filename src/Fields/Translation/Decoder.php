<?php

namespace Mpietrucha\Nova\Fields\Translation;

use Mpietrucha\Utility\Normalizer;
use Mpietrucha\Utility\Value;

class Decoder extends Transformer
{
    /**
     * @return array{type: string, fields: array<string, null|string>}
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
     * @return array{type: string, fields: array<string, null|string>}
     */
    public static function empty(?string $translation = null, ?string $language = null): array
    {
        $evaluation = static::create() |> Value::for(...);

        return $evaluation->eval([
            Normalizer::string($translation),
            $language,
        ]);
    }
}
