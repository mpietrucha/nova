<?php

namespace Mpietrucha\Nova\Fields\Enum;

use BackedEnum;
use Laravel\Nova\Nova;
use Mpietrucha\Utility\Concerns\Creatable;
use Mpietrucha\Utility\Contracts\CreatableInterface;
use Mpietrucha\Utility\Normalizer;

class Option implements CreatableInterface
{
    use Creatable;

    public function __construct(protected string $key, protected string $value)
    {
    }

    /**
     * @return array<string, string>
     */
    public function __invoke(BackedEnum $enum): array
    {
        return [
            $this->key() => $enum->value |> Normalizer::string(...),
            $this->value() => Nova::humanize($enum),
        ];
    }

    protected function key(): string
    {
        return $this->key;
    }

    protected function value(): string
    {
        return $this->value;
    }
}
