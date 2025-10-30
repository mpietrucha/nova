<?php

namespace Mpietrucha\Nova\Fields\Media;

use Mpietrucha\Nova\Fields\Media\Synchronizer\Input;

class Encoder extends \Mpietrucha\Nova\Fields\Repeater\Encoder
{
    /**
     * @param  RepeatableTransformerInputFrame  $media
     * @return RepeatableTransformerOutputFrame
     */
    public function __invoke(array $media, int $index): array
    {
        $input = static::fields($media) |> Input::build(...);

        return [$index => $input];
    }
}
