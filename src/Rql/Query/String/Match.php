<?php
/**
 * Created by PhpStorm.
 * User: njohns
 * Date: 2/22/15
 * Time: 5:31 PM
 */

namespace Rql\Query\String;

use Rql\Generated\Term\TermType;
use Rql\Query\Query;

class Match extends Query
{
    public function __construct(Query $sequence, Datum $regexp)
    {
        throw new \RuntimeException("Not Yet Implemented");

        $this->terms[] = $sequence;
        $this->terms[] = $regexp;
    }

    protected function getDatumType()
    {
        return TermType::MATCH;
    }
}
