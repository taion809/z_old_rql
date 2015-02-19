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

class Number extends Datum
{
    private $value;

    public function __construct($value)
    {
        $this->value = (float) $value;
    }

    public function build()
    {
        return (float) $this->value;
    }

    protected function getDatumType()
    {
        return TermType::DATUM;
    }
}
