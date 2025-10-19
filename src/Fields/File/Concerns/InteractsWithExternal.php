<?php

namespace Mpietrucha\Nova\Fields\File\Concerns;

use Laravel\Nova\Fields\Field;
use Mpietrucha\Nova\Fields\Concerns\InteractsWithRequest;
use Mpietrucha\Nova\Fields\Text;

trait InteractsWithExternal
{
    use InteractsWithRequest;

    public function external(): Field
    {
        // $this->store();
        // $this->download()
        // $this->delete()

        if (static::request()->isPresentationRequest()) {
            return $this;
        }

        return Text::replicate($this);
    }
}
