<?php

namespace Greentea\Core;

use Auryn\InjectionException;
use Auryn\Injector;
use Greentea\Component\RouteInterface;
use Greentea\Exception\InvalidViewException;
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
     * @throws InvalidControllerException
     * @throws InvalidViewException
     */
    public function run(Request $request, RouteInterface $route) : void
    {
        $method = $route->resolveMethod();
        $controllerResource = $route->resolveController();
        $viewResource = $route->resolveView();

        $controller = $this->injector->make($controllerResource);
        $this->runController($controller, $request, $method);

        $view = $this->injector->make($viewResource);
        $this->runView($view, $request, $method);


    }

    private function runController(Controller $controller, $request, string $method) : void
    {
        if (method_exists($controller, $method)) {
            $controller->{$method}($request);
        }
    }

    private function runView(View $view, $request, string $method) : void
    {
        if (method_exists($view, $method)) {
            /**
             * @var Response $response
             */
            $response = $view->{$method}($request);
            $response->send();
        }
    }
}