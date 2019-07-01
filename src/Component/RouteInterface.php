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
    public function buildPaths() : void;
    public function resolveController() : ?string;
    public function resolveView() : ?string;
    public function resolveMethod() : string;
}