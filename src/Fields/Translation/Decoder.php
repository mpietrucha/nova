<?php

namespace Mpietrucha\Nova\Fields\Translation;

class Decoder extends Transformer
{
    /**
     * @return array{type: string, fields: array<string, string>}
     */
    public function __invoke(string $translation, string $language): array
    {
        return [
            'type' => Repeatable::key(),
            'fields' => [
                Select::property() => $language,
                Text::property() => $translation,
            ],
        ];
    }
}
