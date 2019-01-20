<?php
/**
 * Created by PhpStorm.
 * User: dedipyaman
 * Date: 1/21/19
 * Time: 1:52 AM
 */

namespace Greentea\Core;

use Greentea\Exception\InvalidServiceModeException;

abstract class Service
{
    private $mode;
    public const MODE_READ = 0;
    public const MODE_WRITE = 1;

    public function setServiceMode(int $mode)
    {
        $this->mode = $mode;
    }

    /**
     * @param MapperProvider $provider
     * @return object
     * @throws InvalidServiceModeException
     */
    protected function createMapper(MapperProvider $provider) : object
    {
        switch ($this->mode) {

            case self::MODE_READ:
                return $provider->getReadMapper();

            case self::MODE_WRITE:
                return $provider->getWriteMapper();

            default:
                throw new InvalidServiceModeException();
        }
    }
}