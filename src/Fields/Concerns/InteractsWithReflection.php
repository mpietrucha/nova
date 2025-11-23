<?php

namespace Mpietrucha\Nova\Fields\Concerns;

use Laravel\Nova\Fields\Field;
use Mpietrucha\Nova\Concerns\InteractsWithThrowable;
use Mpietrucha\Utility\Normalizer;
use Mpietrucha\Utility\Reflection;

/**
 * phpstan-require-implements \Mpietrucha\Nova\Fields\Contracts\InteractsWithReflectionInterface
 */
trait InteractsWithReflection
{
    use InteractsWithThrowable;

    /**
     * @var \Mpietrucha\Utility\Reflection<\Laravel\Nova\Fields\Field>|null
     */
    protected ?Reflection $reflection = null;

    public function __construct(protected Field $field)
    {
    }

    public function name(): string
    {
        return $this->reflection()->getName();
    }

    public function supported(string $value): bool
    {
        return false;
    }

    final public function unsupported(string $value): bool
    {
        return $this->supported($value) |> Normalizer::not(...);
    }

    public function reflection(): Reflection
    {
        return $this->reflection ??= $this->field() |> Reflection::create(...);
    }

    protected function field(): Field
    {
        return $this->field;
    }
}
