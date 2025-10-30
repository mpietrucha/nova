<?php

namespace Mpietrucha\Nova\Fields;

use Mpietrucha\Nova\Concerns\InteractsWithRequest;
use Mpietrucha\Nova\Contracts\InteractsWithRequestInterface;
use Mpietrucha\Nova\Fields\Translation\Repeatable;
use Mpietrucha\Nova\Fields\Translation\Select;
use Mpietrucha\Nova\Fields\Translation\Transformer;
use Mpietrucha\Nova\Fields\Translation\Validation;

class Translation extends Repeater implements InteractsWithRequestInterface
{
    use InteractsWithRequest;

    public $sortable = false;

    protected ?Text $presentation = null;

    public function __construct(string $name, ?string $attribute = null)
    {
        parent::__construct(Transformer::create(), $name, $attribute);

        $this->showOnIndex();
        $this->showOnDetail();

        Repeatable::make() |> $this->repeatables(...);

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
        static::request()->isPresentationRequest() && $this->presentation()->resolve($model, $attribute);

        parent::resolve($model, $attribute);
    }

    public function jsonSerialize(): array
    {
        return match (true) {
            static::request()->isFormRequest() => parent::jsonSerialize(),
            default => $this->presentation()->jsonSerialize()
        };
    }

    protected function presentation(): Text
    {
        return $this->presentation ??= Text::replicate($this);
    }
}
