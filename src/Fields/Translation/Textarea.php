<?php

namespace Mpietrucha\Nova\Fields\Translation;

use Mpietrucha\Nova\Fields\Translation\Concerns\InteractsWithTranslation;
use Mpietrucha\Nova\Fields\Translation\Contracts\InteractsWithTranslationInterface;

class Textarea extends \Mpietrucha\Nova\Fields\Textarea implements InteractsWithTranslationInterface
{
    use InteractsWithTranslation;

    final public static function property(): string
    {
        return 'translation';
    }

    protected function configure(): void
    {
        $this->rows(2);
    }

    protected static function hydrate(): string
    {
        return __('mpietrucha-nova::translation.fields.translation');
    }
}
