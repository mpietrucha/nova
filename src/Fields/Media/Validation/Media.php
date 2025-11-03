<?php

namespace Mpietrucha\Nova\Fields\Media\Validation;

use Closure;
use Illuminate\Validation\Rules\ExcludeIf;
use Laravel\Nova\Fields\Field;
use Mpietrucha\Nova\Fields\Media\Adapter;
use Mpietrucha\Utility\Concerns\Creatable;
use Mpietrucha\Utility\Contracts\CreatableInterface;
use Mpietrucha\Utility\Value;

class Media implements CreatableInterface
{
    use Creatable;

    public function __construct(protected Field $field)
    {
    }

    public function __invoke(): bool
    {
        $handler = Adapter::exists(...);

        $model = $this->field()->resource;

        return Value::attempt($handler)->boolean($model, $this->field()->attribute);
    }

    public static function get(Field $field): ExcludeIf
    {
        $condition = static::create($field) |> Closure::fromCallable(...);

        return new ExcludeIf($condition);
    }

    protected function field(): Field
    {
        return $this->field;
    }
}
