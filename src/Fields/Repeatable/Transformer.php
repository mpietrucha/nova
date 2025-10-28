<?php

namespace Mpietrucha\Nova\Fields\Repeatable;

use Illuminate\Database\Eloquent\Model;
use Mpietrucha\Nova\Fields\Repeatable\Contracts\TransformerInterface;
use Mpietrucha\Nova\Fields\Repeatable\Exception\TransformerModelException;
use Mpietrucha\Utility\Collection;
use Mpietrucha\Utility\Concerns\Compatible;
use Mpietrucha\Utility\Concerns\Creatable;
use Mpietrucha\Utility\Contracts\CreatableInterface;

abstract class Transformer implements CreatableInterface, TransformerInterface
{
    use Compatible, Creatable;

    public static function key(): string
    {
        return 'nova_temporary_transformer_repeater';
    }

    public function encode(array $input): array
    {
        $output = $this->encoder() |> Collection::create($input)->map(...);

        return $output->collapse()->all();
    }

    public function decode(array $output): array
    {
        $input = $this->decoder() |> Collection::create($output)->map(...);

        return $input->values()->all();
    }

    public function hydrate(mixed $model, string $attribute): string
    {
        static::using($model);

        $input = $this->get($model, $attribute) |> static::decode(...);

        $model->offsetSet($key = static::key(), $input);

        return $key;
    }

    public function fill(mixed $model, string $attribute, array $input): void
    {
        static::using($model);

        $output = $this->encode($input);

        $this->set($model, $attribute, $output);
    }

    protected static function using(mixed $model): void
    {
        if (static::compatible($model)) {
            return;
        }

        TransformerModelException::create()->throw();
    }

    protected static function compatibility(mixed $model): bool
    {
        return $model instanceof Model;
    }
}
