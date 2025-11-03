<?php

namespace Mpietrucha\Nova\Concerns;

use Mpietrucha\Utility\Instance\Path;

/**
 * @phpstan-require-implements \Mpietrucha\Nova\Contracts\InteractsWithPanelInterface
 *
 * @phpstan-method static static make()
 */
trait InteractsWithPanel
{
    public function __construct()
    {
        parent::__construct(static::name(), static::fields());
    }

    public static function name(): string
    {
        return Path::name(static::class);
    }

    public static function fields(): array
    {
        return [];
    }
}
