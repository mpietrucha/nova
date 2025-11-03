<?php

namespace Mpietrucha\Nova\Fields\Translation;

use Mpietrucha\Utility\Normalizer;
use Mpietrucha\Utility\Utilizer\Concerns\Utilizable;
use Mpietrucha\Utility\Utilizer\Contracts\UtilizableInterface;

abstract class Output implements UtilizableInterface
{
    use Utilizable\Strings;

    /**
     * @return RepeatableTransformerOutput
     */
    public static function default(?string $translation = null): array
    {
        return [static::utilize() => Normalizer::string($translation)];
    }
}
