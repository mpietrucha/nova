<?php

namespace Mpietrucha\Nova\Fields\Translation;

use Mpietrucha\Utility\Str;

class Decoder extends \Mpietrucha\Nova\Fields\Repeater\Decoder
{
    /**
     * @return RepeatableTransformerInputFrame
     */
    public function __invoke(string $translation, string $language): array
    {
        $fields = $this->fields($translation, $language);

        return static::build(Repeatable::key(), $fields);
    }

    /**
     * @return RepeatableTransformerInputFrameFields
     */
    protected function fields(string $translation, string $language): array
    {
        return [
            Textarea::property() => $translation,
            Select::property() => static::language($language),
        ];
    }

    protected static function language(string $language): ?string
    {
        if (Str::isEmpty($language)) {
            return null;
        }

        return $language;
    }
}
