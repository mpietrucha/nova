<?php

namespace Mpietrucha\Nova\Fields;

use Mpietrucha\Nova\Fields\External\Concerns\InteractsWithExternal;
use Mpietrucha\Nova\Fields\External\Contracts\InteractsWithExternalInterface;

class Avatar extends \Laravel\Nova\Fields\Avatar implements InteractsWithExternalInterface
{
    use InteractsWithExternal;
}
