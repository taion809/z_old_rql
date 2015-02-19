<?php
/**
 * Created by PhpStorm.
 * User: njohns
 * Date: 2/18/15
 * Time: 5:08 PM
 */

namespace Rql\Query\Queries\Control;

use Rql\Datum;
use Rql\Generated\Term\TermType;
use Rql\Query\Queries\Query;

class Json extends Query
{
    public function __construct(Datum $value)
    {
        $this->terms[] = $value;
    }

    protected function getDatumType()
    {
        return TermType::JSON;
    }
}
