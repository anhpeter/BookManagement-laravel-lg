<?php

namespace App\Common\Helper;

use Illuminate\Support\Facades\Config;

class MyHelper
{
    public static function getConfig()
    {
        return Config::get('my_config');
    }

    public static function isBase64($str)
    {
        return preg_match('/^data:image\/(\w+);base64,/', $str);
    }

    public static function convertStdClassToArray($item)
    {
        return json_decode(json_encode($item), true);
    }

    public static function convertFieldToFilterName($value)
    {
        return $value . '_filter';
    }

    public static function convertFilterNameToField($value)
    {
        return str_replace('_filter', '', $value);
    }

    public static function toPlural($controller)
    {
        return $controller.'s';
    }
}
