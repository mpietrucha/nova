<?php

namespace Mpietrucha\Nova\Fields\Translation\Validation;

use Closure;
use Illuminate\Contracts\Validation\DataAwareRule;
use Illuminate\Contracts\Validation\ValidationRule;
use Mpietrucha\Nova\Concerns\InteractsWithTranslations;
use Mpietrucha\Nova\Fields\Translation\Select;
use Mpietrucha\Utility\Arr;
use Mpietrucha\Utility\Collection;
use Mpietrucha\Utility\Concerns\Creatable;
use Mpietrucha\Utility\Contracts\CreatableInterface;
use Mpietrucha\Utility\Enumerable\Contracts\EnumerableInterface;
use Mpietrucha\Utility\Normalizer;
use Mpietrucha\Utility\Str;

class Language implements CreatableInterface, DataAwareRule, ValidationRule
{
    use Creatable, InteractsWithTranslations;

    /**
     * @var array<array-key, mixed>
     */
    protected array $data;

    /**
     * @param  array<array-key, mixed>  $data
     */
    public function setData(array $data): static
    {
        $this->data = $data;

        return $this;
    }

    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        /** @var string $attribute */
        [$attribute, $index] = Str::explode($attribute, '.');

        if (Normalizer::integer($index) === 0) {
            return;
        }

        $languages = $this->languages($attribute)->whereValueStrict($value);

        if ($languages->count() <= 1) {
            return;
        }

        static::__('translation.validation.language') |> $fail(...);
    }

    /**
     * @return \Mpietrucha\Utility\Enumerable\Contracts\EnumerableInterface<int, string>
     */
    protected function languages(string $attribute): EnumerableInterface
    {
        $translations = $this->translations($attribute);

        $attribute = 'fields.' . Select::property();

        return Arr::pluck($translations, $attribute) |> Collection::create(...);
    }

    /**
     * @return array<int, mixed>
     */
    protected function translations(string $attribute): array
    {
        $data = $this->data();

        return Arr::get($data, $attribute) |> Normalizer::array(...);
    }

    /**
     * @return array<array-key, mixed>
     */
    protected function data(): array
    {
        return $this->data;
    }
}
