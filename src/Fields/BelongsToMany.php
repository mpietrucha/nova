<?php

namespace Mpietrucha\Nova\Fields;

use Mpietrucha\Utility\Arr;
use Mpietrucha\Utility\Concerns\Arrayable;
use Mpietrucha\Utility\Contracts\ArrayableInterface;
use Mpietrucha\Utility\Value;

/**
 * @implements \Mpietrucha\Utility\Contracts\ArrayableInterface<int, \Laravel\Nova\Fields\Field>
 */
class BelongsToMany extends \Laravel\Nova\Fields\BelongsToMany implements ArrayableInterface
{
    use Arrayable;

    protected mixed $configurator = null;

    public function configure(callable $configurator): static
    {
        $this->configurator = $configurator;

        return $this;
    }

    public function tag(): Tag
    {
        return $this->configurator(...) |> Tag::replicate($this)->displayAsList()->tap(...);
    }

    public function toArray(): array
    {
        $fields = Arr::overlap($this);

        if (Tag::incompatible()) {
            return $fields;
        }

        return Arr::prepend($fields, $this->tag());
    }

    protected function configurator(): callable
    {
        return $this->configurator ?? Value::identity();
    }
}
