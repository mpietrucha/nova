<?php

namespace Mpietrucha\Nova\Fields\Translation;

use Illuminate\Database\Eloquent\Model;
use Mpietrucha\Nova\Fields\Translation\Exception\TranslatableModelException;
use Mpietrucha\Utility\Collection;
use Mpietrucha\Utility\Concerns\Compatible;
use Mpietrucha\Utility\Concerns\Creatable;
use Mpietrucha\Utility\Contracts\CompatibleInterface;
use Mpietrucha\Utility\Contracts\CreatableInterface;
use Mpietrucha\Utility\Instance;
use Spatie\Translatable\HasTranslations;

abstract class Transformer implements CompatibleInterface, CreatableInterface
{
    use Compatible, Creatable;

    public static function key(): string
    {
        return 'nova_temporary_translations';
    }

    /**
     * @param  array<int, array{type: string, fields: array<string, string>}>  $translations
     * @return array<string, string>
     */
    public static function encode(array $translations): array
    {
        $translations = Encoder::create() |> Collection::create($translations)->map(...);

        return $translations->collapse()->all();
    }

    /**
     * @param  array<string, string>  $translations
     * @return array<int, array{type: string, fields: array<string, string>}>
     */
    public static function decode(array $translations): array
    {
        $translations = Decoder::create() |> Collection::create($translations)->map(...);

        $translations->isEmpty() && Decoder::empty() |> $translations->push(...);

        return $translations->values()->all();
    }

    public static function hydrate(mixed $model, string $attribute): string
    {
        static::using($model);

        $translations = $model->getTranslations($attribute) |> static::decode(...);

        $model->offsetSet($key = static::key(), $translations);

        return $key;
    }

    /**
     * @param  array<int, array{type: string, fields: array<string, string>}>  $translations
     */
    public static function set(mixed $model, string $attribute, array $translations): void
    {
        static::using($model);

        $translations = static::encode($translations);

        static::key() |> $model->offsetUnset(...);

        $model->forgetTranslations($attribute);

        $model->setTranslations($attribute, $translations);
    }

    protected static function using(mixed $model): void
    {
        if (static::compatible($model)) {
            return;
        }

        TranslatableModelException::create()->throw();
    }

    /**
     * @phpstan-assert-if-true \Illuminate\Database\Eloquent\Model $model
     */
    protected static function compatibility(object $model): bool
    {
        if (Instance::not($model, Model::class)) {
            return false;
        }

        return Instance::traits($model)->contains(HasTranslations::class);
    }
}
