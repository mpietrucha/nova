<?php

namespace Mpietrucha\Nova\Fields\Translation;

use Mpietrucha\Utility\Normalizer;
use Mpietrucha\Utility\Type;

/**
 * @phpstan-import-type RepeaterInput from \Mpietrucha\Nova\Fields\Repeater\Encoder
 * @phpstan-import-type RepeaterOutput from \Mpietrucha\Nova\Fields\Repeater\Encoder
 */
class Encoder extends \Mpietrucha\Nova\Fields\Repeater\Encoder
{
    /**
     * @param  RepeaterInput  $translation
     * @return RepeaterOutput
     */
    public function __invoke(array $translation): array
    {
        $fields = static::fields($translation);

        $key = Select::property() |> $fields->get(...);

        if (Type::null($key)) {
            return [];
        }

        return [$key => Textarea::property() |> $fields->get(...) |> Normalizer::string(...)];
    }
}
