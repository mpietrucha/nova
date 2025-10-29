<?php

namespace Mpietrucha\Nova\Fields\Replicate;

abstract class Defaults
{
    /**
     * @return array<string, string>
     */
    public static function get(): array
    {
        return [
            'rules' => 'rules',
            'requiredCallback' => 'required',
        ];
    }
}
