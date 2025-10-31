<?php

namespace Mpietrucha\Nova\Fields\Translation\Contracts;

use Mpietrucha\Utility\Utilizer\Contracts\UtilizableInterface;

/**
 * @phpstan-require-extends \Laravel\Nova\Fields\Field
 */
interface InteractsWithTranslationInterface extends UtilizableInterface
{
    public static function name(): string;

    public static function property(): string;
}
