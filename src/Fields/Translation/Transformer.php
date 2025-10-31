<?php

namespace Mpietrucha\Nova\Fields\Translation;

use Illuminate\Database\Eloquent\Model;
use Mpietrucha\Nova\Fields\Translation\Exception\ResourceModelException;
use Mpietrucha\Utility\Instance;
use Spatie\Translatable\HasTranslations;

/**
 * @phpstan-type TModel \Illuminate\Database\Eloquent\Model&\Mpietrucha\Nova\Fields\Translation\Contracts\InteractsWithTranslationsInterface
 */
class Transformer extends \Mpietrucha\Nova\Fields\Repeater\Transformer
{
    public static function model(mixed $model): void
    {
        parent::model($model);

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

    /**
     * @param  TModel  $model
     */
    protected function get(Model $model, string $attribute): array
    {
        return $model->getTranslations($attribute);
    }

    /**
     * @param  TModel  $model
     */
    protected function set(Model $model, string $attribute, array $output): void
    {
        $model->forgetTranslations($attribute);

        /** @var array<string, string> $output */
        $model->setTranslations($attribute, $output);
    }
}
