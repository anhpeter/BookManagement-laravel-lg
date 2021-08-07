<?php

namespace App\Common\Config;

use Illuminate\Support\Facades\Config;

class MyConfig
{

    private static function getConfig()
    {
        return Config::get('my_config');
    }

    public static function getTemplate()
    {
        return self::getConfig()['template'];
    }

    public static function getPath()
    {

        return self::getConfig()['path'];
    }

    public static function getItemTemplateForController($controller, $itemName)
    {
        $itemNames = self::getConfig()['controller'][$controller]['action'];
        $itemNamesFlip = array_flip($itemNames);
        $template = self::getTemplate()[$itemName];
        $result = array_intersect_key($template, $itemNamesFlip);
        return $result;
    }
}
