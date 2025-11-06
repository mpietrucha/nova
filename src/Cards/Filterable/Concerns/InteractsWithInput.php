<?php

namespace Mpietrucha\Nova\Cards\Filterable\Concerns;

use Mpietrucha\Utility\Collection;
use Mpietrucha\Utility\Enumerable\Contracts\EnumerableInterface;
use Mpietrucha\Utility\Normalizer;

/**
 * @phpstan-require-implements \Mpietrucha\Nova\Cards\Filterable\Contracts\InteractsWithInputInterface
 */
trait InteractsWithInput
{
    protected mixed $input = null;

    public function __construct(mixed $input = null)
    {
        $this->use($input);
    }

    public function use(mixed $input): static
    {
        $this->input = Normalizer::array($input);

        return $this;
    }

    /**
     * @return \Mpietrucha\Utility\Collection<int, mixed>
     */
    public function input(): EnumerableInterface
    {
        $input = $this->input |> Collection::create(...);

        return $input->values();
    }
}
