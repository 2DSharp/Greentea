<?php
/**
 * Created by PhpStorm.
 * User: dedipyaman
 * Date: 1/21/19
 * Time: 3:09 AM
 */

namespace Greentea\Factory;


use Greentea\Component\MapperFactoryInterface;
use Greentea\Component\ReadMapper;
use Greentea\Component\WriteMapper;

class MapperFactory implements MapperFactoryInterface
{
    private $cache = [];
    private $connection;

    public function __construct(\PDO $connection)
    {
        $this->connection = $connection;
    }
    /**
     * @param string $classname
     * @return ReadMapper
     */
    public function createReadMapper(string $classname): ReadMapper
    {
        $mapper = $this->createMapper($classname);
        if (! ($mapper instanceof ReadMapper)) {
            throw new \RuntimeException("Object not a correct read mapper.");
        }
        return $mapper;
    }

    /**
     * @param string $classname
     * @return WriteMapper
     */
    public function createWriteMapper(string $classname): WriteMapper
    {
        $mapper = $this->createMapper($classname);
        if (! ($mapper instanceof WriteMapper)) {
            throw new \RuntimeException("Object not a correct write mapper.");
        }

        return $mapper;
    }

    private function createMapper(string $classname)
    {
        if (array_key_exists($classname, $this->cache)) {
            return $this->cache[$classname];
        }

        if (!class_exists($classname)) {
            throw new \RuntimeException("Mapper couldn't be found.");
        }

        $mapper = new $classname($this->connection);
        $this->cache[$classname] = $mapper;

        return $mapper;
    }
}