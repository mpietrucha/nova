<?php

namespace Mpietrucha\Nova\Fields;

use Mpietrucha\Nova\Fields\External\Concerns\InteractsWithExternal;
use Mpietrucha\Nova\Fields\External\Contracts\InteractsWithExternalInterface;

class Audio extends \Laravel\Nova\Fields\Audio implements InteractsWithExternalInterface
{
    use InteractsWithExternal;
}
