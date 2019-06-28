<?php

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
        if (!in_array(ReadMapper::class, class_implements($classname)))
            throw new \RuntimeException("Object is not a correct read mapper.");

        $mapper = $this->createMapper($classname);
        return $mapper;
    }

    /**
     * @param string $classname
     * @return WriteMapper
     */
    public function createWriteMapper(string $classname): WriteMapper
    {
        if (!in_array(WriteMapper::class, class_implements($classname)))
            throw new \RuntimeException("Object is not a correct write mapper.");

        $mapper = $this->createMapper($classname);
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