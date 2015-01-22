<?php
/**
 * Created by PhpStorm.
 * User: njohns
 * Date: 1/3/15
 * Time: 10:45 PM
 */

namespace Rql\Query\Queries;

use Rql\Datum;
use Rql\Generated\Term\TermType;
use Rql\Types\String;

class Db extends Query
{
    public function __construct($name)
    {
        $this->terms[] = $name;
    }

    protected function getDatumType()
    {
        return TermType::DB;
    }
}
