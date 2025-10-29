<?php

namespace Mpietrucha\Nova\Fields\Repeatable;

use Mpietrucha\Nova\Fields\Repeatable\Enums\Frame;
use Mpietrucha\Utility\Concerns\Creatable;
use Mpietrucha\Utility\Contracts\CreatableInterface;

abstract class Decoder implements CreatableInterface
{
    use Creatable;

    /**
     * @param  RepeatableTransformerInputFrameFields  $fields
     * @return RepeatableTransformerInputFrame
     */
    final protected static function build(string $type, array $fields): array
    {
        return [
            Frame::TYPE->value => $type,
            Frame::FIELDS->value => $fields,
        ];
    }
}
