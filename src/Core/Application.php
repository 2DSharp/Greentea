<?php

namespace Greentea\Core;

use Auryn\InjectionException;
use Auryn\Injector;
use Greentea\Component\RouteInterface;
use Greentea\Exception\InvalidViewException;
use Greentea\Exception\NoHandlerSpecifiedException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

final class Application
{
    private $injector;

    public function __construct(Injector $injector)
    {
        $this->injector = $injector;
    }

    /**
     * @param $request
     * @param RouteInterface $route
     * @throws InjectionException
     * @throws NoHandlerSpecifiedException
     */
    public function run(Request $request, RouteInterface $route) : void
    {
        $method = $route->resolveMethod();
        $controllerResource = $route->resolveController();
        $viewResource = $route->resolveView();

        $exists = false;

        if (method_exists($controllerResource, $method)) {
            $controller = $this->injector->make($controllerResource);
            $this->runController($controller, $request, $method);
            $exists = true;
        }
        if (method_exists($viewResource, $method)) {
            $view = $this->injector->make($viewResource);
            $this->runView($view, $request, $method);
            $exists = true;
        }

        if (!$exists)
            throw new NoHandlerSpecifiedException();
    }

    private function runController($controller, $request, string $method) : void
    {
        $controller->{$method}($request);
    }

    private function runView($view, $request, string $method) : void
    {
        /**
         * @var Response $response
         */
        $response = $view->{$method}($request);
        $response->send();
    }
}