<?php

namespace Mpietrucha\Nova\Fields;

use Mpietrucha\Nova\Fields\Media\Concerns\InteractsWithExternal;
use Mpietrucha\Nova\Fields\Media\Concerns\InteractsWithMedia;
use Mpietrucha\Nova\Fields\Media\Contracts\InteractsWithExternalInterface;
use Mpietrucha\Nova\Fields\Media\Contracts\InteractsWithMediaInterface;

class Avatar extends \Laravel\Nova\Fields\Avatar implements InteractsWithExternalInterface, InteractsWithMediaInterface
{
    use InteractsWithExternal, InteractsWithMedia;
}
