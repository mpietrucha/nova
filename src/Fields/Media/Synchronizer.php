<?php

namespace Mpietrucha\Nova\Fields\Media;

use Mpietrucha\Nova\Fields\Media\Synchronizer\Bucket;
use Mpietrucha\Nova\Fields\Media\Synchronizer\Input;
use Mpietrucha\Utility\Collection;
use Mpietrucha\Utility\Enumerable\Contracts\EnumerableInterface;

/**
 * @phpstan-import-type RepeaterOutput from \Mpietrucha\Nova\Fields\Repeater\Transformer
 */
abstract class Synchronizer
{
    /**
     * @param  RepeaterOutput  $output
     */
    public static function synchronize(mixed $model, string $attribute, array $output, ?string $disk = null): void
    {
        $bucket = Adapter::get($model, $attribute) |> Bucket::build(...);

        Adapter::clear($model, $attribute);

        static::get($bucket, $model, $output)->each->build($attribute, $disk);

        Bucket::flush();
    }

    /**
     * @param  RepeaterOutput  $output
     * @return \Mpietrucha\Utility\Enumerable\Contracts\EnumerableInterface<string, \Mpietrucha\Nova\Fields\Media\Adapter\Builder>
     */
    public static function get(Bucket $bucket, mixed $model, array $output): EnumerableInterface
    {
        return Collection::create($output)->pipeThrough([
            fn (EnumerableInterface $output) => $output->whereInstanceOf(Input::class),
            fn (EnumerableInterface $output) => $output->map->get($bucket),
            fn (EnumerableInterface $output) => $output->filter(),
            fn (EnumerableInterface $output) => Adapter::builder($model) |> $output->map(...),
        ]);
    }
}
