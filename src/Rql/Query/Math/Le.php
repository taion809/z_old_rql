<?php
/**
 * Created by PhpStorm.
 * User: njohns
 * Date: 2/22/15
 * Time: 5:33 PM
 */

namespace Rql\Query\Math;

use Rql\Datum;
use Rql\Generated\Term\TermType;
use Rql\Query\Query;

class Le extends Query
{
    public function __construct(Query $sequence, Datum $n)
    {
        throw new \RuntimeException("Not Yet Implemented");

        $this->terms[] = $sequence;
        $this->terms[] = $n;
    }

    protected function getDatumType()
    {
        return TermType::LE;
    }
}
