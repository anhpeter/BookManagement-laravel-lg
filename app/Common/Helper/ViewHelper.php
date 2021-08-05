<?php

namespace App\Common\Helper;
use Collective\Html;
use App\Common\Config\MyConfig;


class ViewHelper
{
    public static function getStatusHtml($controller, $id, $value)
    {
        $field = 'status';
        $template = MyConfig::getTemplate()['filter'][$field];
        $result = '';
        $currentTemplate = $template[$value];
        $result = sprintf('<button class="%s btn-sm">%s</button>', $currentTemplate['class'], $currentTemplate['content']);
        return $result;
    }

    public static function getStatusBadgeHtml($value)
    {
        $color = $value == 'active' ? 'success' : 'warning';
        $content = MyConfig::getTemplate()['filter']['status'][$value]['content'];
        $result = sprintf('<span class="badge badge-lg badge-%s">%s</span>', $color, $content);
        return $result;
    }

    //
}
