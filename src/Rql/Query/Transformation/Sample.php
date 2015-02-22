<?php
/**
 * Created by PhpStorm.
 * User: njohns
 * Date: 2/22/15
 * Time: 4:54 PM
 */

namespace Rql\Query\Transformation;

use Rql\Datum;
use Rql\Generated\Term\TermType;
use Rql\Query\Query;

class Sample extends Query
{
    public function __construct(Query $sequence, Datum $n)
    {
        $this->terms[] = $sequence;
        $this->terms[] = $n;
    }

    protected function getDatumType()
    {
        return TermType::SAMPLE;
    }
}
