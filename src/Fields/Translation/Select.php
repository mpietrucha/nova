<?php

namespace Mpietrucha\Nova\Fields\Translation;

use Illuminate\Validation\Rule;
use Mpietrucha\Laravel\Package\Translations\Concerns\InteractsWithTranslations;
use Mpietrucha\Nova\Concerns\InteractsWithRequest;
use Mpietrucha\Nova\Contracts\InteractsWithRequestInterface;
use Mpietrucha\Nova\Fields\Translation\Concerns\InteractsWithTranslation;
use Mpietrucha\Nova\Fields\Translation\Contracts\InteractsWithTranslationInterface;
use Mpietrucha\Nova\Fields\Translation\Validation\Language;
use Mpietrucha\Utility\Arr;

class Select extends \Laravel\Nova\Fields\Select implements InteractsWithRequestInterface, InteractsWithTranslationInterface
{
    use InteractsWithRequest, InteractsWithTranslation, InteractsWithTranslations;

    /**
     * @var array<int, array<string, mixed>>|null
     */
    protected ?array $selectable = null;

    protected static mixed $language = null;

    protected static mixed $languages = null;

    /**
     * @param  callable|iterable<string, string>|class-string<\BackedEnum>  $languages
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

    protected function configure(): void
    {
        $this->defaultCallback = static::$language;

        $this->optionsCallback = static::$languages;

        Validation::apply($this, [
            Language::create(),
            Arr::pluck($this->selectable(), 'value') |> Rule::in(...),
        ]);
    }

    /**
     * @return array<int, array<string, mixed>>
     */
    protected function serializeOptions(bool $searchable): array
    {
        return $this->selectable();
    }

    /**
     * @return array<int, array<string, mixed>>
     */
    protected function selectable(): array
    {
        return $this->selectable ??= static::request() |> $this->isSearchable(...) |> parent::serializeOptions(...);
    }

    protected static function hydrate(): string
    {
        return static::__('translation.fields.language');
    }
}
