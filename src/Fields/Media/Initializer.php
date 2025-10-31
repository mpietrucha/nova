<?php

namespace Mpietrucha\Nova\Fields\Media;

use Laravel\Nova\Fields\File;
use Laravel\Nova\Http\Requests\NovaRequest;
use Mpietrucha\Nova\Fields\Media\Exception\InitializerException;
use Mpietrucha\Utility\Collection;
use Mpietrucha\Utility\Concerns\Creatable;
use Mpietrucha\Utility\Contracts\CreatableInterface;
use Mpietrucha\Utility\Instance\Method;
use Mpietrucha\Utility\Normalizer;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\StreamedResponse;

class Initializer implements CreatableInterface
{
    use Creatable;

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

    public function __invoke(string $initializer): void
    {
        Method::unexists($this, $initializer) && InitializerException::for($initializer)->throw();

        $this->$initializer(...) |> $this->field()->$initializer(...);
    }

    public static function initialize(File $field): File
    {
        $field |> static::create(...) |> static::initializers()->each(...);

        return $field;
    }

    public function resolveUsing(mixed $value, mixed $model): ?string
    {
        if ($this->unexists($model)) {
            return null;
        }

        return $this->get($model) |> Attribute::name(...);
    }

    /**
     * @return array<int, string>
     */
    public function store(NovaRequest $request, mixed $model, string $attribute, string $key, ?string $disk = null): array
    {
        $media = $request->file($key) |> Adapter::builder($model);

        Adapter::clear($model, $attribute);

        $media->build($attribute, $disk);

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

        return $this->get($model) |> Attribute::url(...);
    }

    public function download(NovaRequest $request, mixed $model): ?StreamedResponse
    {
        return Adapter::download($model, $this->attribute());
    }

    /**
     * @return array<string, null|string>
     */
    public function delete(NovaRequest $request, mixed $model): array
    {
        Adapter::clear($model, $this->attribute());

        Transformer::flush($model);

        return [];
    }

    protected function exists(mixed $model): bool
    {
        return Adapter::exists($model, $this->attribute());
    }

    final protected function unexists(mixed $model): bool
    {
        return $this->exists($model) |> Normalizer::not(...);
    }

    protected function get(mixed $model): Media
    {
        return Adapter::first($model, $this->attribute());
    }

    protected function attribute(): string
    {
        return $this->field()->attribute;
    }

    protected function field(): File
    {
        return $this->field;
    }

    /**
     * @return \Mpietrucha\Utility\Collection<int, string>
     */
    protected static function initializers(): Collection
    {
        return static::$initializers |> Collection::create(...);
    }
}
