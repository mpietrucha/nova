<?php

namespace Mpietrucha\Nova\Fields\Translation;

use Mpietrucha\Utility\Arr;

class Encoder extends Transformer
{
    /**
     * @param  array{type: string, fields: array<string, string>}  $translation
     * @return array<string, string>
     */
    public function __invoke(array $translation): array
    {
        $fields = Arr::get($translation, 'fields');

        return [
            Arr::get($fields, Select::property()) => Arr::get($fields, Text::property()),
        ];
    }
}
