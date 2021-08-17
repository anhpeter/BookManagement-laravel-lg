<?php

namespace App\Common\Config;

use Illuminate\Support\Facades\Config;

class MyConfig
{

    private static function getConfig()
    {
        return Config::get('my_config');
    }

    public static function getMailData()
    {
        return self::getConfig()['mail'];
    }

    public static function getTemplate()
    {
        return self::getConfig()['template'];
    }

    public static function getPath()
    {

        return self::getConfig()['path'];
    }

    public static function getItemDataForController($controller, $itemName)
    {
        return self::getConfig()['controller'][$controller][$itemName];
    }

    public static function getSelectData($itemName, $controller = null)
    {
        $template = self::getTemplate()[$itemName];
        unset($template['all']);
        $selectData =  array_map(function ($item) {
            return $item['content'];
        }, $template);
        if ($controller != null) {
            $itemNames = self::getConfig()['controller'][$controller][$itemName];
            $selectData = $controller != null ? array_intersect_key($selectData, array_flip($itemNames)) : $selectData;
        }
        return $selectData;
    }

    public static function getItemTemplateForController($controller, $itemName)
    {
        $itemNames = self::getConfig()['controller'][$controller][$itemName];
        $template = self::getTemplate()[$itemName];
        $result = array_intersect_key($template, array_flip($itemNames));
        return $result;
    }
}
