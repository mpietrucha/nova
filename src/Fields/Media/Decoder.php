<?php

namespace Mpietrucha\Nova\Fields\Media;

class Decoder extends \Mpietrucha\Nova\Fields\Repeater\Decoder
{
    /**
     * @return RepeatableTransformerInputFrame
     */
    public function __invoke(string $path, int $index): array
    {
        $fields = $this->fields($path, $index);

        return static::build(Repeatable::key(), $fields);
    }

    /**
     * @return RepeatableTransformerInputFrameFields
     */
    protected function fields(string $path, int $index): array
    {
        return [
            Index::property() => $index,
            Repeatable::property() => $path,
        ];
    }
}
