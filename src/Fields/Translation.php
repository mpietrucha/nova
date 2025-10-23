<?php

namespace Mpietrucha\Nova\Fields;

use Laravel\Nova\Http\Requests\NovaRequest;
use Mpietrucha\Nova\Fields\Concerns\InteractsWithRequest;
use Mpietrucha\Nova\Fields\Contracts\InteractsWithRequestInterface;
use Mpietrucha\Nova\Fields\Translation\Repeatable;
use Mpietrucha\Nova\Fields\Translation\Select;
use Mpietrucha\Nova\Fields\Translation\Text;
use Mpietrucha\Nova\Fields\Translation\Transformer;
use Mpietrucha\Utility\Arr;

class Translation extends \Laravel\Nova\Fields\Repeater implements InteractsWithRequestInterface
{
    use InteractsWithRequest;

    public $sortable = false;

    protected ?Text $text = null;

    protected ?Select $select = null;

    protected ?Repeatable $repeatable = null;

    public function __construct(string $name, ?string $attribute = null)
    {
        parent::__construct($name, $attribute);

        $this->showOnIndex();
        $this->showOnDetail();

        $this->repeatable() |> Arr::overlap(...) |> $this->repeatables(...);
    }

    /**
     * @phpstan-ignore-next-line argument.type
     */
    public function languages(callable|iterable|string $languages): static
    {
        $this->select()->options($languages); /** @phpstan-ignore argument.type */

        return $this;
    }

    public function default(mixed $default): static
    {
        $this->select()->default($default);

        return $this;
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
        return $this->text ??= Text::make(); /** @phpstan-ignore arguments.count */
    }

    protected function select(): Select
    {
        return $this->select ??= Select::make(); /** @phpstan-ignore arguments.count */
    }

    protected function repeatable(): Repeatable
    {
        return $this->repeatable ??= $this->select() |> Repeatable::make()->select(...);
    }
}
