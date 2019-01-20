<?php
/**
 * Created by PhpStorm.
 * User: dedipyaman
 * Date: 1/20/19
 * Time: 1:24 PM
 */

namespace Greentea\Core;

use Greentea\Component\InjectorInterface;
use Greentea\Component\RouteInterface;

abstract class AbstractApplication
{

    private $injector;


    public function __construct(InjectorInterface $injector)
    {
        $this->injector = $injector;
    }

    protected abstract function getRoute() : RouteInterface;

    public function run($request) : void
    {
        $route = $this->getRoute();
        $method = $route->resolveMethod();

        $controller = $this->injector->make($route->resolveController());
        $this->runController($controller, $request, $method);

        $view = $this->injector->make($route->resolveView());
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
            $response = $view->{$method}($request);
            $response->send();
        }
    }
}