<?php

namespace App\Common\Helper;

use Illuminate\Support\Facades\Config;

class MyHelper
{



    public static function getConfig()
    {
        return Config::get('my_config');
    }
}
