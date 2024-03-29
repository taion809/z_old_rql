<?php
/**
 * Created by PhpStorm.
 * User: njohns
 * Date: 1/4/15
 * Time: 9:52 AM
 */

namespace Rql\Query;

use Rql\Datum;
use Rql\Generated\Term\TermType;
use Rql\Query\Control\Json;
use Rql\Query\Transformations\Limit;
use Rql\Query\Writing\Insert;
use Rql\Types\TypeResolver;

class Table extends Query
{
    public function __construct(Datum $name, Datum $useOutdated = null, Query $db = null)
    {
        if($db) {
            $this->terms[] = $db;
        }

        $this->terms[] = $name;
        $this->options = $useOutdated;
    }

    public function getDatumType()
    {
        return TermType::TABLE;
    }

    public function limit($n)
    {
        return new Limit($this, TypeResolver::resolve($n));
    }

    public function insert($data)
    {
        if(is_object($data)) {
            $data = TypeResolver::resolve($data);
        } else {
            new Json(TypeResolver::make('json', $data));
        }

        return new Insert($this, $data);
    }

    public function get($primaryKey)
    {
        $primaryKey = TypeResolver::resolve($primaryKey);

        return new Selecting\Get($this, $primaryKey);
    }
}
