<?php

namespace Mpietrucha\Nova\Fields\Translation;

use Laravel\Nova\Http\Requests\NovaRequest;
use Mpietrucha\Utility\Utilizer\Concerns\Utilizable;
use Mpietrucha\Utility\Utilizer\Contracts\UtilizableInterface;

class Repeatable extends \Laravel\Nova\Fields\Repeater\Repeatable implements UtilizableInterface
{
    use Utilizable\Strings;

    public static function label(): string
    {
        return static::utilize();
    }

    /**
     * @return list<\Mpietrucha\Nova\Fields\Translation\Contracts\InteractsWithFieldInterface>
     */
    public function fields(NovaRequest $request): array
    {
        return [
            Select::make(), /** @phpstan-ignore arguments.count */
            Text::make(), /** @phpstan-ignore arguments.count */
        ];
    }

    protected static function hydrate(): string
    {
        return __('mpietrucha-nova::translation.repeater');
    }
}
