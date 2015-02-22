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
use Rql\Types\TypeResolver;

class TableCreate extends Query
{
    public function __construct(Query $db, Datum $tableName, array $options = [])
    {
        $this->terms[] = $db;
        $this->terms[] = $tableName;

        foreach($options as $key => $option) {
            $this->options[$key] = TypeResolver::resolve($option);
        }
    }

    protected function getDatumType()
    {
        return TermType::TABLE_CREATE;
    }
}
