<?php

namespace Mpietrucha\Nova\Fields\Translation;

use Mpietrucha\Nova\Concerns\InteractsWithTranslations;
use Mpietrucha\Nova\Fields\Translation\Concerns\InteractsWithTranslation;
use Mpietrucha\Nova\Fields\Translation\Contracts\InteractsWithTranslationInterface;

class Textarea extends \Mpietrucha\Nova\Fields\Textarea implements InteractsWithTranslationInterface
{
    use InteractsWithTranslation, InteractsWithTranslations;

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
        return static::__('translation.fields.translation');
    }
}
