<?php

namespace Mpietrucha\Nova\Fields;

use Mpietrucha\Nova\Fields\Media\Concerns\InteractsWithExternal;
use Mpietrucha\Nova\Fields\Media\Contracts\InteractsWithExternalInterface;

class Audio extends \Laravel\Nova\Fields\Audio implements InteractsWithExternalInterface
{
    use InteractsWithExternal;
}
