<?php

namespace Mpietrucha\Nova\Fields;

use Mpietrucha\Nova\Fields\Enum\Builder;

class BooleanGroup extends \Laravel\Nova\Fields\BooleanGroup
{
    /**
     * @param  callable():(iterable<string, string>)|iterable<string, string>|string  $options
     */
    public function options(callable|iterable|string $options): static
    {
        /** @phpstan-ignore-next-line assign.propertyType */
        $this->optionsCallback = $options;

        return $this;
    }

    /**
     * return array<int, array{label: string, name: string}>
     */
    protected function serializeOptions(): array
    {
        /** @phpstan-ignore-next-line return.type */
        return Builder::options(
            $this->optionsCallback,
            'name',
            'label',
            parent::serializeOptions(...)
        );
    }
}
