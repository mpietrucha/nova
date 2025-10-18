<?php

namespace Mpietrucha\Nova\Contracts;

use Mpietrucha\Utility\Contracts\CreatableInterface;

interface FrontendInterface extends CreatableInterface
{
    public function __invoke(): mixed;
}
