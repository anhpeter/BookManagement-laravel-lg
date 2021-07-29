<?php

namespace App\Common\Helper;

use Illuminate\Support\Facades\Config;

class MyHelper
{
    public static function getStatusHtml($controller, $id, $value)
    {
        $field = 'status';
        $config = Config::get('my_config');
        $template = $config['template'][$controller]['filter'][$field];
        $result = '';
        $currentTemplate = $template[$value];
        $result = sprintf( '<button class="%s btn-sm">%s</button>', $currentTemplate['class'], $currentTemplate['content']);
        return $result;
    }
}
