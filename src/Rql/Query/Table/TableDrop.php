<?php
/**
 * Created by PhpStorm.
 * User: njohns
 * Date: 2/22/15
 * Time: 4:08 PM
 */

namespace Rql\Query\Table;

use Rql\Datum;
use Rql\Generated\Term\TermType;
use Rql\Query\Query;

class TableDrop extends Query
{
    public function __construct(Query $db, Datum $tableName)
    {
        $this->terms[] = $db;
        $this->terms[] = $tableName;
    }

    protected function getDatumType()
    {
        return TermType::TABLE_DROP;
    }
}
