<?php
/**
 * Created by PhpStorm.
 * User: njohns
 * Date: 2/22/15
 * Time: 5:53 PM
 */

namespace Rql\Query\Geospacial;

use Rql\Datum;
use Rql\Generated\Term\TermType;
use Rql\Query\Query;

class PolygonSub extends Query
{
    public function __construct(Query $sequence)
    {
        throw new \RuntimeException("Not Yet Implemented");

        $this->terms[] = $sequence;
    }

    protected function getDatumType()
    {
        return TermType::POLYGON_SUB;
    }
}
