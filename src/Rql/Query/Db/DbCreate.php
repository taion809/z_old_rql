<?php
/**
 * Created by PhpStorm.
 * User: njohns
 * Date: 2/17/15
 * Time: 9:31 PM
 */

namespace Rql\Query\Db;

use Rql\Datum;
use Rql\Generated\Term\TermType;
use Rql\Query\Query;

class DbCreate extends Query
{
    public function __construct(Datum $name)
    {
        $this->terms[] = $name;
    }

    protected function getDatumType()
    {
        return TermType::DB_CREATE;
    }
}
