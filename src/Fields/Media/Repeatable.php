<?php

namespace Mpietrucha\Nova\Fields\Media;

use Laravel\Nova\Http\Requests\NovaRequest;
use Mpietrucha\Nova\Fields\Media\Contracts\InteractsWithMediaInterface;
use Mpietrucha\Utility\Arr;
use Mpietrucha\Utility\Utilizer\Concerns\Utilizable;
use Mpietrucha\Utility\Utilizer\Contracts\UtilizableInterface;

class Repeatable extends \Laravel\Nova\Fields\Repeater\Repeatable implements UtilizableInterface
{
    use Utilizable;

    public static function use(InteractsWithMediaInterface $field): void
    {
        static::utilizable($field);
    }

    public function fields(NovaRequest $request): array
    {
        return static::utilize() |> Arr::overlap(...);
    }
}
