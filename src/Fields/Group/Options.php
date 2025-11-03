<?php

namespace Mpietrucha\Nova\Fields\Group;

use BackedEnum;
use Mpietrucha\Utility\Collection;
use Mpietrucha\Utility\Concerns\Compatible;
use Mpietrucha\Utility\Contracts\CompatibleInterface;
use Mpietrucha\Utility\Instance;
use Mpietrucha\Utility\Value;

class Options implements CompatibleInterface
{
    use Compatible;

    /**
     * @return array<int, array<int, string>>
     */
    public static function build(mixed $input, string $key, string $value, ?callable $callback = null): array
    {
        if (static::incompatible($input)) {
            return Value::for($callback)->array($input);
        }

        $cases = $input::cases();

        $options = Option::create($key, $value) |> Collection::create($cases)->map(...);

        return $options->toArray();
    }

    protected static function compatibility(mixed $input): bool
    {
        return Instance::is($input, BackedEnum::class);
    }
}
