<?php

namespace Mpietrucha\Nova\Fields\Repeatable\Contracts;

use Mpietrucha\Utility\Contracts\CompatibleInterface;

interface TransformerInterface extends CompatibleInterface
{
    public function decoder(): callable;

    public function encoder(): callable;

    public function encode(array $input): array;

    public function decode(array $output): array;

    public function hydrate(mixed $model, string $attribute): string;

    public function fill(mixed $model, string $attribute, array $output): void;

    public function get(Model $model, string $attribute): array;

    public function set(Model $model, string $attribute, array $output): void;
}
