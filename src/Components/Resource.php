<?php

namespace Mpietrucha\Nova\Components;

use Illuminate\Http\Request;
use Mpietrucha\Nova\Components\Contracts\ResourceInterface;
use Mpietrucha\Utility\Arr;
use Mpietrucha\Utility\Concerns\Compatible;
use Mpietrucha\Utility\Concerns\Creatable;
use Mpietrucha\Utility\Concerns\Tappable;
use Mpietrucha\Utility\Contracts\CreatableInterface;
use Mpietrucha\Utility\Enumerable\Contracts\EnumerableInterface;
use Mpietrucha\Utility\Normalizer;
use Symfony\Component\HttpFoundation\Response;

class Resource implements CreatableInterface, ResourceInterface
{
    use Compatible, Creatable, Tappable;

    /**
     * @var list<string>
     */
    protected array $servingRoutes = [];

    /**
     * @var list<string>
     */
    protected array $synchronizingRoutes = [
        'nova.pages.login',
    ];

    /**
     * @param  \Mpietrucha\Utility\Enumerable\Contracts\EnumerableInterface<int, \Laravel\Nova\Asset>  $assets
     */
    public function __construct(protected EnumerableInterface $assets)
    {
    }

    public function on(array|string $routes): static
    {
        return $this->serveOn($routes)->synchronizeOn($routes);
    }

    public function serveOn(array|string $routes): static
    {
        /** @phpstan-ignore-next-line assign.propertyType */
        $this->servingRoutes = Arr::wrap($routes);

        return $this;
    }

    public function synchronizeOn(array|string $routes): static
    {
        /** @phpstan-ignore-next-line assign.propertyType */
        $this->synchronizingRoutes = Arr::wrap($routes);

        return $this;
    }

    public function serve(Request $request): void
    {
        $routes = $this->servingRoutes();

        if (static::incompatible($request, $routes)) {
            return;
        }

        Propagator::create()->asset(...) |> $this->assets()->each(...);
    }

    public function synchronize(Request $request, Response $response): void
    {
        $routes = $this->synchronizingRoutes();

        if (static::incompatible($request, $routes)) {
            return;
        }

        Synchronizer::create($response)->asset(...) |> $this->assets()->each(...);
    }

    /**
     * @return array<int, string>
     */
    protected function servingRoutes(): array
    {
        return $this->servingRoutes;
    }

    /**
     * @return array<int, string>
     */
    protected function synchronizingRoutes(): array
    {
        return $this->synchronizingRoutes;
    }

    /**
     * @return \Mpietrucha\Utility\Enumerable\Contracts\EnumerableInterface<int, \Laravel\Nova\Asset>
     */
    protected function assets(): EnumerableInterface
    {
        return $this->assets;
    }

    /**
     * @param  list<string>  $routes
     */
    protected static function compatibility(Request $request, array $routes): bool
    {
        if (Arr::isEmpty($routes)) {
            return true;
        }

        if (Arr::contains($routes, $request->route()->getName())) {
            return true;
        }

        return Arr::first($routes, $request->is(...)) |> Normalizer::boolean(...);
    }
}
