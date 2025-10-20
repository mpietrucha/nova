<?php

namespace Mpietrucha\Nova\Fields\External;

use Laravel\Nova\Fields\Field;
use Mpietrucha\Nova\Fields\External\Contracts\PropertyInterface;
use Mpietrucha\Utility\Concerns\Creatable;
use Mpietrucha\Utility\Contracts\CreatableInterface;

abstract class Property implements CreatableInterface, PropertyInterface
{
    use Creatable;

    public function __construct(protected Field $field)
    {
    }

    public function __invoke(): string
    {
        return $this->get();
    }

    abstract public function get(): string;

    public function field(): Field
    {
        return $this->field;
    }
}
