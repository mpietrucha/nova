<?php

namespace Mpietrucha\Nova\Fields;

use Mpietrucha\Utility\Arr;
use Mpietrucha\Utility\Concerns\Arrayable;
use Mpietrucha\Utility\Contracts\ArrayableInterface;
use Mpietrucha\Utility\Value;

/**
 * @implements \Mpietrucha\Utility\Contracts\ArrayableInterface<int, \Laravel\Nova\Fields\Field>
 */
class TaggableBelongsToMany extends BelongsToMany implements ArrayableInterface
{
    use Arrayable;

    protected mixed $configurator = null;

    public function configure(callable $configurator): static
    {
        $this->configurator = $configurator;

        return $this;
    }

    public function toArray(): array
    {
        $fields = Arr::overlap($this);

        if (Tag::incompatible()) {
            return $fields;
        }

        $tag = $this->configurator() |> Tag::replicate($this)->tap(...);

        return Arr::prepend($fields, $tag);
    }

    protected function configurator(): callable
    {
        return $this->configurator ?? Value::identity();
    }
}
