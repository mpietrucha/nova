<?php

namespace Mpietrucha\Nova\Fields\File\Contracts;

use Mpietrucha\Nova\Fields\Audio;
use Mpietrucha\Nova\Fields\Avatar;
use Mpietrucha\Nova\Fields\Contracts\InteractsWithRequestInterface;
use Mpietrucha\Nova\Fields\File;
use Mpietrucha\Nova\Fields\File\Proxy;
use Mpietrucha\Nova\Fields\Image;

interface InteractsWithExternalInterface extends InteractsWithRequestInterface
{
    public function external(): Audio|Avatar|File|Image|Proxy;
}
