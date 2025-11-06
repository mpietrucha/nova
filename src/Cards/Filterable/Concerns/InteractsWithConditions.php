<?php

namespace Mpietrucha\Nova\Cards\Filterable\Concerns;

use Mpietrucha\Nova\Cards\Filterable\Condition;
use Mpietrucha\Nova\Cards\Filterable\Contracts\ConditionInterface;
use Mpietrucha\Nova\Cards\Filterable\Filter;

trait InteractsWithConditions
{
    public static function text(string $name, ?string $attribute = null): ConditionInterface
    {
        $filters = [
            Filter::is(),
            Filter::isNot(),
            Filter::contains(),
            Filter::doesntContain(),
            Filter::startsWith(),
            Filter::endsWith(),
            Filter::empty(),
            Filter::notEmpty(),
        ];

        return Condition::create($name, $attribute, $filters);
    }

    public static function number(string $name, ?string $attribute = null): ConditionInterface
    {
        $filters = [
            Filter::eq(),
            Filter::ne(),
            Filter::gt(),
            Filter::gte(),
            Filter::lt(),
            Filter::lte(),
            Filter::empty(),
            Filter::notEmpty(),
        ];

        return Condition::create($name, $attribute, $filters);
    }
}
