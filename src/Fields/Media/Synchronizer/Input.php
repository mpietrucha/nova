<?php

namespace Mpietrucha\Nova\Fields\Media\Synchronizer;

use Illuminate\Http\UploadedFile;
use Mpietrucha\Nova\Fields\Media\Index;
use Mpietrucha\Nova\Fields\Media\Repeatable;
use Mpietrucha\Utility\Concerns\Creatable;
use Mpietrucha\Utility\Contracts\CreatableInterface;
use Mpietrucha\Utility\Enumerable\Contracts\EnumerableInterface;
use Mpietrucha\Utility\Normalizer;
use Mpietrucha\Utility\Type;

/**
 * @phpstan-import-type EncoderFieldsCollection from \Mpietrucha\Nova\Fields\Media\Encoder
 */
class Input implements CreatableInterface
{
    use Creatable;

    public function __construct(protected ?UploadedFile $file = null, protected ?int $index = null)
    {
    }

    /**
     * @param  EncoderFieldsCollection  $fields
     */
    public static function build(EnumerableInterface $fields): static
    {
        $file = Repeatable::property() |> $fields->get(...);

        return static::create($file, Index::property() |> $fields->get(...));
    }

    public function supported(): bool
    {
        if ($this->file() |> Type::object(...)) {
            return true;
        }

        return $this->index() |> Type::integer(...);
    }

    final public function unsupported(): bool
    {
        return $this->supported() |> Normalizer::not(...);
    }

    public function file(): ?UploadedFile
    {
        return $this->file;
    }

    public function index(): ?int
    {
        return $this->index;
    }

    public function get(Bucket $bucket): null|string|UploadedFile
    {
        if ($this->unsupported()) {
            return null;
        }

        return $this->file() ?? $this->index() |> $bucket->get(...);
    }
}
