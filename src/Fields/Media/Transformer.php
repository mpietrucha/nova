<?php

namespace Mpietrucha\Nova\Fields\Media;

use Illuminate\Database\Eloquent\Model;
use Mpietrucha\Nova\Fields\Media\Exception\TransformerModelException;
use Spatie\MediaLibrary\HasMedia;

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

    protected function get(Model $model, string $attribute): array
    {
        return $model->getMedia($attribute)->all();
    }

    protected function set(Model $model, string $attribute, array $output): void
    {
        dd($attribute, $output);
    }

    protected static function using(mixed $model): void
    {
        parent::using($model);

        if ($model instanceof HasMedia) {
            return;
        }

        TransformerModelException::create()->throw();
    }
}
