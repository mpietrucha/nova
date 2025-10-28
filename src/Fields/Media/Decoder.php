<?php

namespace Mpietrucha\Nova\Fields\Media;

class Decoder extends \Mpietrucha\Nova\Fields\Repeatable\Decoder
{
    /**
     * @return RepeatableTransformerInputFrame
     */
    public function __invoke(string $name, string $url): array
    {
        return [];
    }
}
