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

class ArrayType extends Datum
{
    private $value;

    public function __construct(array $value)
    {
        $this->value = $value;
    }

    public function build()
    {
        return (array) $this->value;
    }

    protected function getDatumType()
    {
        return TermType::MAKE_ARRAY;
    }
}
