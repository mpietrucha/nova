<?php

namespace Mpietrucha\Nova\Fields\Media;

use Laravel\Nova\Http\Requests\NovaRequest;
use Mpietrucha\Nova\Fields\Media\Contracts\InteractsWithMediaInterface;
use Mpietrucha\Nova\Fields\Media\Exception\RepeatableHydrationException;
use Mpietrucha\Utility\Utilizer\Concerns\Utilizable;
use Mpietrucha\Utility\Utilizer\Contracts\UtilizableInterface;

/**
 * @phpstan-type TMedia \Mpietrucha\Nova\Fields\Media\Contracts\InteractsWithMediaInterface
 */
class Repeatable extends \Laravel\Nova\Fields\Repeater\Repeatable implements UtilizableInterface
{
    use Utilizable;

    public static function use(?InteractsWithMediaInterface $field = null): void
    {
        static::utilizable($field);
    }

    public static function field(): InteractsWithMediaInterface
    {
        return static::utilize() |> Collection::field(...) ?? RepeatableHydrationException::create()->throw();
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
     * @return list<TMedia|\Mpietrucha\Nova\Fields\Media\Index>
     */
    public function fields(NovaRequest $request): array
    {
        return [
            Index::make(), /** @phpstan-ignore arguments.count */
            static::field() |> static::field()::replicate(...) |> static::configure(...),
        ];
    }

    /**
     * @param  TMedia&\Laravel\Nova\Fields\File  $field
     */
    protected static function configure(InteractsWithMediaInterface $field): InteractsWithMediaInterface
    {
        Validation::repeatable($field);

        return $field;
    }
}
