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

class Changes extends Query
{
    public function __construct(Query $table)
    {
        throw new \RuntimeException("Not Yet Implemented");

        $this->terms[] = $table;
    }

    protected function getDatumType()
    {
        return TermType::CHANGES;
    }
}
