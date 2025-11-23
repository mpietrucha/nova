<?php

namespace Mpietrucha\Nova\Fields\Media;

/**
 * @phpstan-import-type RepeaterFields from \Mpietrucha\Nova\Fields\Repeater\Decoder
 * @phpstan-import-type RepeaterInput from \Mpietrucha\Nova\Fields\Repeater\Decoder
 */
class Decoder extends \Mpietrucha\Nova\Fields\Repeater\Decoder
{
    /**
     * @return RepeaterInput
     */
    public function __invoke(string $path, int $index): array
    {
        $fields = $this->fields($path, $index);

        return static::build(Repeatable::key(), $fields);
    }

    /**
     * @return RepeaterFields
     */
    protected function fields(string $path, int $index): array
    {
        return [
            Index::property() => $index,
            Repeatable::property() => $path,
        ];
    }
}
