<?php
/**
 * Created by PhpStorm.
 * User: njohns
 * Date: 2/18/15
 * Time: 5:08 PM
 */

namespace Rql\Query\Transformation;

use Rql\Datum;
use Rql\Generated\Term\TermType;
use Rql\Query\Query;

class Limit extends Query
{
    public function __construct(Query $sequence, Datum $n)
    {
        $this->terms[] = $sequence;
        $this->terms[] = $n;
    }

    protected function getDatumType()
    {
        return TermType::LIMIT;
    }
}
