<?php

namespace Mpietrucha\Nova\Cards\Filterable\Contracts;

use Illuminate\Contracts\Database\Eloquent\Builder;
use JsonSerializable;

interface FilterInterface extends JsonSerializable
{
    public function name(): string;

    public function value(): string;

    public function handler(): mixed;

    public function apply(Builder $query, string $attribute, mixed $value): void;

    /**
     * @return array{name: string, value: string}
     */
    public function jsonSerialize(): array;
}
