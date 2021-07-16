<?php

namespace Prophe1\WPProjectsCore\Routes;

use Prophe1\WPProjectsCore\Feature;

class Views extends Feature
{
    public static function getUserIp()
    {
        return $_SERVER['REMOTE_ADDR'];
    }

    private static function getToken()
    {
        return isset($_SERVER['HTTP_X_CSRF_TOKEN']) ? $_SERVER['HTTP_X_CSRF_TOKEN'] : '';
    }

    public static function getViewCount($postId, $metaKey)
    {
        return get_post_meta($postId, $metaKey, true);
    }

    private static function checkIps($postId)
    {
        return (empty(get_post_meta($postId, '_seen_ips', true))) ? [] : get_post_meta($postId, '_seen_ips', true);
    }

    private static function addIps($postId)
    {
        $liked_ips = self::checkIps($postId);

        if (!in_array(self::getUserIp(), $liked_ips)) {
            $liked_ips[] = self::getUserIp();
        }
        update_post_meta($postId, '_seen_ips', $liked_ips);
    }

    public static function setPostViews($postId, $metaKey)
    {
        if (!in_array(self::getUserIp(), self::checkIps($postId))) {
            $count = self::getViewCount($postId, $metaKey) ? self::getViewCount($postId, $metaKey) : 0;
            update_post_meta($postId, $metaKey, $count + 1);
            self::addIps($postId);
        }
    }

    public static function initView()
    {
        if (wp_verify_nonce(self::getToken(), 'nonce')) {
            self::setPostViews(sanitize_text_field($_POST['value']), '_seen');
        }
    }
    public function register()
    {
        add_action('wp_ajax_postview', [$this, 'initView']);
        add_action('wp_ajax_nopriv_postview', [$this, 'initView']);
    }
}
