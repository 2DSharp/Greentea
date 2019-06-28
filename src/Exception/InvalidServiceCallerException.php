<?php
declare(strict_types=1);
/*
 * This file is part of GreenTea.
 *
 * (c) Dedipyaman Das <2d@twodee.me>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Greentea\Exception;


class InvalidServiceCallerException extends \Exception
{
    public function __construct(String $msg)
    {
        parent::__construct($msg);
    }

    // custom string representation of object
    public function __toString()
    {
        return __CLASS__ . ": [{$this->code}]: {$this->message}\n";
    }
}