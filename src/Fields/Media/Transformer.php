<?php

namespace Mpietrucha\Nova\Fields\Media;

use Illuminate\Database\Eloquent\Model;
use Mpietrucha\Nova\Fields\Media\Exception\ResourceModelException;
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
        /** @phpstan-ignore-next-line method.notFound */
        $media = $model->getMedia($attribute);

        return $media->map->getPathRelativeToRoot()->all();
    }

    protected function set(Model $model, string $attribute, array $output): void
    {
        /** @var \Illuminate\Database\Eloquent\Model&\Spatie\MediaLibrary\HasMedia $model */
        Synchronizer::synchronize($model, $attribute, $output);
    }

    protected static function using(mixed $model): void
    {
        parent::using($model);

        if ($model instanceof HasMedia) {
            return;
        }

        ResourceModelException::create()->throw();
    }
}
