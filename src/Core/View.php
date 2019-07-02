<?php

namespace Greentea\Core;

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
    public function createResponse(Request $request, string $method) : Response;
}