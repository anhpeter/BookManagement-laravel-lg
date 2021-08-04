<?php

namespace App\Common\Helper;

use Illuminate\Support\Facades\Config;

class MyHelper
{

    public static function getStatusHtml($controller, $id, $value)
    {
        $field = 'status';
        $template = self::getConfig()['template'][$controller]['filter'][$field];
        $result = '';
        $currentTemplate = $template[$value];
        $result = sprintf('<button class="%s btn-sm">%s</button>', $currentTemplate['class'], $currentTemplate['content']);
        return $result;
    }

    public static function getConfig()
    {
        return Config::get('my_config');
    }
}
