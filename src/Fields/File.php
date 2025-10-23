<?php

namespace Mpietrucha\Nova\Fields;

use Mpietrucha\Nova\Fields\Media\Concerns\InteractsWithExternal;
use Mpietrucha\Nova\Fields\Media\Contracts\InteractsWithExternalInterface;

class File extends \Laravel\Nova\Fields\File implements InteractsWithExternalInterface
{
    use InteractsWithExternal;
}
