<?php

namespace Prophe1\WPProjectsCore;

use Prophe1\WPProjectsCore\Directives\SVG;
use Prophe1\WPProjectsCore\Editor\SimpleToolbar;

final class Core
{
    private static $instance = null;

    private function __construct()
    {
        $this->setDefinitions();
        $this->enableFeatures();
    }

    private function setDefinitions()
    {
        define('PROPHE1_WP_PROJECT_CORE_VIEWS_DIR', plugin_dir_path(__FILE__) . '../resources/views/');
        define('PROPHE1_WP_PROJECT_CORE_FIELDS_DIR', plugin_dir_path(__FILE__) . 'Fields/');
    }

    /**
     * @var $features Feature
     */
    private function enableFeatures()
    {
        $features = apply_filters('wp-projects-core_features', [
            SimpleToolbar::class,
            SVG::class
        ]);

        foreach ($features as $feature) {
            (new $feature)->register();
        }
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
