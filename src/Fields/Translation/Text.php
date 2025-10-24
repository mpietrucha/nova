<?php

namespace Mpietrucha\Nova\Fields\Translation;

use Mpietrucha\Nova\Fields\Translation\Concerns\InteractsWithField;
use Mpietrucha\Nova\Fields\Translation\Contracts\InteractsWithFieldInterface;

class Text extends \Mpietrucha\Nova\Fields\Text implements InteractsWithFieldInterface
{
    use InteractsWithField;

    final public static function property(): string
    {
        return 'translation';
    }

    protected static function hydrate(): string
    {
        return __('Translation');
    }
}
