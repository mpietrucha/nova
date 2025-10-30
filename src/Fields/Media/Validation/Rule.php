<?php

namespace Mpietrucha\Nova\Fields\Media\Validation;

use Closure;
use Illuminate\Validation\Rules\ExcludeIf;
use Laravel\Nova\Fields\Field;
use Mpietrucha\Nova\Fields\Media\Adapter;
use Mpietrucha\Utility\Concerns\Creatable;
use Mpietrucha\Utility\Contracts\CreatableInterface;
use Mpietrucha\Utility\Value;

class Rule implements CreatableInterface
{
    use Creatable;

    public function __construct(protected Field $field)
    {
    }

    public function __invoke(): bool
    {
        $handler = $this->adapter()->exists(...);

        $resource = $this->resource();

        return Value::attempt($handler)->get($resource)->boolean();
    }

    public static function repeatable(): string
    {
        return Repeatable::get();
    }

    public static function get(Field $field): ExcludeIf
    {
        $condition = static::create($field) |> Closure::fromCallable(...);

        return new ExcludeIf($condition);
    }

    protected function adapter(): Adapter
    {
        return $this->field() |> Adapter::create(...);
    }

    protected function resource(): mixed
    {
        return $this->field()->resource;
    }

    protected function field(): Field
    {
        return $this->field;
    }
}
