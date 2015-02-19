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

class Json extends Datum
{
    private $value;

    public function __construct($value)
    {
        $this->value = $this->encode($value);
    }

    public function build()
    {
        return (string) $this->value;
    }

    protected function getDatumType()
    {
        return TermType::DATUM;
    }

    private function encode($value) {
        $precision = ini_get('precision');
        if($precision === false || $precision < 17) {
            ini_set('precision', 17);
        }

        $json = json_encode($value);

        ini_set('precision', $precision);

        return $json;
    }
}
