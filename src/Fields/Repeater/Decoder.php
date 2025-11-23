<?php

namespace Mpietrucha\Nova\Fields\Repeater;

use Mpietrucha\Nova\Fields\Repeater\Enums\Frame;
use Mpietrucha\Utility\Concerns\Creatable;
use Mpietrucha\Utility\Contracts\CreatableInterface;

/**
 * @phpstan-import-type RepeaterFields from \Mpietrucha\Nova\Fields\Repeater\Contracts\TransformerInterface
 * @phpstan-import-type RepeaterInput from \Mpietrucha\Nova\Fields\Repeater\Contracts\TransformerInterface
 */
abstract class Decoder implements CreatableInterface
{
    use Creatable;

    /**
     * @param  RepeaterFields  $fields
     * @return RepeaterInput
     */
    final protected static function build(string $type, array $fields): array
    {
        return [
            Frame::TYPE->value => $type,
            Frame::FIELDS->value => $fields,
        ];
    }
}
