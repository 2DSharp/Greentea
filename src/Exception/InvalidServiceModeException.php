<?php
/**
 * Created by PhpStorm.
 * User: dedipyaman
 * Date: 1/21/19
 * Time: 2:09 AM
 */

namespace Greentea\Exception;


class InvalidServiceModeException extends \Exception
{
    public function __construct()
    {
        parent::__construct("Invalid Service Mode set. Initialize service with prepareService().");
    }

    // custom string representation of object
    public function __toString()
    {
        return __CLASS__ . ": [{$this->code}]: {$this->message}\n";
    }
}