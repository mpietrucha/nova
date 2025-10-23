<?php

namespace Mpietrucha\Nova\Fields\Translation;

use Mpietrucha\Nova\Fields\Translation\Concerns\InteractsWithField;
use Mpietrucha\Nova\Fields\Translation\Contracts\InteractsWithFieldInterface;
use Mpietrucha\Utility\Normalizer;

class Select extends \Laravel\Nova\Fields\Select implements InteractsWithFieldInterface
{
    use InteractsWithField;

    protected static mixed $language = null;

    protected static mixed $languages = null;

    /**
     * @phpstan-ignore-next-line missingType.iterableValue
     */
    public static function languages(callable|iterable|string $languages): void
    {
        static::$languages = $languages;
    }

    public static function language(mixed $language): void
    {
        static::$language = $language;
    }

    final public static function property(): string
    {
        return 'language';
    }

    protected static function hydrate(): string
    {
        return __('Language') |> Normalizer::string(...);
    }

    protected function configure(): void
    {
        $this->defaultCallback = static::$language;

        $this->optionsCallback = static::$languages;
    }
}
