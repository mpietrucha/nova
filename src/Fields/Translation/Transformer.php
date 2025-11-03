<?php

namespace Mpietrucha\Nova\Fields\Translation;

use Illuminate\Database\Eloquent\Model;
use Mpietrucha\Nova\Concerns\InteractsWithRequest;
use Mpietrucha\Nova\Contracts\InteractsWithRequestInterface;
use Mpietrucha\Nova\Fields\Repeater;
use Mpietrucha\Nova\Fields\Translation\Exception\ResourceModelException;
use Mpietrucha\Utility\Instance;
use Spatie\Translatable\HasTranslations;

/**
 * @phpstan-type TModel \Illuminate\Database\Eloquent\Model&\Mpietrucha\Nova\Fields\Translation\Contracts\InteractsWithTranslationsInterface
 */
class Transformer extends \Mpietrucha\Nova\Fields\Repeater\Transformer implements InteractsWithRequestInterface
{
    use InteractsWithRequest;

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

    /**
     * @param  TModel  $model
     */
    protected function get(Model $model, string $attribute, Repeater $repeater): array
    {
        $translations = $model->getTranslations($attribute);

        if ($this->required($repeater)) {
            $translations = $translations ?: Output::default();
        }

        return $translations;
    }

    /**
     * @param  TModel  $model
     */
    protected function set(Model $model, string $attribute, array $output, Repeater $repeater): void
    {
        $model->forgetTranslations($attribute);

        /** @var array<string, string> $output */
        $model->setTranslations($attribute, $output);
    }

    protected function required(Repeater $repeater): bool
    {
        return static::request() |> $repeater->isRequired(...);
    }
}
