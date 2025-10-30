<?php

namespace Mpietrucha\Nova\Fields\Translation;

use Illuminate\Database\Eloquent\Model;
use Mpietrucha\Nova\Fields\Translation\Exception\ResourceModelException;
use Mpietrucha\Utility\Instance;
use Spatie\Translatable\HasTranslations;

class Transformer extends \Mpietrucha\Nova\Fields\Repeater\Transformer
{
    public static function using(mixed $model): void
    {
        parent::using($model);

        Instance::traits($model)->doesntContain(HasTranslations::class) && ResourceModelException::create()->throw();
    }

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
        return parent::decode($output) ?: Decoder::default();
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
}
