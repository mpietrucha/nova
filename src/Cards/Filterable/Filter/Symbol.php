<?php

namespace Mpietrucha\Nova\Cards\Filterable\Filter;

use Mpietrucha\Utility\Collection;
use Mpietrucha\Utility\Concerns\Compatible;
use Mpietrucha\Utility\Contracts\CompatibleInterface;

abstract class Symbol implements CompatibleInterface
{
    use Compatible;

    /**
     * @var \Mpietrucha\Utility\Collection<string, string>
     */
    protected static ?Collection $all = null;

    /**
     * @var array<string, string>
     */
    protected static array $defaults = [
        'eq' => '=',
        'ne' => '!=',
        'gt' => '>',
        'gte' => '>=',
        'lt' => '<',
        'lte' => '<=',
    ];

    public static function use(string $symbol, string $value): void
    {
        static::all()->put($symbol, $value);
    }

    public static function get(string $symbol): ?string
    {
        return static::all()->get($symbol);
    }

    /**
     * @return \Mpietrucha\Utility\Collection<string, string>
     */
    protected static function all(): Collection
    {
        return static::$all ??= static::$defaults |> Collection::create(...);
    }

    protected static function compatibility(string $symbol): bool
    {
        return static::all()->has($symbol);
    }
}
