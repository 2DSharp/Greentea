<?php
/**
 * Created by PhpStorm.
 * User: dedipyaman
 * Date: 1/20/19
 * Time: 1:31 PM
 */

namespace Greentea\Component;


interface InjectorInterface
{
    public function make(string $classname);
}