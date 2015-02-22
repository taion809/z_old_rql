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

class IsEmpty extends Query
{
    public function __construct(Query $sequence)
    {
        $this->terms[] = $sequence;
    }

    protected function getDatumType()
    {
        return TermType::IS_EMPTY;
    }
}
