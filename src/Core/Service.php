<?php
/**
 * Created by PhpStorm.
 * User: dedipyaman
 * Date: 1/21/19
 * Time: 1:52 AM
 */

namespace Greentea\Core;

use Greentea\Component\MapperFactoryInterface;
use Greentea\Exception\InvalidServiceModeException;

abstract class Service
{
    protected $mode;
    protected $mapperFactory;

    public const MODE_READ = 0;
    public const MODE_WRITE = 1;

    public function __construct(MapperFactoryInterface $factory)
    {
        $this->mapperFactory = $factory;
    }

    public function setServiceMode(int $mode)
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