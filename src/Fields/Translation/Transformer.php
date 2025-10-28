<?php

namespace Mpietrucha\Nova\Fields\Translation;

use Illuminate\Database\Eloquent\Model;
use Mpietrucha\Nova\Fields\Translation\Exception\TransformerModelException;
use Mpietrucha\Utility\Arr;
use Mpietrucha\Utility\Instance;
use Spatie\Translatable\HasTranslations;

class Transformer extends \Mpietrucha\Nova\Fields\Repeatable\Transformer
{
    public function encoder(): callable
    {
        return Encoder::create();
    }

    public function decoder(): callable
    {
        return Decoder::create();
    }

    public function decode(array $output): array
    {
        return parent::decode($output) ?: Decoder::empty() |> Arr::overlap(...);
    }

    protected function get(Model $model, string $attribute): array
    {
        return $model->getTranslations($attribute); /** @phpstan-ignore method.notFound */
    }

    protected function set(Model $model, string $attribute, array $output): void
    {
        $model->forgetTranslations($attribute); /** @phpstan-ignore method.notFound */

        /** @phpstan-ignore-next-line method.notFound */
        $model->setTranslations($attribute, $output);
    }

    protected static function using(mixed $model): void
    {
        parent::using($model);

        if (Instance::traits($model)->contains(HasTranslations::class)) {
            return;
        }

        TransformerModelException::create()->throw();
    }
}
