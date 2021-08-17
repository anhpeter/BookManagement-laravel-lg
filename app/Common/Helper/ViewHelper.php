<?php

namespace App\Common\Helper;

use Collective\Html;
use App\Common\Config\MyConfig;
use Illuminate\Support\Facades\Storage;

class ViewHelper
{
    public static function getStatusBadgeHtml($value)
    {
        $template = MyConfig::getTemplate()['status'][$value];
        $color = str_replace('btn btn-', '', MyConfig::getTemplate()['status'][$value]['class']);
        $result = sprintf('<span class="badge badge-lg badge-%s">%s</span>', $color, $template['content']);
        return $result;
    }

    public static function getInfoDataRow($label, $value)
    {
        //if ($value)
        return sprintf(
            '<div class="data-row align-items-center">
                        <span class="label">%s</span>
                        <div class="value">%s</div>
                    </div> ',
            $label,
            $value ?? '<span class="text-muted">(empty)</span>'
        );

        //return '';
    }

    public static function getAvatarPath($filename)
    {
        if ($filename) {
            $path = asset('storage/img/profile/avatar/' . $filename);
            if (Storage::disk('public')->exists('img/profile/avatar/' . $filename)) return $path;
        }
        return asset('storage/img/common/avatar-empty.png');
    }

    public static function getMenuItemClass($currentController, $controller)
    {
        return $currentController === $controller ? 'active' : '';
    }
    //
}
