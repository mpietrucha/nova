<?php

namespace Mpietrucha\Nova\Concerns;

use Mpietrucha\Utility\Normalizer;
use Mpietrucha\Utility\Str;
use Mpietrucha\Utility\Type;

trait InteractsWithTranslations
{
    /**
     * @param  null|array<string, string>  $replace
     */
    protected static function __(string $key, ?array $replace = null): string
    {
        $key = Str::sprintf('mpietrucha-nova::%s', $key);

        return __($key, Normalizer::array($replace)); /** @phpstan-ignore argument.type */
    }
}
