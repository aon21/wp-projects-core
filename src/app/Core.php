<?php

namespace Prophe1\WPProjectsCore;

final class Core
{
    private static $instance = null;

    private function __construct()
    {
        $this->setDefinitions();
    }

    private function setDefinitions()
    {
        define('PROPHE1_WP_PROJECT_CORE_DIR', plugin_dir_path(__FILE__) . '../');
    }

    public static function init(): self
    {
        if (self::$instance == null)
        {
            self::$instance = new self();
        }

        return self::$instance;
    }
}

Core::init();