<?php

namespace Mpietrucha\Nova\Components\Contracts;

use Mpietrucha\Utility\Contracts\CompatibleInterface;
use Mpietrucha\Utility\Contracts\TappableInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

interface ResourceInterface extends CompatibleInterface, TappableInterface
{
    /**
     * @param  string|list<string>  $routes
     */
    public function on(array|string $routes): static;

    /**
     * @param  string|list<string>  $routes
     */
    public function serveOn(array|string $routes): static;

    /**
     * @param  string|list<string>  $routes
     */
    public function synchronizeOn(array|string $routes): static;

    public function serve(Request $request): void;

    public function synchronize(Request $request, Response $response): void;
}
