<?php

namespace Mpietrucha\Nova\Fields\Translation\Contracts;

/**
 * @phpstan-require-extends \Illuminate\Database\Eloquent\Model
 */
interface InteractsWithTranslationsInterface
{
    /**
     * @param  list<string>  $locales
     * @return array<string, string>
     */
    public function getTranslations(?string $key = null, ?array $locales = null): array;

    public function forgetTranslations(string $key, bool $null = false): static;

    /**
     * @param  array<string, string>  $translations
     */
    public function setTranslations(string $key, array $translations): static;
}
