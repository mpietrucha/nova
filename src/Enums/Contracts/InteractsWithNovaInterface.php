<?php

namespace Mpietrucha\Nova\Enums\Contracts;

use BackedEnum;

interface InteractsWithNovaInterface extends BackedEnum
{
    /**
     * @return class-string<static>
     */
    public static function options(): string;

    public static function default(): static;

    public function name(): string;
}
