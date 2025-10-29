<?php

namespace Mpietrucha\Nova\Fields\Media;

use Laravel\Nova\Http\Requests\NovaRequest;
use Mpietrucha\Nova\Fields\Media\Contracts\InteractsWithMediaInterface;
use Mpietrucha\Nova\Fields\Media\Exception\RepeatableFieldsException;
use Mpietrucha\Utility\Utilizer\Concerns\Utilizable;
use Mpietrucha\Utility\Utilizer\Contracts\UtilizableInterface;

class Repeatable extends \Laravel\Nova\Fields\Repeater\Repeatable implements UtilizableInterface
{
    use Utilizable;

    public static function use(?InteractsWithMediaInterface $field = null): void
    {
        static::utilizable($field);
    }

    public static function field(): InteractsWithMediaInterface
    {
        return static::utilize() ?? RepeatableFieldsException::create()->throw();
    }

    public static function property(): string
    {
        return static::field()->attribute;
    }

    public static function label(): string
    {
        return static::field()->name;
    }

    /**
     * @return list<\Mpietrucha\Nova\Fields\Media\Contracts\InteractsWithMediaInterface|\Mpietrucha\Nova\Fields\Media\Index>
     */
    public function fields(NovaRequest $request): array
    {
        return [
            Index::make(), /** @phpstan-ignore arguments.count */
            static::field() |> static::field()::clone(...),
        ];
    }
}
