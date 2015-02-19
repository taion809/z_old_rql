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

class ObjectType extends Datum
{
    private $value;

    public function __construct($value)
    {
        $this->value = (object) $value;
    }

    public function build()
    {
        return (object) $this->value;
    }

    protected function getDatumType()
    {
        return TermType::MAKE_OBJ;
    }
}
