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
            'updateRules' => 'updateRules',
            'requiredCallback' => 'required',
            'creationRules' => 'creationRules',
        ];
    }
}
