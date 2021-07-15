<?php

namespace Prophe1\WPProjectsCore\Routes;

use Prophe1\WPProjectsCore\Feature;

class LiveSearch extends Feature
{

    private static function getToken()
    {
        return isset($_SERVER['HTTP_X_CSRF_TOKEN']) ? $_SERVER['HTTP_X_CSRF_TOKEN'] : '';
    }

    public static function getParam()
    {
        return $_POST['param'] ? sanitize_text_field($_POST['param']) : '';
    }

    public static function getType()
    {
        return $_POST['type'] ? sanitize_text_field($_POST['type']) : '';
    }

    public static function getPosts($postType)
    {
        return get_posts([
            'post_type' => $postType,
            'posts_per_page' => -1,
            'post_status' => 'publish',
            's' => self::getParam()
        ]);
    }

    public static function getTaxonomy()
    {
        return get_object_taxonomies(self::getType());
    }

    public static function initSearch()
    {
        if (self::getParam() && self::getToken()) {
            echo \App\template('partials.searchResult', ['posts' => self::getPosts(self::getType()), 'param' => self::getParam()]);
            die();
        }
    }

    public function register()
    {
        add_action('wp_ajax_search', [$this, 'initSearch']);
        add_action('wp_ajax_nopriv_search', [$this, 'initSearch']);
    }
}
