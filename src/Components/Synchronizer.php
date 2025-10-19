<?php

namespace Mpietrucha\Nova\Components;

use Illuminate\Http\Response;
use Laravel\Nova\Asset;
use Mpietrucha\Nova\Components\Contracts\TagInterface;
use Mpietrucha\Utility\Arr;
use Mpietrucha\Utility\Collection;
use Mpietrucha\Utility\Filesystem;
use Mpietrucha\Utility\Normalizer;
use Mpietrucha\Utility\Str;
use Mpietrucha\Utility\Stringable;
use Mpietrucha\Utility\Type;

class Synchronizer extends Propagator
{
    /**
     * @var \Mpietrucha\Utility\Collection<int, \Mpietrucha\Utility\Stringable>
     */
    protected ?Collection $lines = null;

    protected ?Stringable $content = null;

    public function __construct(protected Response $response)
    {
    }

    public function asset(Asset $asset): void
    {
        $input = $asset->path() |> Normalizer::string(...);

        $tag = $this->tag($asset);

        $index = $this->lines() |> $tag->index(...);

        if (Type::null($index) || Filesystem::unexists($input)) {
            return;
        }

        $content = Filesystem::get($input) |> $tag->render(...) |> Str::of(...);

        if ($this->content()->contains($content)) {
            return;
        }

        $this->lines()->splice($index + 1, 0, Arr::wrap($content));

        Str::eol() |> $this->lines()->join(...) |> $this->response()->setContent(...);
    }

    public function tag(Asset $asset): TagInterface
    {
        /** @phpstan-ignore-next-line match.unhandled */
        return match (true) {
            $this->style($asset) => Tag\Style::create($asset),
            $this->script($asset) => Tag\Script::create($asset),
        };
    }

    /**
     * @return \Mpietrucha\Utility\Collection<int, \Mpietrucha\Utility\Stringable>
     */
    protected function lines(): Collection
    {
        /** @phpstan-ignore-next-line return.type */
        return $this->lines ??= $this->content()->lines()->mapToStringables();
    }

    protected function content(): Stringable
    {
        return $this->content ??= $this->response()->getContent() |> Str::of(...);
    }

    protected function response(): Response
    {
        return $this->response;
    }
}
