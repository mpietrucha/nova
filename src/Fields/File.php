<?php

namespace Mpietrucha\Nova\Fields;

use Mpietrucha\Nova\Fields\File\Concerns\InteractsWithExternal;
use Mpietrucha\Nova\Fields\File\Contracts\InteractsWithExternalInterface;

class File extends \Laravel\Nova\Fields\File implements InteractsWithExternalInterface
{
    use InteractsWithExternal;
}
