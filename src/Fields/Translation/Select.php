<?php

namespace Mpietrucha\Nova\Fields\Translation;

use Mpietrucha\Nova\Fields\Translation\Concerns\InteractsWithField;
use Mpietrucha\Nova\Fields\Translation\Contracts\InteractsWithFieldInterface;
use Mpietrucha\Utility\Normalizer;

class Select extends \Laravel\Nova\Fields\Select implements InteractsWithFieldInterface
{
    use InteractsWithField;

    final public static function property(): string
    {
        return 'language';
    }

    protected static function hydrate(): string
    {
        return __('Language') |> Normalizer::string(...);
    }
}
