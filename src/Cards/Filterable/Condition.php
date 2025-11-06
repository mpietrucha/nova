<?php

namespace Mpietrucha\Nova\Cards\Filterable;

use Laravel\Nova\Makeable;
use Mpietrucha\Nova\Cards\Filterable\Concerns\InteractsWithConditions;
use Mpietrucha\Nova\Cards\Filterable\Concerns\InteractsWithInput;
use Mpietrucha\Nova\Cards\Filterable\Contracts\ConditionInterface;
use Mpietrucha\Nova\Cards\Filterable\Contracts\FilterInterface;
use Mpietrucha\Nova\Cards\Filterable\Exception\ConditionNameException;
use Mpietrucha\Utility\Concerns\Creatable;
use Mpietrucha\Utility\Contracts\CreatableInterface;
use Mpietrucha\Utility\Enumerable\Contracts\EnumerableInterface;
use Mpietrucha\Utility\Str;

class Condition implements ConditionInterface, CreatableInterface
{
    use Creatable, InteractsWithConditions, InteractsWithInput, Makeable;

    /**
     * @var \Mpietrucha\Utility\Enumerable\Contracts\EnumerableInterface<int, \Mpietrucha\Nova\Cards\Filterable\Contracts\FilterInterface>
     */
    protected ?EnumerableInterface $filters = null;

    public function __construct(protected ?string $name = null, protected ?string $attribute = null, mixed $input = null)
    {
        $this->use($input);
    }

    public function name(): string
    {
        return $this->name ?? ConditionNameException::create()->throw();
    }

    public function attribute(): string
    {
        return $this->attribute ??= $this->name() |> Str::lower(...) |> Str::camel(...);
    }

    final public function filters(): EnumerableInterface
    {
        return $this->filters ??= $this->input()->ensure(FilterInterface::class);
    }

    public function jsonSerialize(): array
    {
        return [
            'name' => $this->name(),
            'attribute' => $this->attribute(),
            'filters' => $this->filters()->map->jsonSerialize()->all(),
        ];
    }
}
