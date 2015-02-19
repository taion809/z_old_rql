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
    /**
     * @param $type
     * @return \Rql\Datum
     */
    public static function resolve($type = null)
    {
        if(is_null($type)) {
            return new Null();
        }

        if(is_string($type)) {
            return new String($type);
        }

        if(is_bool($type)) {
            return new Boolean($type);
        }

        if(is_numeric($type)) {
            return new Number($type);
        }

        if(is_array($type)) {
            return new ArrayType($type);
        }

        if(is_object($type)) {
            return new ObjectType($type);
        }
    }

    /**
     * @param string $type
     * @param mixed $data
     * @return \Rql\Datum
     */
    public static function make($type, $data)
    {
        $namespace = '\Rql\Types';
        $type = ucfirst(strtolower($type));

        if($type == 'Object' || $type == 'Array') {
            $type .= 'Type';
        }

        $classname = $namespace . '\\' . $type;
        return new $classname($data);
    }
}
