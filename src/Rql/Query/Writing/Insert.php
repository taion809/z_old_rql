<?php
/**
 * Created by PhpStorm.
 * User: njohns
 * Date: 2/18/15
 * Time: 5:08 PM
 */

namespace Rql\Query\Writing;

use Rql\Datum;
use Rql\Generated\Term\TermType;
use Rql\Query\Query;

class Insert extends Query
{
    public function __construct(Query $sequence, Query $data, Datum $options = null)
    {
        $this->terms[] = $sequence;
        $this->terms[] = $data;

        if($options) {
            $this->options = $options;
        }
    }

    protected function getDatumType()
    {
        return TermType::INSERT;
    }
}
