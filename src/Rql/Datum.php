<?php
/**
 * Created by PhpStorm.
 * User: njohns
 * Date: 1/4/15
 * Time: 9:40 AM
 */

namespace Rql;

abstract class Datum
{
    abstract public function build();
    abstract protected function getDatumType();
}
