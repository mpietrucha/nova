<?php

namespace Mpietrucha\Nova\Fields;

use Mpietrucha\Nova\Fields\Media\Concerns\InteractsWithExternal;
use Mpietrucha\Nova\Fields\Media\Contracts\InteractsWithExternalInterface;

class Avatar extends \Laravel\Nova\Fields\Avatar implements InteractsWithExternalInterface
{
    use InteractsWithExternal;
}
