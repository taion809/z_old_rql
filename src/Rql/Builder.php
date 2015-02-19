<?php
/**
 * Created by PhpStorm.
 * User: njohns
 * Date: 2/18/15
 * Time: 5:35 PM
 */

namespace Rql;

use Rql\Query\Queries\Db\Db;
use Rql\Query\Queries\Db\DbCreate;
use Rql\Query\Queries\Db\DbDrop;
use Rql\Query\Queries\Db\DbList;
use Rql\Query\Queries\Table;
use Rql\Types\TypeResolver;

class Builder
{
    /**
     * @param $name
     * @return Db
     */
    public static function db($name)
    {
        return new Db(TypeResolver::resolve($name));
    }

    public static function dbCreate($name)
    {
        return new DbCreate(TypeResolver::resolve($name));
    }

    public static function dbDrop($name)
    {
        return new DbDrop(TypeResolver::resolve($name));
    }

    public static function dbList()
    {
        return new DbList();
    }

    /**
     * @param string $name
     * @param bool $useOutdated
     * @return Table
     */
    public static function table($name, $useOutdated = false)
    {
        $option = TypeResolver::resolve(['useOutdated' => $useOutdated]);
        $name = TypeResolver::resolve($name);

        return new Table($name, $option);
    }
}
