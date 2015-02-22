<?php
/**
 * Created by PhpStorm.
 * User: njohns
 * Date: 2/18/15
 * Time: 5:08 PM
 */

namespace Rql\Query\Selecting;

use Rql\Datum;
use Rql\Generated\Term\TermType;
use Rql\Query\Query;

class Get extends Query
{
    public function __construct(Query $table, Datum $primaryKey)
    {
        $this->terms[] = $table;
        $this->terms[] = $primaryKey;
    }

    protected function getDatumType()
    {
        return TermType::GET;
    }
}
