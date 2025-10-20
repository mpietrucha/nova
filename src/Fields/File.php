<?php

namespace Mpietrucha\Nova\Fields;

use Mpietrucha\Nova\Fields\External\Concerns\InteractsWithExternal;
use Mpietrucha\Nova\Fields\External\Contracts\InteractsWithExternalInterface;

class File extends \Laravel\Nova\Fields\File implements InteractsWithExternalInterface
{
    use InteractsWithExternal;
}
