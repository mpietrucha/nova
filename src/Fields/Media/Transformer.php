<?php

namespace Mpietrucha\Nova\Fields\Media;

use Illuminate\Database\Eloquent\Model;
use Mpietrucha\Nova\Fields\Media\Contracts\InteractsWithMediaInterface;
use Mpietrucha\Nova\Fields\Media\Exception\ResourceModelException;
use Mpietrucha\Utility\Instance;
use Spatie\MediaLibrary\HasMedia;

/**
 * @phpstan-type TModel \Illuminate\Database\Eloquent\Model&\Spatie\MediaLibrary\HasMedia
 */
class Transformer extends \Mpietrucha\Nova\Fields\Repeater\Transformer
{
    public function __construct(protected InteractsWithMediaInterface $field)
    {
    }

    public static function using(mixed $model): void
    {
        parent::using($model);

        Instance::not($model, HasMedia::class) && ResourceModelException::create()->throw();
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
    protected function get(Model $model, string $attribute): array
    {
        $media = $model->getMedia($attribute);

        return $media->map->getPathRelativeToRoot()->all();
    }

    /**
     * @param  TModel  $model
     */
    protected function set(Model $model, string $attribute, array $output): void
    {
        $disk = $this->field()->getStorageDisk();

        Synchronizer::synchronize($model, $attribute, $output, $disk);
    }

    protected function field(): InteractsWithMediaInterface
    {
        return $this->field;
    }
}
