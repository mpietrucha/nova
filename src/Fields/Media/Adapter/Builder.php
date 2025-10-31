<?php

namespace Mpietrucha\Nova\Fields\Media\Adapter;

use Illuminate\Http\UploadedFile;
use Mpietrucha\Nova\Fields\Media\Exception\AdapterBuilderException;
use Mpietrucha\Nova\Fields\Media\Storage;
use Mpietrucha\Utility\Concerns\Creatable;
use Mpietrucha\Utility\Contracts\CreatableInterface;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\MediaCollections\FileAdder as Adapter;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Builder implements CreatableInterface
{
    use Creatable;

    protected ?Adapter $adapter = null;

    public function __construct(protected HasMedia $model)
    {
    }

    public function __invoke(string|UploadedFile $file): static
    {
        return $this->add($file);
    }

    public function add(string|UploadedFile $file): static
    {
        $this->adapter = $this->model()->addMedia($file);

        return $this;
    }

    public function build(string $attribute, ?string $disk = null): Media
    {
        $disk = Storage::disk($disk);

        return $this->adapter()->toMediaCollection($attribute, $disk);
    }

    protected function adapter(): Adapter
    {
        return $this->adapter ?? AdapterBuilderException::create()->throw();
    }

    protected function model(): HasMedia
    {
        return $this->model;
    }
}
