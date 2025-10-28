<?php

namespace Mpietrucha\Nova\Concerns;

use Mpietrucha\Utility\Instance\Path;
use Mpietrucha\Utility\Str;

/**
 * @phpstan-require-implements \Mpietrucha\Nova\Contracts\InteractsWithIndicatorInterface
 */
trait InteractsWithIndicator
{
    public function indicate(): static
    {
        return Str::remove(Path::delimiter(), static::class) |> Str::kebab(...) |> $this->indicator(...);
    }

    public function indicator(string $indicator): static
    {
        return compact('indicator') |> $this->withMeta(...);
    }
}
