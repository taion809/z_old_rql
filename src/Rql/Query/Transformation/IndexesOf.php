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

class IndexesOf extends Query
{
    public function __construct(Query $sequence)
    {
        throw new \RuntimeException("Not Yet Implemented");

        $this->terms[] = $sequence;
    }

    protected function getDatumType()
    {
        return TermType::INDEXES_OF;
    }
}
