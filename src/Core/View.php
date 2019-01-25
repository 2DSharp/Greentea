<?php
/**
 * Created by PhpStorm.
 * User: dedipyaman
 * Date: 1/20/19
 * Time: 1:59 PM
 */

namespace Greentea\Core;


use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Twig_Environment;

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

    /**
     * @param Twig_Environment $twig
     * @param string $template
     * @param array $params
     * @return string
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    protected function render(Twig_Environment $twig, string $template, $params = []) : string
    {
        return $twig->render($template, $params);
    }
}