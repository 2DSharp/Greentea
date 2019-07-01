<?php
/**
 * Created by PhpStorm.
 * User: dedipyaman
 * Date: 1/20/19
 * Time: 1:36 PM
 */

namespace Greentea\Component;


interface RouteInterface
{
    public function resolveController(string $controllerNamespace) : ?string;
    public function resolveView(string $viewNamespace) : ?string;
    public function resolveMethod() : string;
}