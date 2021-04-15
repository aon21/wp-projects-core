<?php

namespace Prophe1\WPProjectsCore;

use function App\config;

class Helpers {
    public static function getFieldPartial($partial, $dir = false) {
        if (! $dir) {
            $dir = PROPHE1_WP_PROJECT_CORE_FIELDS_DIR;
        }

        $partial = str_replace('.', '/', $partial);

        return include($dir . "{$partial}.php");

    }
}