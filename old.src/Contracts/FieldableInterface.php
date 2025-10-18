<?php

namespace App\Nova\Contracts;

use Mpietrucha\Utility\Contracts\CreatableInterface;

interface FieldableInterface extends CreatableInterface
{
    public static function make(string $name, mixed ...$parameters): FieldableInterface;
}
