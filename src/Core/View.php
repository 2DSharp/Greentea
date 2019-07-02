<?php

namespace Greentea\Core;

use Greentea\Exception\TemplatingException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Interface View
 *
 * A View creates a response depending on the request and returns it.
 * Delegate the response creation to a private method.
 * @package Greentea\Core
 */
interface View
{
    /**
     * @param Request $request
     * @param string $method
     * @return Response
     * @throws TemplatingException
     */
    public function createResponse(Request $request, string $method) : Response;
}