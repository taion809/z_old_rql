<?php
/**
 * Created by PhpStorm.
 * User: njohns
 * Date: 2/17/15
 * Time: 9:31 PM
 */

namespace Rql\Query\Db;

use Rql\Generated\Term\TermType;
use Rql\Query\Query;

class DbList extends Query
{
    protected function getDatumType()
    {
        return TermType::DB_LIST;
    }
}
