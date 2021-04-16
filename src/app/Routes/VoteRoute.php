<?php

namespace Prophe1\WPProjectsCore\Routes;

use Prophe1\WPProjectsCore\Feature;

class VoteRoute extends Feature
{
    public static function getUserIp()
    {
        if (! empty(filter_var($_SERVER['HTTP_CLIENT_IP'], FILTER_VALIDATE_IP))) {
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        } elseif (! empty(filter_var($_SERVER['HTTP_X_FORWARDED_FOR'], FILTER_VALIDATE_IP))) {
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else {
            $ip = $_SERVER['REMOTE_ADDR'];
        }

        return $ip;
    }

    private static function getToken()
    {
        return isset($_SERVER['HTTP_X_CSRF_TOKEN']) ? $_SERVER['HTTP_X_CSRF_TOKEN'] : '';
    }

    private static function getCount($postId, $metaKey)
    {
        return get_post_meta($postId, $metaKey, true);
    }

    public static function checkVoteMeta($postId, $metaKey)
    {
        return get_post_meta($postId, $metaKey, true);
    }

    public static function checkIps($postId, $metaKey, $single)
    {
        return get_post_meta($postId, $metaKey, $single);
    }

    private static function addCount($postId, $metaKey, $status)
    {
        if ($metaKey) {
            if (array_key_exists(self::getUserIp(), self::checkIps($postId, $metaKey, true))) {
                if ($status == '_like') {
                    if (self::getCount($postId, '_like') > 0) {
                        update_post_meta($postId, '_like', self::getCount($postId, '_like') - 1);
                        update_post_meta($postId, '_dislike', self::getCount($postId, '_dislike') + 1);
                    } else {
                        update_post_meta($postId, '_like', self::getCount($postId, '_like') + 1);
                        update_post_meta($postId, '_dislike', self::getCount($postId, '_dislike') - 1);
                    }
                }

                if ($status == '_dislike') {
                    if (self::getCount($postId, '_dislike') > 0) {
                        update_post_meta($postId, '_dislike', self::getCount($postId, '_dislike') - 1);
                        update_post_meta($postId, '_like', self::getCount($postId, '_like') + 1);
                    } else {
                        update_post_meta($postId, '_dislike', self::getCount($postId, '_dislike') + 1);
                        update_post_meta($postId, '_like', self::getCount($postId, '_like') - 1);
                    }
                }
            }
        }
    }

    private static function addIps($postId, $metaKey, $status)
    {
        $liked_ips = (empty(self::checkIps($postId, $metaKey, true))) ? array() : self::checkIps($postId, $metaKey, true);

        if (!array_key_exists(self::getUserIp(), $liked_ips)) {
            $liked_ips[self::getUserIp()] = [$status];
        } else {
            $liked_ips[self::getUserIp()] = [$status];
        }
        self::addCount($postId, $metaKey, $status);
        update_post_meta($postId, $metaKey, $liked_ips);
    }

    private static function updateMeta($postId, $metaKey)
    {
        if (is_numeric(self::checkVoteMeta($postId, $metaKey)) && self::checkIps($postId, '_ips', false)) {
            self::addIps($postId, '_ips', $metaKey);
        } else {
            update_post_meta($postId, $metaKey, 0);
            self::addIps($postId, '_ips', $metaKey);
        }
    }

    public static function initVote()
    {
        if (sanitize_text_field($_POST['key'] == 'like')) {
            if (wp_verify_nonce(self::getToken(), 'nonce')) {
                self::updateMeta(sanitize_text_field($_POST['value']), '_like');
            }
        }

        if (sanitize_text_field($_POST['key'] == 'dislike')) {
            if (wp_verify_nonce(self::getToken(), 'nonce')) {
                self::updateMeta(sanitize_text_field($_POST['value']), '_dislike');
            }
        }
    }

    public function register()
    {
        add_action('wp_ajax_vote', [$this, 'initVote']);
        add_action('wp_ajax_nopriv_vote', [$this, 'initVote']);
    }
}
