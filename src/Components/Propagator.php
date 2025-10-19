<?php

namespace Mpietrucha\Nova\Components;

use Laravel\Nova\Asset;
use Laravel\Nova\Nova;
use Laravel\Nova\Script;
use Laravel\Nova\Style;
use Mpietrucha\Utility\Concerns\Creatable;
use Mpietrucha\Utility\Contracts\CreatableInterface;
use Mpietrucha\Utility\Normalizer;

class Propagator implements CreatableInterface
{
    use Creatable;

    /**
     * @phpstan-assert-if-true \Laravel\Nova\Style $asset
     */
    public function style(Asset $asset): bool
    {
        return $asset instanceof Style;
    }

    /**
     * @phpstan-assert-if-true \Laravel\Nova\Script $asset
     */
    public function script(Asset $asset): bool
    {
        return $asset instanceof Script;
    }

    public function asset(Asset $asset): void
    {
        $path = Normalizer::string(null);

        /** @phpstan-ignore match.unhandled */
        match (true) {
            $this->style($asset) => Nova::style($asset, $path),
            $this->script($asset) => Nova::script($asset, $path),
        };
    }
}
