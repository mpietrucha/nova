<?php

namespace Mpietrucha\Nova\Cards;

use Laravel\Nova\Card;
use Mpietrucha\Nova\Cards\Filterable\Concerns\InteractsWithConditions;
use Mpietrucha\Nova\Cards\Filterable\Concerns\InteractsWithInput;
use Mpietrucha\Nova\Cards\Filterable\Contracts\ConditionInterface;
use Mpietrucha\Nova\Cards\Filterable\Contracts\FilterableInterface;
use Mpietrucha\Utility\Enumerable\Contracts\EnumerableInterface;

class Filterable extends Card implements FilterableInterface
{
    use InteractsWithConditions, InteractsWithInput;

    /**
     * @var string
     */
    public $width = self::FULL_WIDTH;

    /**
     * @var \Mpietrucha\Utility\Enumerable\Contracts\EnumerableInterface<int, \Mpietrucha\Nova\Cards\Filterable\Contracts\ConditionInterface>
     */
    protected ?EnumerableInterface $conditions = null;

    public function component(): string
    {
        return 'mpietrucha-filterable';
    }

    final public function conditions(): EnumerableInterface
    {
        return $this->conditions ??= $this->input()->ensure(ConditionInterface::class);
    }

    public function jsonSerialize(): array
    {
        return [
            ...parent::jsonSerialize(),
            'conditions' => $this->conditions()->map->jsonSerialize()->all(),
        ];
    }
}
