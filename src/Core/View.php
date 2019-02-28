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
    protected function respond(Request $request, string $html)
    {
        $response = new Response($html);
        $response->prepare($request);

        return $response;
    }

    /**
     * Subscrbe to a service to read data from the models
     * @param Service $service
     * @throws \Greentea\Exception\InvalidServiceCallerException
     */
    protected function subscribeTo(Service $service)
    {
       $service->bind($this);
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