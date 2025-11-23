<?php

namespace Mpietrucha\Nova\Cards;

use Laravel\Nova\Card;
use Mpietrucha\Laravel\Filterable\Concerns\InteractsWithConditions;
use Mpietrucha\Laravel\Filterable\Concerns\InteractsWithInput;
use Mpietrucha\Laravel\Filterable\Contracts\ConditionInterface;
use Mpietrucha\Laravel\Filterable\Contracts\InteractsWithInputInterface;
use Mpietrucha\Utility\Enumerable\Contracts\EnumerableInterface;

/**
 * @method static make(mixed $input)
 */
class Filterable extends Card implements InteractsWithInputInterface
{
    use InteractsWithConditions, InteractsWithInput;

    /**
     * @var string
     */
    public $width = self::FULL_WIDTH;

    /**
     * @var string
     */
    public $height = self::DYNAMIC_HEIGHT;

    public function __construct(mixed $input)
    {
        $this->use($input);
    }

    public function component(): string
    {
        return 'mpietrucha-filterable';
    }

    /**
     * @return \Mpietrucha\Utility\Enumerable\Contracts\EnumerableInterface<int, \Mpietrucha\Laravel\Filterable\Contracts\ConditionInterface>
     */
    public function conditions(): EnumerableInterface
    {
        return $this->input()->ensure(ConditionInterface::class);
    }

    public function jsonSerialize(): array
    {
        return [
            'conditions' => $this->conditions()->map->jsonSerialize()->all(),
        ] + parent::jsonSerialize();
    }
}
