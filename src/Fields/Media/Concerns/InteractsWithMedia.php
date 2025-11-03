<?php

namespace Mpietrucha\Nova\Fields\Media\Concerns;

use Laravel\Nova\Http\Requests\NovaRequest;
use Mpietrucha\Nova\Fields\Media\Storage;
use Mpietrucha\Nova\Fields\Media\Validation;
use Mpietrucha\Nova\Fields\Replicate\Concerns\Replicatable;
use Mpietrucha\Utility\Normalizer;

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

    public function persistent(bool $persistent = true): static
    {
        return Normalizer::not($persistent) |> $this->deletable(...);
    }

    public function getRules(NovaRequest $request): array
    {
        Validation::required($this) && $this->persistent();

        Validation::media($this);

        return parent::getRules($request);
    }
}
