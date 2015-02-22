<?php
/**
 * Created by PhpStorm.
 * User: njohns
 * Date: 2/22/15
 * Time: 4:50 PM
 */

namespace Rql\Query\Writing;

use Rql\Generated\Term\TermType;
use Rql\Query\Query;

class Replace extends Query
{
    public function __construct(Query $sequence)
    {
        throw new \RuntimeException("Not Yet Implemented");

        $this->terms[] = $sequence;
    }

    protected function getDatumType()
    {
        return TermType::REPLACE;
    }
}
