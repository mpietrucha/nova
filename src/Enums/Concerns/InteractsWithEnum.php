<?php

namespace Mpietrucha\Nova\Enums\Concerns;

use Mpietrucha\Utility\Str;

/**
 * @phpstan-require-implements \Mpietrucha\Nova\Enums\Contracts\InteractsWithEnumInterface
 */
trait InteractsWithEnum
{
    use \Mpietrucha\Utility\Enums\Concerns\InteractsWithEnum;

    public static function options(): string
    {
        return static::class;
    }

    public function label(): string
    {
        $label = $this->value() |> Str::of(...);

        if ($label->upper()->exactly($label)) {
            return $label;
        }

        return $label->headline()->lower()->ucfirst();
    }

    public function name(): string
    {
        return $this->label();
    }
}
