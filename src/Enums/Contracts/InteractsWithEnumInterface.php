<?php

namespace Mpietrucha\Nova\Enums\Contracts;

interface InteractsWithEnumInterface extends \Mpietrucha\Utility\Enums\Contracts\InteractsWithEnumInterface
{
    /**
     * @return class-string<static>
     */
    public static function options(): string;

    public function label(): string;
}
