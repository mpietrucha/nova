<?php

namespace Mpietrucha\Nova\Fields;

use Mpietrucha\Nova\Concerns\Fieldable;
use Mpietrucha\Nova\Contracts\FieldableInterface;
use Laravel\Nova\Resource;

class Media implements FieldableInterface
{
    use Fieldable;

    public function __construct(protected string $name)
    {
    }

    public static function value(): string
    {
    }

    public static function store(): void
    {

    }

    public static function delete(): void
    {

    }

    public static function preview(): void
    {

    }

    public static function download(): void
    {

    }

    public static function thumbnail(): string
    {

    }

    public function file(): File
    {
        return $this->name() |> File::make(...) |> $this->configure(...);
    }

    public function audio(): Audio
    {
        return $this->name() |> Audio::make(...) |> $this->configure(...);
    }

    public function image(): Image
    {
        return $this->name() |> Image::make(...) |> $this->configure(...);
    }

    public function avatar(): Avatar
    {
        return $this->name() |> Avatar::make(...) |> $this->configure(...);
    }

    protected function configure(File $field): File
    {
        /** @phpstan-ignore-next-line */
        static::value(...) |> $field->resolveUsing(...);

        /** @phpstan-ignore-next-line */
        static::store(...) |> $field->store(...);

        /** @phpstan-ignore-next-line */
        static::delete(...) |> $field->delete(...);

        /** @phpstan-ignore-next-line */
        static::preview(...) |> $field->preview(...);

        /** @phpstan-ignore-next-line */
        static::download(...) |> $field->download(...);

        /** @phpstan-ignore-next-line */
        static::thumbnail(...) |> $field->thumbnail(...);

        return $field;
    }

    protected function name(): string
    {
        return $this->name;
    }
}
