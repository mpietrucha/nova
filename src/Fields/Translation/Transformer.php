<?php

namespace Mpietrucha\Nova\Fields\Translation;

use Mpietrucha\Nova\Fields\Translation\Exception\TransformerModelException;
use Mpietrucha\Utility\Arr;
use Mpietrucha\Utility\Instance;

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
        $input = parent::decode($output);

        return $input ?: Decoder::empty() |> Arr::wrap(...);
    }

    public function get(Model $model, string $atttribute): array
    {
        return $model->getTranslations($attribute);
    }

    public function set(Model $model, string $attribute, array $output): void
    {
        $model->forgetTranslations($attribute);

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
