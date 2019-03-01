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
use Greentea\Exception\InvalidViewException;
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
     * @throws InvalidControllerException
     * @throws InvalidViewException
     */
    public function run(Request $request, RouteInterface $route) : void
    {
        $method = $route->resolveMethod();
        $controllerResource = $route->resolveController();
        $viewResource = $route->resolveView();

        if (!is_null($controllerResource)) {
            if (($controller = $this->injector->make($controllerResource)) instanceof Controller)
                $this->runController($controller, $request, $method);
            else
                throw new InvalidControllerException();
        }

        if (!is_null($viewResource)) {
            if (($view = $this->injector->make($viewResource)) instanceof View)
                $this->runView($view, $request, $method);
            else
                throw new InvalidViewException();
        }
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