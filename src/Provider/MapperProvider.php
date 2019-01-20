<?php
/**
 * Created by PhpStorm.
 * User: dedipyaman
 * Date: 1/20/19
 * Time: 7:30 PM
 */

namespace Greentea\Core;


abstract class MapperProvider
{
    private $readMapper;
    private $writeMapper;

    public function __construct(ReadMapper $readMapper, WriteMapper $writeMapper)
    {
        $this->readMapper = $readMapper;
        $this->writeMapper = $writeMapper;
    }

    /**
     * @return ReadMapper
     */
    public function getReadMapper(): ReadMapper
    {
        return $this->readMapper;
    }

    /**
     * @return WriteMapper
     */
    public function getWriteMapper(): WriteMapper
    {
        return $this->writeMapper;
    }

}