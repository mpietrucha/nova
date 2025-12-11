<?php

namespace Mpietrucha\Nova\Enums;

use Laravel\Nova\Nova;
use Mpietrucha\Nova\Enums\Contracts\InteractsWithEnumInterface;
use Mpietrucha\Utility\Concerns\Creatable;
use Mpietrucha\Utility\Contracts\CreatableInterface;

class Option implements CreatableInterface
{
    use Creatable;

    public function __construct(protected string $key, protected string $value)
    {
    }

    /**
     * @return array<string, string>
     */
    public function __invoke(InteractsWithEnumInterface $enum): array
    {
        return [
            $this->key() => $enum->value(),
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
