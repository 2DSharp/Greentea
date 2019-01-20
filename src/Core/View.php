<?php
/**
 * Created by PhpStorm.
 * User: dedipyaman
 * Date: 1/20/19
 * Time: 1:59 PM
 */

namespace Greentea\Core;


abstract class View
{
    protected function respond(Response $response, Request $request, $html)
    {
        $response->setContent($html);
        $response->prepare($request);
        return $response;
    }

    protected function prepareService(Service $service)
    {
       $service->setServiceMode(Service::MODE_READ);
    }
}