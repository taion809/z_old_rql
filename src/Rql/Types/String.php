<?php
/**
 * Created by PhpStorm.
 * User: njohns
 * Date: 1/4/15
 * Time: 9:45 AM
 */

namespace Rql\Types;

use Rql\Datum;
use Rql\Generated\Term\TermType;

class String extends Datum
{
    private $value;

    public function __construct($value)
    {
        $this->value = $value;
    }

    public function build()
    {
        return (string) $this->value;
    }

    protected function getDatumType()
    {
        return TermType::DATUM;
    }
}
