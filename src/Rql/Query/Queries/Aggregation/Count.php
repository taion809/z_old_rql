<?php
/**
 * Created by PhpStorm.
 * User: njohns
 * Date: 1/4/15
 * Time: 3:08 PM
 */

namespace Rql\Query\Queries\Aggregation;

use Rql\Generated\Term\TermType;
use Rql\Query\Queries\Query;

class Count extends Query
{
    public function __construct(Query $sequence, array $filters = [])
    {
        $this->terms[] = $sequence;
    }

    protected function getDatumType()
    {
        return TermType::COUNT;
    }
}
