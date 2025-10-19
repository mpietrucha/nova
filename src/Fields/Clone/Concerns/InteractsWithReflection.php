<?php

namespace Mpietrucha\Nova\Fields\Clone\Concerns;

use Laravel\Nova\Fields\Field;
use Mpietrucha\Utility\Normalizer;
use Mpietrucha\Utility\Reflection;

/**
 * @internal
 *
 * phpstan-require-implements \Mpietrucha\Nova\Fields\Clone\Contracts\InteractsWithReflectionInterface
 */
trait InteractsWithReflection
{
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
