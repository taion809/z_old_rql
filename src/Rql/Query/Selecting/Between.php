<?php
/**
 * Created by PhpStorm.
 * User: njohns
 * Date: 2/18/15
 * Time: 5:08 PM
 */

namespace Rql\Query\Selecting;

use Rql\Datum;
use Rql\Generated\Term\TermType;
use Rql\Query\Query;
use Rql\Types\TypeResolver;

class Between extends Query
{
    public function __construct(Query $table, Datum $lowerKey, Datum $upperKey, array $options = [])
    {
        $this->terms[] = $table;
        $this->terms[] = $lowerKey;
        $this->terms[] = $upperKey;

        foreach($options as $key => $option) {
            $this->options[$key] = TypeResolver::resolve($option);
        }
    }

    protected function getDatumType()
    {
        return TermType::BETWEEN;
    }
}
