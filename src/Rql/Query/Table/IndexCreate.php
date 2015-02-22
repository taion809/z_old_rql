<?php
/**
 * Created by PhpStorm.
 * User: njohns
 * Date: 2/22/15
 * Time: 4:08 PM
 */

namespace Rql\Query\Table;

use Rql\Datum;
use Rql\Generated\Term\TermType;
use Rql\Query\Query;

class IndexCreate extends Query
{
    public function __construct(Query $table, Datum $indexName, array $options = [])
    {
        throw new \RuntimeException("Not Yet Implemented");

        $this->terms[] = $table;
        $this->terms[] = $indexName;

        foreach($options as $key => $option) {
            $this->options[$key] = TypeResolver::resolve($option);
        }
    }

    protected function getDatumType()
    {
        return TermType::INDEX_CREATE;
    }
}
