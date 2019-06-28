<?php
/**
 * Created by PhpStorm.
 * User: dedipyaman
 * Date: 1/21/19
 * Time: 3:07 AM
 */

namespace Greentea\Component;


interface MapperFactoryInterface
{
    /**
     * @param string $classname
     * @return ReadMapper
     */
    public function createReadMapper(string $classname): ReadMapper;

    /**
     * @param string $classname
     * @return WriteMapper
     */
    public function createWriteMapper(string $classname): WriteMapper;
}