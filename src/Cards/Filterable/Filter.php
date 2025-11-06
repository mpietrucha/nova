<?php

namespace Mpietrucha\Nova\Cards\Filterable;

use Illuminate\Contracts\Database\Eloquent\Builder;
use Laravel\Nova\Makeable;
use Mpietrucha\Nova\Cards\Filterable\Contracts\FilterInterface;
use Mpietrucha\Nova\Cards\Filterable\Exception\FilterException;
use Mpietrucha\Nova\Cards\Filterable\Exception\FilterNameException;
use Mpietrucha\Nova\Cards\Filterable\Exception\FilterValueException;
use Mpietrucha\Nova\Cards\Filterable\Filter\Handler;
use Mpietrucha\Nova\Cards\Filterable\Filter\Symbol;
use Mpietrucha\Nova\Concerns\InteractsWithTranslations;
use Mpietrucha\Utility\Arr;
use Mpietrucha\Utility\Concerns\Compatible;
use Mpietrucha\Utility\Concerns\Creatable;
use Mpietrucha\Utility\Contracts\CompatibleInterface;
use Mpietrucha\Utility\Contracts\CreatableInterface;
use Mpietrucha\Utility\Forward\Concerns\Bridgeable;
use Mpietrucha\Utility\Value;

class Filter implements CompatibleInterface, CreatableInterface, FilterInterface
{
    use Bridgeable, Compatible, Creatable, InteractsWithTranslations, Makeable;

    public function __construct(protected ?string $name = null, protected ?string $value = null, protected mixed $handler = null)
    {
    }

    /**
     * @param  array<array-key, mixed>  $arguments
     */
    public static function __callStatic(string $method, array $arguments): static
    {
        static::incompatible($method) && FilterException::for($method)->throw();

        $value = Symbol::get($method) ?? $method;

        $name = Arr::first($arguments) ?? static::__("filterable.$method");

        return static::relay($method)->make($name, $value, Handler::get($method));
    }

    public static function is(?string $name = null): static
    {
        $name ??= static::__('filterable.is');

        return static::eq($name);
    }

    public static function isNot(?string $name = null): static
    {
        $name ??= static::__('filterable.isNot');

        return static::ne($name);
    }

    public function name(): string
    {
        return $this->name ?? FilterNameException::create()->throw();
    }

    public function value(): string
    {
        return $this->value ?? FilterValueException::create()->throw();
    }

    public function handler(): mixed
    {
        return $this->handler;
    }

    public function apply(Builder $query, string $attribute, mixed $value): void
    {
        $evaluation = $this->handler() |> Value::for(...);

        match (true) { /** @phpstan-ignore match.unhandled */
            $evaluation->supported() => $evaluation->get($query, $attribute, $value),
            $evaluation->unsupported() => $query->where($attribute, $this->value(), $value),
        };
    }

    public function jsonSerialize(): array
    {
        return [
            'name' => $this->name(),
            'value' => $this->value(),
        ];
    }

    protected static function compatibility(string $method): bool
    {
        return Symbol::compatible($method) || Handler::compatible($method);
    }
}
