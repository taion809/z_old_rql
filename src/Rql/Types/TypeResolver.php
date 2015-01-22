<?php
/**
 * Created by PhpStorm.
 * User: njohns
 * Date: 1/4/15
 * Time: 9:49 AM
 */

namespace Rql\Types;

class TypeResolver
{
    public static function resolve($type)
    {
        if(is_string($type)) {
            return new String($type);
        }
    }
}
