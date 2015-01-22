<?php
/**
 * Created by PhpStorm.
 * User: njohns
 * Date: 1/2/15
 * Time: 8:48 AM
 */

namespace Rql\Connection;

interface ConnectionInterface
{
    public function connect();
    public function close();
    public function getConnection();
    public function write($message);
    public function read($bytes, $step = 0);
    public function sendQuery($query, $token);
    public static function makeConnection($resource, $options);
}
