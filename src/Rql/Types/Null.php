<?php
/**
 * Created by PhpStorm.
 * User: njohns
 * Date: 2/18/15
 * Time: 5:10 PM
 */

namespace Rql\Types;

use Rql\Datum;
use Rql\Generated\Term\TermType;

class Null extends Datum
{
    private $value;

    public function __construct()
    {
        $this->value = null;
    }

    public function build()
    {
        return null;
    }

    protected function getDatumType()
    {
        return TermType::DATUM;
    }
}
