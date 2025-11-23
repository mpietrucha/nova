<?php

namespace Mpietrucha\Nova\Fields\Repeater\Contracts;

use Mpietrucha\Nova\Fields\Repeater;
use Mpietrucha\Utility\Contracts\CompatibleInterface;

/**
 * @phpstan-import-type MixedArray from \Mpietrucha\Utility\Arr
 *
 * @phpstan-type RepeaterFields array<string, mixed>
 * @phpstan-type RepeaterInput array{type: string, fields: RepeaterFields}
 * @phpstan-type RepeaterOutput MixedArray
 */
interface TransformerInterface extends CompatibleInterface
{
    public static function model(mixed $model): void;

    public function decoder(): callable;

    public function encoder(): callable;

    /**
     * @param  list<RepeaterInput>  $input
     * @return RepeaterOutput
     */
    public function encode(array $input): array;

    /**
     * @param  RepeaterOutput  $output
     * @return list<RepeaterInput>
     */
    public function decode(array $output): array;

    public function hydrate(Repeater $repeater, mixed $model, string $attribute): string;

    /**
     * @param  list<RepeaterInput>  $input
     */
    public function fill(Repeater $repeater, mixed $model, string $attribute, array $input): void;
}
