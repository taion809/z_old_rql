<?php
/**
 * Created by PhpStorm.
 * User: njohns
 * Date: 1/26/15
 * Time: 6:37 PM
 */

namespace Rql\Tests;
error_reporting(E_ALL | E_STRICT);

$loader = require __DIR__ . '/../../../vendor/autoload.php';
$loader->add('Rql\\Tests\\', __DIR__ . '/../../');
unset($loader);
