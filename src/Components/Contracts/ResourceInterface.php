<?php

namespace Mpietrucha\Nova\Components\Contracts;

use Illuminate\Http\Request;
use Mpietrucha\Utility\Contracts\CompatibleInterface;
use Symfony\Component\HttpFoundation\Response;

interface ResourceInterface extends CompatibleInterface
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
