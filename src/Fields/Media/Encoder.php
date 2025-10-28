<?php

namespace Mpietrucha\Nova\Fields\Media;

class Encoder extends \Mpietrucha\Nova\Fields\Repeatable\Encoder
{
    /**
     * @param  RepeatableTransformerInputFrame  $media
     * @return RepeatableTransformerOutputFrame
     */
    public function __invoke(array $media): array
    {
        $fields = static::fields($media);

        return [
            $fields->keys()->first() => $fields->values()->first(),
        ];
    }
}
