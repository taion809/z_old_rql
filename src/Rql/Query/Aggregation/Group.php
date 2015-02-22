<?php
/**
 * Created by PhpStorm.
 * User: njohns
 * Date: 2/22/15
 * Time: 5:01 PM
 */

namespace Rql\Query\Aggregation;

use Rql\Datum;
use Rql\Generated\Term\TermType;
use Rql\Query\Query;

class Group extends Query
{
    public function __construct(Query $sequence)
    {
        throw new \RuntimeException("Not Yet Implemented");

        $this->terms[] = $sequence;
    }

    protected function getDatumType()
    {
        return TermType::GROUP;
    }
}
