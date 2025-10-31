<?php

namespace Mpietrucha\Nova\Fields\Translation;

use Mpietrucha\Nova\Fields\Translation\Concerns\InteractsWithTranslation;
use Mpietrucha\Nova\Fields\Translation\Contracts\InteractsWithTranslationInterface;

class Text extends \Mpietrucha\Nova\Fields\Text implements InteractsWithTranslationInterface
{
    use InteractsWithTranslation;

    final public static function property(): string
    {
        return 'translation';
    }

    protected static function hydrate(): string
    {
        return __('mpietrucha-nova::translation.fields.translation');
    }
}
