<?php

namespace Mpietrucha\Nova\Fields;

use Laravel\Nova\Http\Requests\NovaRequest;
use Mpietrucha\Nova\Fields\Translation\Repeatable;
use Mpietrucha\Nova\Fields\Translation\Select;
use Mpietrucha\Nova\Fields\Translation\Transformer;
use Mpietrucha\Nova\Fields\Translation\Validation;
use Mpietrucha\Nova\Utility\Concerns\InteractsWithRequest;
use Mpietrucha\Nova\Utility\Contracts\InteractsWithRequestInterface;
use Mpietrucha\Utility\Arr;

class Translation extends \Laravel\Nova\Fields\Repeater implements InteractsWithRequestInterface
{
    use InteractsWithRequest;

    public $sortable = false;

    protected ?Text $text = null;

    protected ?Repeatable $repeatable = null;

    public function __construct(string $name, ?string $attribute = null)
    {
        parent::__construct($name, $attribute);

        $this->showOnIndex();
        $this->showOnDetail();

        $this->repeatable() |> Arr::overlap(...) |> $this->repeatables(...);

        Validation::apply($this);
    }

    /**
     * @param  callable|iterable<string, string>|class-string<\BackedEnum>  $languages
     */
    public function languages(callable|iterable|string $languages): static
    {
        Select::languages($languages);

        return $this;
    }

    public function default(mixed $default): static
    {
        Select::language($default);

        return $this;
    }

    /**
     * @phpstan-ignore-next-line missingType.iterableValue
     */
    public function resolve(mixed $model, ?string $attribute = null): void
    {
        static::request()->isPresentationRequest() && $this->text()->resolve($model, $attribute);

        parent::resolve($model, $attribute);
    }

    public function jsonSerialize(): array
    {
        return match (true) {
            static::request()->isFormRequest() => parent::jsonSerialize(),
            default => $this->text()->jsonSerialize()
        };
    }

    /**
     * @phpstan-ignore-next-line missingType.iterableValue
     */
    protected function resolveAttribute(mixed $model, string $attribute): mixed
    {
        $attribute = Transformer::hydrate($model, $attribute);

        return parent::resolveAttribute($model, $attribute);
    }

    protected function fillAttribute(NovaRequest $request, string $requestAttribute, object $model, string $attribute): void
    {
        $translations = $request->get($requestAttribute);

        Transformer::set($model, $attribute, $translations);
    }

    protected function text(): Text
    {
        return $this->text ??= Text::replicate($this);
    }

    protected function repeatable(): Repeatable
    {
        return $this->repeatable ??= Repeatable::make();
    }
}
