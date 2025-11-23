<?php

namespace Mpietrucha\Nova\Fields\Repeater;

use Illuminate\Database\Eloquent\Model;
use Mpietrucha\Nova\Fields\Repeater;
use Mpietrucha\Nova\Fields\Repeater\Contracts\TransformerInterface;
use Mpietrucha\Nova\Fields\Repeater\Exception\ResourceModelException;
use Mpietrucha\Utility\Collection;
use Mpietrucha\Utility\Concerns\Compatible;
use Mpietrucha\Utility\Concerns\Creatable;
use Mpietrucha\Utility\Contracts\CreatableInterface;
use Mpietrucha\Utility\Str;

/**
 * @phpstan-import-type RepeaterOutput from \Mpietrucha\Nova\Fields\Repeater\Contracts\TransformerInterface
 */
abstract class Transformer implements CreatableInterface, TransformerInterface
{
    use Compatible, Creatable;

    public static function model(mixed $model): void
    {
        static::incompatible($model) && ResourceModelException::create()->throw();
    }

    public static function flush(mixed $model): void
    {
        static::model($model);

        static::key() |> $model->offsetUnset(...);
    }

    public static function key(): string
    {
        return 'repeater_' . static::class |> Str::hash(...);
    }

    public function encode(array $input): array
    {
        $output = $this->encoder() |> Collection::create($input)->map(...);

        return $output->collapseWithKeys()->all();
    }

    public function decode(array $output): array
    {
        $input = $this->decoder() |> Collection::create($output)->map(...);

        return $input->values()->all();
    }

    public function hydrate(Repeater $repeater, mixed $model, string $attribute): string
    {
        static::model($model);

        $input = $this->get($model, $attribute, $repeater) |> $this->decode(...);

        $model->offsetSet($key = static::key(), $input);

        return $key;
    }

    public function fill(Repeater $repeater, mixed $model, string $attribute, array $input): void
    {
        static::model($model);

        $this->set($model, $attribute, $this->encode($input), $repeater);

        static::flush($model);
    }

    /**
     * @return RepeaterOutput
     */
    abstract protected function get(Model $model, string $attribute, Repeater $repeater): array;

    /**
     * @param  RepeaterOutput  $output
     */
    abstract protected function set(Model $model, string $attribute, array $output, Repeater $repeater): void;

    final protected static function compatibility(mixed $model): bool
    {
        return $model instanceof Model;
    }
}
