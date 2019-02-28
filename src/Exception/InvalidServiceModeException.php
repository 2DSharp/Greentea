<?php

namespace Greentea\Exception;


class InvalidServiceModeException extends \Exception
{
    public function __construct()
    {
        parent::__construct("Invalid Service Mode set. Initialize service with prepareService().");
    }

    public function __toString()
    {
        return __CLASS__ . ": [{$this->code}]: {$this->message}\n";
    }
}