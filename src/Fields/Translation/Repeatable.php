<?php

namespace Mpietrucha\Nova\Fields\Translation;

use Laravel\Nova\Http\Requests\NovaRequest;
use Mpietrucha\Nova\Fields\Translation\Exception\RepeatableSelectException;
use Mpietrucha\Utility\Normalizer;
use Mpietrucha\Utility\Utilizer\Concerns\Utilizable;
use Mpietrucha\Utility\Utilizer\Contracts\UtilizableInterface;

class Repeatable extends \Laravel\Nova\Fields\Repeater\Repeatable implements UtilizableInterface
{
    use Utilizable\Strings;

    protected ?Select $select = null;

    public static function label(): string
    {
        return static::utilize();
    }

    public function select(Select $select): static
    {
        $this->select = $select;

        return $this;
    }

    /**
     * @return list<\Mpietrucha\Nova\Fields\Translation\Contracts\InteractsWithFieldInterface>
     */
    public function fields(NovaRequest $request): array
    {
        return [
            $this->select ?? RepeatableSelectException::create()->throw(),

            Text::make(), /** @phpstan-ignore arguments.count */
        ];
    }

    protected static function hydrate(): string
    {
        return __('Translations') |> Normalizer::string(...);
    }
}
