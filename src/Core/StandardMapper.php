<?php
/**
 * Created by PhpStorm.
 * User: dedipyaman
 * Date: 1/21/19
 * Time: 3:17 AM
 */

namespace Greentea\Core;


abstract class StandardMapper
{
    protected $connection;

    public function __construct(\PDO $connection)
    {
        $this->connection = $connection;
    }
}