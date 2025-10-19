<?php

namespace Mpietrucha\Nova\Fields;

use Mpietrucha\Nova\Fields\File\Concerns\InteractsWithExternal;
use Mpietrucha\Nova\Fields\File\Contracts\InteractsWithExternalInterface;

class Audio extends \Laravel\Nova\Fields\Audio implements InteractsWithExternalInterface
{
    use InteractsWithExternal;
}
