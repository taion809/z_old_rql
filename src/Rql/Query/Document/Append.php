<?php
/**
 * Created by PhpStorm.
 * User: njohns
 * Date: 2/22/15
 * Time: 5:22 PM
 */

namespace Rql\Query\Document;

use Rql\Generated\Term\TermType;
use Rql\Query\Query;

class Append extends Query
{
    public function __construct(Query $sequence)
    {
        throw new \RuntimeException("Not Yet Implemented");

        $this->terms[] = $sequence;
    }

    protected function getDatumType()
    {
        return TermType::APPEND;
    }
}
