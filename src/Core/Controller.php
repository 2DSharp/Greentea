<?php

namespace Greentea\Core;

abstract class Controller
{
    protected function prepareService(Service $service)
    {
        $service->bind($this);
    }
}