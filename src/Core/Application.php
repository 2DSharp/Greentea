<?php
/**
 * Created by PhpStorm.
 * User: dedipyaman
 * Date: 1/20/19
 * Time: 1:24 PM
 */

namespace Greentea\Core;

use Auryn\InjectionException;
use Auryn\Injector;
use Greentea\Component\RouteInterface;
use \Psr\Http\Message\ServerRequestInterface as Request;

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
     */
    public function run(Request $request, RouteInterface $route) : void
    {
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