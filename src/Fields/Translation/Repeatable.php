<?php

namespace Mpietrucha\Nova\Fields\Translation;

use Laravel\Nova\Http\Requests\NovaRequest;
use Mpietrucha\Laravel\Package\Translations\Concerns\InteractsWithTranslations;
use Mpietrucha\Utility\Utilizer\Concerns\Utilizable;
use Mpietrucha\Utility\Utilizer\Contracts\UtilizableInterface;

class Repeatable extends \Laravel\Nova\Fields\Repeater\Repeatable implements UtilizableInterface
{
    use InteractsWithTranslations, Utilizable\Strings;

    public static function label(): string
    {
        return static::utilize();
    }

    /**
     * @return list<\Mpietrucha\Nova\Fields\Translation\Contracts\InteractsWithTranslationInterface>
     */
    public function fields(NovaRequest $request): array
    {
        return [
            Select::make(),
            Textarea::make(),
        ];
    }

    protected static function hydrate(): string
    {
        return static::__('translation.repeater');
    }
}
