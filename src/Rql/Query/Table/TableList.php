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

class TableList extends Query
{
    public function __construct(Query $db)
    {
        $this->terms[] = $db;
    }

    protected function getDatumType()
    {
        return TermType::TABLE_LIST;
    }
}
