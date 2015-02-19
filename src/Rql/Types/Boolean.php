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

class Boolean extends Datum
{
    private $value;

    public function __construct($value)
    {
        $this->value = (bool) $value;
    }

    public function build()
    {
        return (bool) $this->value;
    }

    protected function getDatumType()
    {
        return TermType::DATUM;
    }
}
