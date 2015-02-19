<?php
/**
 * Created by PhpStorm.
 * User: njohns
 * Date: 1/3/15
 * Time: 10:45 PM
 */

namespace Rql\Query\Queries\Db;

use Rql\Generated\Term\TermType;
use Rql\Query\Queries\Query;
use Rql\Query\Queries\Table;
use Rql\Types\TypeResolver;

class Db extends Query
{
    public function __construct($name)
    {
        $this->terms[] = $name;
    }

    protected function getDatumType()
    {
        return TermType::DB;
    }

    public function table($name, $useOutdated = false)
    {
        $option = TypeResolver::resolve(['useOutdated' => $useOutdated]);
        $name = TypeResolver::resolve($name);

        return new Table($name, $option, $this);
    }
}
