<?php

namespace Mpietrucha\Nova\Fields\Media;

use Mpietrucha\Nova\Fields\Media\Synchronizer\Input;

/**
 * @phpstan-import-type RepeaterInput from \Mpietrucha\Nova\Fields\Repeater\Encoder
 * @phpstan-import-type RepeaterOutput from \Mpietrucha\Nova\Fields\Repeater\Encoder
 * @phpstan-import-type EncoderFieldsCollection from \Mpietrucha\Nova\Fields\Repeater\Encoder
 */
class Encoder extends \Mpietrucha\Nova\Fields\Repeater\Encoder
{
    /**
     * @param  RepeaterInput  $media
     * @return RepeaterOutput
     */
    public function __invoke(array $media, int $index): array
    {
        $input = static::fields($media) |> Input::build(...);

        return [$index => $input];
    }
}
