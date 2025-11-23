<?php

namespace Mpietrucha\Nova\Fields\Translation;

use Mpietrucha\Utility\Str;

/**
 * @phpstan-import-type RepeaterFields from \Mpietrucha\Nova\Fields\Repeater\Decoder
 * @phpstan-import-type RepeaterInput from \Mpietrucha\Nova\Fields\Repeater\Decoder
 */
class Decoder extends \Mpietrucha\Nova\Fields\Repeater\Decoder
{
    /**
     * @return RepeaterInput
     */
    public function __invoke(string $translation, string $language): array
    {
        $fields = $this->fields($translation, $language);

        return static::build(Repeatable::key(), $fields);
    }

    /**
     * @return RepeaterFields
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
        return Str::nullWhenEmpty($language);
    }
}
