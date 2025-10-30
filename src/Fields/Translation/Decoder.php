<?php

namespace Mpietrucha\Nova\Fields\Translation;

use Mpietrucha\Utility\Arr;
use Mpietrucha\Utility\Normalizer;
use Mpietrucha\Utility\Value;

class Decoder extends \Mpietrucha\Nova\Fields\Repeater\Decoder
{
    /**
     * @return RepeatableTransformerInputFrame
     */
    public function __invoke(string $translation, ?string $language = null): array
    {
        $fields = $this->fields($translation, $language);

        return static::build(Repeatable::key(), $fields);
    }

    /**
     * @return RepeatableTransformerInput
     */
    public static function default(): array
    {
        return static::empty() |> Arr::overlap(...);
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

    /**
     * @return RepeatableTransformerInputFrameFields
     */
    protected function fields(string $translation, ?string $language = null): array
    {
        return [
            Select::property() => $language,
            Text::property() => $translation,
        ];
    }
}
