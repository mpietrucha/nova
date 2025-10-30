<?php

namespace Mpietrucha\Nova\Fields\Media\Contracts;

use Mpietrucha\Nova\Fields\Replicate\Contracts\ReplicatableInterface;

/**
 * @phpstan-require-extends \Laravel\Nova\Fields\File
 */
interface InteractsWithMediaInterface extends ReplicatableInterface
{
    public function enableDownload(bool $enabled = true): static;

    public function persistent(bool $persistent = true): static;
}
