<?php

namespace Prophe1\WPProjectsCore;

use Prophe1\WPProjectsCore\Editor\SimpleToolbar;
use Prophe1\WPProjectsCore\Forms\SubscribeForm;
use Prophe1\WPProjectsCore\Generic\Nonce;
use Prophe1\WPProjectsCore\Routes\LiveSearch;
use Prophe1\WPProjectsCore\Routes\Views;
use Prophe1\WPProjectsCore\Routes\VoteRoute;

final class Core
{
    private static $instance = null;

    /**
     * @var Feature[]
     */
    private $features;

    private function __construct()
    {
        $this->setDefinitions();
        $this->setFeatures();
    }

    private function setDefinitions()
    {
        define('PROPHE1_WP_PROJECT_CORE_VIEWS_DIR', plugin_dir_path(__FILE__) . '../resources/views/');
        define('PROPHE1_WP_PROJECT_CORE_FIELDS_DIR', plugin_dir_path(__FILE__) . 'Fields/');
    }

    /**
     * @var $features Feature
     */
    private function setFeatures()
    {
        $this->features = apply_filters('wp-projects-core_features', [
            SimpleToolbar::class,
            Nonce::class,
            SubscribeForm::class,
            LiveSearch::class,
            VoteRoute::class,
            Views::class
        ]);
    }

    public function initFeatures()
    {
        foreach ($this->features as $feature) {
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
