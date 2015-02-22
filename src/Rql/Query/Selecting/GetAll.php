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

class GetAll extends Query
{
    public function __construct(Query $table, Datum $primaryKey, array $options = [])
    {
        $this->terms[] = $table;
        $this->terms[] = $primaryKey;

        foreach($options as $key => $option) {
            $this->options[$key] = TypeResolver::resolve($option);
        }
    }

    protected function getDatumType()
    {
        return TermType::GET_ALL;
    }
}
