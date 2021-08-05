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

    public static function getFormLabelClass()
    {
        return self::getConfig()['form']['label'];
    }

    public static function getFormInputClass($type)
    {
        return self::getConfig()['form']['input'][$type];
    }

    public static function getFormInputContainerClass()
    {
        return self::getConfig()['form']['input-container'];
    }

    public static function getSubmitContainerClass()
    {
        return self::getConfig()['form']['submit-container'];
    }
}
