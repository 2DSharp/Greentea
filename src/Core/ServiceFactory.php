<?php
/**
 * Created by PhpStorm.
 * User: dedipyaman
 * Date: 1/20/19
 * Time: 7:30 PM
 */

namespace Greentea\Core;


abstract class ServiceFactory
{
    private $readService;
    private $writeService;

    public function __construct(ReadService $readService, WriteService $writeService)
    {
        $this->readService = $readService;
        $this->writeService = $writeService;
    }

    /**
     * @return ReadService
     */
    public function getReadService(): ReadService
    {
        return $this->readService;
    }

    /**
     * @return WriteService
     */
    public function getWriteService(): WriteService
    {
        return $this->writeService;
    }

}