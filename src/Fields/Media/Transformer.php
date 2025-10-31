<?php

namespace Mpietrucha\Nova\Fields\Media;

use Illuminate\Database\Eloquent\Model;
use Mpietrucha\Nova\Fields\Media\Contracts\InteractsWithMediaInterface;

/**
 * @phpstan-type TModel \Illuminate\Database\Eloquent\Model&\Spatie\MediaLibrary\HasMedia
 */
class Transformer extends \Mpietrucha\Nova\Fields\Repeater\Transformer
{
    public function __construct(protected InteractsWithMediaInterface $field)
    {
    }

    public static function model(mixed $model): void
    {
        Adapter::model($model);
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
        $media = Attribute::name(...) |> Adapter::get($model, $attribute)->map(...);

        return $media->all();
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
