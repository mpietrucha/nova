<?php

namespace Mpietrucha\Nova\Fields\Repeater\Contracts;

use Mpietrucha\Nova\Fields\Repeater;
use Mpietrucha\Utility\Contracts\CompatibleInterface;

interface TransformerInterface extends CompatibleInterface
{
    public static function model(mixed $model): void;

    public function decoder(): callable;

    public function encoder(): callable;

    /**
     * @param  RepeatableTransformerInput  $input
     * @return RepeatableTransformerOutput
     */
    public function encode(array $input): array;

    /**
     * @param  RepeatableTransformerOutput  $output
     * @return RepeatableTransformerInput
     */
    public function decode(array $output): array;

    public function hydrate(Repeater $repeater, mixed $model, string $attribute): string;

    /**
     * @param  RepeatableTransformerInput  $input
     */
    public function fill(Repeater $repeater, mixed $model, string $attribute, array $input): void;
}
