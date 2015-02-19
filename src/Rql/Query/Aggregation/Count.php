<?php
/**
 * Created by PhpStorm.
 * User: njohns
 * Date: 1/4/15
 * Time: 3:08 PM
 */

namespace Rql\Query\Aggregation;

use Rql\Generated\Term\TermType;
use Rql\Query\Query;

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
