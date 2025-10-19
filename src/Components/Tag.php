<?php

namespace Mpietrucha\Nova\Components;

use Laravel\Nova\Asset;
use Mpietrucha\Nova\Components\Contracts\TagInterface;
use Mpietrucha\Utility\Concerns\Creatable;
use Mpietrucha\Utility\Contracts\CreatableInterface;

abstract class Tag implements CreatableInterface, TagInterface
{
    use Creatable;

    public function __construct(protected Asset $asset)
    {
    }

    protected function asset(): Asset
    {
        return $this->asset;
    }
}
