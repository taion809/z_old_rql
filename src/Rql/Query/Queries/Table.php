<?php
/**
 * Created by PhpStorm.
 * User: njohns
 * Date: 1/4/15
 * Time: 9:52 AM
 */

namespace Rql\Query\Queries;

use Rql\Datum;
use Rql\Generated\Term\TermType;

class Table extends Query
{
    public function __construct(Datum $db, $name, array $options = [])
    {
        if($db) {
            $this->terms[] = $db;
        }

        $this->terms[] = $name;

        foreach($options as $key => $option) {
            $this->options[$key] = $option;
        }
    }

    public function getDatumType()
    {
        return TermType::TABLE;
    }
}
