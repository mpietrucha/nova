<?php

namespace Mpietrucha\Nova\Enum\Contracts;

interface InteractsWithNovaInterface
{
    public static function options(): string;

    public static function default(): static;

    public function name(): string;
}
