<?php
/**
 * Created by PhpStorm.
 * User: njohns
 * Date: 1/26/15
 * Time: 10:24 PM
 */

namespace Rql\Tests\Connection;

use GuzzleHttp\Stream\Stream;
use GuzzleHttp\Stream\StreamInterface;

class NullWriteStream extends Stream implements StreamInterface
{
    public function write($string)
    {
        return strlen($string);
    }
}
