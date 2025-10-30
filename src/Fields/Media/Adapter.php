<?php

namespace Mpietrucha\Nova\Fields\Media;

use Laravel\Nova\Fields\File;
use Laravel\Nova\Http\Requests\NovaRequest;
use Mpietrucha\Nova\Concerns\InteractsWithRequest;
use Mpietrucha\Nova\Contracts\InteractsWithRequestInterface;
use Mpietrucha\Nova\Fields\Media\Exception\MediaException;
use Mpietrucha\Utility\Collection;
use Mpietrucha\Utility\Concerns\Creatable;
use Mpietrucha\Utility\Contracts\CreatableInterface;
use Mpietrucha\Utility\Normalizer;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\StreamedResponse;

class Adapter implements CreatableInterface, InteractsWithRequestInterface
{
    use Creatable, InteractsWithRequest;

    /**
     * @var list<string>
     */
    protected static array $initializers = [
        'resolveUsing',
        'store',
        'thumbnail',
        'preview',
        'download',
        'delete',
    ];

    public function __construct(protected File $field)
    {
    }

    public static function attach(File $field): static
    {
        $adapter = static::create($field);

        $initializers = static::initializers();

        while ($initializer = $initializers->pop()) {
            $adapter->$initializer(...) |> $field->$initializer(...);
        }

        return $adapter;
    }

    public function exists(mixed $model): bool
    {
        return $this->attribute() |> $this->using($model)->hasMedia(...);
    }

    final public function unexists(mixed $model): bool
    {
        return $this->exists($model) |> Normalizer::not(...);
    }

    public function get(mixed $model): Media
    {
        $media = $this->attribute() |> $this->using($model)->getMedia(...);

        return $media->first() ?? MediaException::create()->throw();
    }

    public function resolveUsing(mixed $value, mixed $model): ?string
    {
        if ($this->unexists($model)) {
            return null;
        }

        return $this->get($model)->file_name;
    }

    /**
     * @return array<int, string>
     */
    public function store(NovaRequest $request, mixed $model, string $attribute, string $requestAttribute): array
    {
        $media = $request->file($requestAttribute) |> $this->using($model)->addMedia(...);

        $model->clearMediaCollection($attribute);

        $disk = $this->field()->getStorageDisk() |> Normalizer::string(...);

        $media->toMediaCollection($attribute, $disk);

        return [];
    }

    public function thumbnail(mixed $value, ?string $disk, mixed $model): ?string
    {
        return $this->preview($value, $disk, $model);
    }

    public function preview(mixed $value, ?string $disk, mixed $model): ?string
    {
        if ($this->unexists($model)) {
            return null;
        }

        return $this->get($model)->getUrl();
    }

    public function download(NovaRequest $request, mixed $model): ?StreamedResponse
    {
        if ($this->unexists($model)) {
            return null;
        }

        return static::request() |> $this->get($model)->toResponse(...);
    }

    /**
     * @return array<string, null|string>
     */
    public function delete(NovaRequest $request, mixed $model): array
    {
        $this->exists($model) && $this->get($model)->delete();

        Transformer::key() |> $model->offsetUnset(...);

        return [];
    }

    protected function field(): File
    {
        return $this->field;
    }

    protected function using(mixed $model): HasMedia
    {
        Transformer::using($model);

        return $model;
    }

    protected function attribute(): string
    {
        return $this->field()->attribute;
    }

    /**
     * @return \Mpietrucha\Utility\Collection<int, string>
     */
    protected static function initializers(): Collection
    {
        return static::$initializers |> Collection::create(...);
    }
}
