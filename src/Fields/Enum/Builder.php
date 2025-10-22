<?php

namespace Mpietrucha\Nova\Fields\Enum;

use BackedEnum;
use Laravel\Nova\Nova;
use Mpietrucha\Utility\Collection;
use Mpietrucha\Utility\Concerns\Compatible;
use Mpietrucha\Utility\Concerns\Creatable;
use Mpietrucha\Utility\Contracts\CompatibleInterface;
use Mpietrucha\Utility\Contracts\CreatableInterface;
use Mpietrucha\Utility\Instance;
use Mpietrucha\Utility\Normalizer;
use Mpietrucha\Utility\Value;

class Builder implements CompatibleInterface, CreatableInterface
{
    use Compatible, Creatable;

    public function __construct(protected string $key, protected string $value)
    {
    }

    /**
     * @return array<string, string>
     */
    public function __invoke(BackedEnum $enum): array
    {
        return [
            $this->key() => $enum->value |> Normalizer::string(...),
            $this->value() => Nova::humanize($enum),
        ];
    }

    /**
     * @return array<int, array<int, string>>
     */
    public static function options(mixed $input, string $key, string $value, ?callable $callback = null): array
    {
        if (static::incompatible($input)) {
            return Value::for($callback)->array($input);
        }

        $cases = $input::cases();

        $options = static::create($key, $value) |> Collection::create($cases)->map(...);

        return $options->toArray();
    }

    protected function key(): string
    {
        return $this->key;
    }

    protected function value(): string
    {
        return $this->value;
    }

    protected static function compatibility(mixed $input): bool
    {
        return Instance::is($input, BackedEnum::class);
    }
}
