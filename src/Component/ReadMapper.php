<?php
/**
 * Created by PhpStorm.
 * User: dedipyaman
 * Date: 1/20/19
 * Time: 5:44 PM
 */

namespace Greentea\Component;

interface ReadMapper
{
    public function read($entity) : object;
}
