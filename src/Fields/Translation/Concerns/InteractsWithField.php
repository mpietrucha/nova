<?php

namespace Mpietrucha\Nova\Fields\Translation\Concerns;

use Mpietrucha\Utility\Utilizer\Concerns\Utilizable;

/**
 * @phpstan-require-implements \Mpietrucha\Nova\Fields\Translation\Contracts\InteractsWithFieldInterface
 */
trait InteractsWithField
{
    use Utilizable\Strings;

    public function __construct()
    {
        parent::__construct(static::name(), static::property());
    }

    public static function name(): string
    {
        return static::utilize();
    }
}
