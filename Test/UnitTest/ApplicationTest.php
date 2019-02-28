<?php
/**
 * Created by PhpStorm.
 * User: dedipyaman
 * Date: 1/24/19
 * Time: 9:46 PM
 */

namespace Test\UnitTest;

use Auryn\Injector;
use Greentea\Core\Application;
use Greentea\Core\Controller;
use PHPUnit\Framework\TestCase;
use Mockery;

class ApplicationTest extends TestCase
{

    public function testRun()
    {
        $controllerString = "Application";
        $controller = Mockery::mock(Controller::class);
        $injector = Mockery::mock(Injector::class);
        $injector->allows()->make($controllerString)->andReturns($controller);

        $app = new Application($injector);

    }
}
