<?php

namespace Prophe1\WPProjectsCore\Routes;

use Prophe1\WPProjectsCore\Feature;

class VoteRoute extends Feature
{
    public function getUserIp()
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

    private function getToken()
    {
        return isset($_SERVER['HTTP_X_CSRF_TOKEN']) ? $_SERVER['HTTP_X_CSRF_TOKEN'] : '';
    }

    private function getLikeDislikeCount($postId, $metaKey)
    {
        return get_post_meta($postId, $metaKey, true);
    }

    private function checkIps($postId)
    {
        return (empty(get_post_meta($postId, '_ips', true))) ? [] : get_post_meta($postId, '_ips', true);
    }

    private function addIps($postId, $metaKey)
    {
        $liked_ips = $this->checkIps($postId);

        if (!array_key_exists($this->getUserIp(), $liked_ips)) {
            $liked_ips[$this->getUserIp()] = $metaKey;
        } else {
            $liked_ips[$this->getUserIp()] = $metaKey;
        }

        update_post_meta($postId, '_ips', $liked_ips);
    }

    private function getVotedStatus($postId)
    {
        $list = get_post_meta($postId, '_ips', true);

        return array_key_exists($this->getUserIp(), $list) ? $list[$this->getUserIp()] : die();
    }

    private function updateMeta($postId, $metaKey)
    {
        $this->addIps($postId, $metaKey);
        $count = $this->getLikeDislikeCount($postId, $metaKey) ? $this->getLikeDislikeCount($postId, $metaKey) : 0;

        if ($this->getVotedStatus($postId) == '_like') {
            update_post_meta($postId, '_like', $count + 1);

            $this->getLikeDislikeCount($postId, '_dislike') ?
                update_post_meta($postId, '_dislike', $this->getLikeDislikeCount($postId, '_dislike') - 1) :
                die();
        }

        if ($this->getVotedStatus($postId) == '_dislike') {
            update_post_meta($postId, '_dislike', $count + 1);

            $this->getLikeDislikeCount($postId, '_like') ?
                update_post_meta($postId, '_like', $this->getLikeDislikeCount($postId, '_like') - 1) :
                die();
        }
    }

    public function initVote()
    {
        if (sanitize_text_field($_POST['key'] == 'like') && wp_verify_nonce($this->getToken(), 'nonce')) {
            $this->updateMeta(sanitize_text_field($_POST['value']), '_like');
        }

        if (sanitize_text_field($_POST['key'] == 'dislike') && wp_verify_nonce($this->getToken(), 'nonce')) {
            $this->updateMeta(sanitize_text_field($_POST['value']), '_dislike');
        }
    }

    public function register()
    {
        add_action('wp_ajax_vote', [$this, 'initVote']);
        add_action('wp_ajax_nopriv_vote', [$this, 'initVote']);
    }
}
