<?php

namespace Prophe1\WPProjectsCore\Routes;

use Prophe1\WPProjectsCore\Feature;

class VoteRoute extends Feature
{
    public static function getUserIp()
    {
        if (! empty(filter_var(getenv('HTTP_CLIENT_IP'), FILTER_VALIDATE_IP))) {
            $ip = getenv('HTTP_CLIENT_IP');
        } elseif (! empty(filter_var(getenv('HTTP_X_FORWARDED_FOR'), FILTER_VALIDATE_IP))) {
            $ip = getenv('HTTP_X_FORWARDED_FOR');
        } else {
            $ip = getenv('REMOTE_ADDR');
        }

        return $ip;
    }

    private static function getToken()
    {
        return isset($_SERVER['HTTP_X_CSRF_TOKEN']) ? $_SERVER['HTTP_X_CSRF_TOKEN'] : '';
    }

    private static function getLikeDislikeCount($postId, $metaKey)
    {
        return get_post_meta($postId, $metaKey, true);
    }

    private static function checkIps($postId)
    {
        return (empty(get_post_meta($postId, '_ips', true))) ? [] : get_post_meta($postId, '_ips', true);
    }

    private static function addIps($postId, $metaKey)
    {
        $liked_ips = self::checkIps($postId);

        if (!array_key_exists(self::getUserIp(), $liked_ips)) {
            $liked_ips[self::getUserIp()] = $metaKey;
        } else {
            $liked_ips[self::getUserIp()] = $metaKey;
        }

        update_post_meta($postId, '_ips', $liked_ips);
    }

    public static function getVotedStatus($postId)
    {
        $list = get_post_meta($postId, '_ips', true) ? get_post_meta($postId, '_ips', true) : [];

        return array_key_exists(self::getUserIp(), $list) ? $list[self::getUserIp()] : '';
    }

    private static function updateMeta($postId, $metaKey)
    {

        $count = self::getLikeDislikeCount($postId, $metaKey) ? self::getLikeDislikeCount($postId, $metaKey) : 0;

        if (!self::getVotedStatus($postId) || self::getVotedStatus($postId) != $metaKey) {
            update_post_meta($postId, $metaKey, $count + 1);

            if (self::getVotedStatus($postId)) {
                update_post_meta($postId, self::getVotedStatus($postId), self::getLikeDislikeCount($postId, self::getVotedStatus($postId)) - 1);
            }

            self::addIps($postId, $metaKey);
        }
    }

    public static function initVote()
    {
        if (sanitize_text_field($_POST['key'] == 'like') && wp_verify_nonce(self::getToken(), 'nonce')) {
            self::updateMeta(sanitize_text_field($_POST['value']), '_like');
        }

        if (sanitize_text_field($_POST['key'] == 'dislike') && wp_verify_nonce(self::getToken(), 'nonce')) {
            self::updateMeta(sanitize_text_field($_POST['value']), '_dislike');
        }
    }

    public function register()
    {
        add_action('wp_ajax_vote', [$this, 'initVote']);
        add_action('wp_ajax_nopriv_vote', [$this, 'initVote']);
    }
}
