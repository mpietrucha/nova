<?php

namespace Mpietrucha\Nova\Fields;

use Mpietrucha\Nova\Fields\File\Concerns\InteractsWithExternal;
use Mpietrucha\Nova\Fields\File\Contracts\InteractsWithExternalInterface;

class Avatar extends \Laravel\Nova\Fields\Avatar implements InteractsWithExternalInterface
{
    use InteractsWithExternal;
}
