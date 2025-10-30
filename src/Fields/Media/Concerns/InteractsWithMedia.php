<?php

namespace Mpietrucha\Nova\Fields\Media\Concerns;

use Laravel\Nova\Http\Requests\NovaRequest;
use Mpietrucha\Nova\Fields\Media\Storage;
use Mpietrucha\Nova\Fields\Media\Validation;
use Mpietrucha\Nova\Fields\Replicate\Concerns\Replicatable;

/**
 * phpstan-require-implements \Mpietrucha\Nova\Fields\File\Contracts\InteractsWithMediaInterface
 */
trait InteractsWithMedia
{
    use Replicatable\Media;

    public function __construct(string $name, mixed $attribute = null, ?string $disk = null)
    {
        parent::__construct($name, $attribute, $disk);

        Storage::preview(...) |> $this->preview(...);
        Storage::thumbnail(...) |> $this->thumbnail(...);
    }

    public function enableDownload(bool $enabled = true): static
    {
        $this->downloadsAreEnabled = $enabled;

        return $this;
    }

    public function getRules(NovaRequest $request): array
    {
        Validation::assign($this);

        return parent::getRules($request);
    }
}
