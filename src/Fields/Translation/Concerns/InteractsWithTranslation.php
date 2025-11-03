<?php

namespace Mpietrucha\Nova\Fields\Translation\Concerns;

use Mpietrucha\Nova\Fields\Translation\Validation;
use Mpietrucha\Utility\Instance\Method;
use Mpietrucha\Utility\Throwable\RuntimeException;
use Mpietrucha\Utility\Utilizer\Concerns\Utilizable;

/**
 * @phpstan-require-implements \Mpietrucha\Nova\Fields\Translation\Contracts\InteractsWithTranslationInterface
 *
 * @phpstan-method static static make()
 */
trait InteractsWithTranslation
{
    use Utilizable\Strings;

    public function __construct()
    {
        parent::__construct(static::name(), static::property());

        Validation::apply($this);

        Method::exists($this, 'configure') && $this->configure();
    }

    public static function name(): string
    {
        return static::utilize();
    }

    public static function property(): string
    {
        RuntimeException::create()
            ->message('Uncomposed %s::property() method', static::class)
            ->throw();
    }
}
