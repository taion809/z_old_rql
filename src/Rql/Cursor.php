<?php
/**
 * Created by PhpStorm.
 * User: njohns
 * Date: 1/2/15
 * Time: 9:00 AM
 */

namespace Rql;

class Cursor extends \NoRewindIterator
{
    protected $iterator;

    public function __construct(\Iterator $iterator) {
        $this->iterator = $iterator;
    }

    public function getInnerIterator()
    {
        return $this->iterator;
    }


}
