<?php

namespace Mpietrucha\Nova\Fields\Translation;

use Mpietrucha\Utility\Normalizer;
use Mpietrucha\Utility\Utilizer\Concerns\Utilizable;
use Mpietrucha\Utility\Utilizer\Contracts\UtilizableInterface;

/**
 * @phpstan-import-type RepeaterOutput from \Mpietrucha\Nova\Fields\Translation\Encoder
 */
abstract class Output implements UtilizableInterface
{
    use Utilizable\Strings;

    /**
     * @return RepeaterOutput
     */
    public static function default(?string $translation = null): array
    {
        return [static::utilize() => Normalizer::string($translation)];
    }
}
