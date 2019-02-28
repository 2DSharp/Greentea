<?php
/**
 * Created by PhpStorm.
 * User: dedipyaman
 * Date: 1/21/19
 * Time: 1:52 AM
 */

namespace Greentea\Core;

use Greentea\Component\MapperFactoryInterface;
use Greentea\Exception\InvalidServiceCallerException;
use Greentea\Exception\InvalidServiceModeException;

abstract class Service
{
    protected $mode;
    protected $mapperFactory;

    private const MODE_READ = 0;
    private const MODE_WRITE = 1;

    public function __construct(MapperFactoryInterface $factory)
    {
        $this->mapperFactory = $factory;
    }

    /**
     * @param object $caller
     * @throws InvalidServiceCallerException
     */
    public function bind(object $caller) : void
    {
        if ($caller instanceof Controller) {
            $this->setServiceMode(self::MODE_READ);
        }
        else if ($caller instanceof View) {
            $this->setServiceMode(self::MODE_WRITE);
        }

        else {
            throw new InvalidServiceCallerException("The service caller isn't a controller or a view");
        }
    }

    /**
     * Set the service mode - READ or READWRITE
     * @param int $mode
     */
    private function setServiceMode(int $mode)
    {
        $this->mode = $mode;
    }

    /**
     * @param string $classname
     * @return object
     * @throws InvalidServiceModeException
     */
    protected function createMapper(string $classname) : object
    {
        switch ($this->mode) {

            case self::MODE_READ:
                return $this->mapperFactory->createReadMapper($classname);

            case self::MODE_WRITE:
                return $this->mapperFactory->createWriteMapper($classname);

            default:
                throw new InvalidServiceModeException();
        }
    }
}