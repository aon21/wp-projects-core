<?php

namespace Prophe1\WPProjectsCore\Generic;

use Prophe1\WPProjectsCore\Feature;

class Nonce extends Feature {

    public function register()
    {
        add_action( 'wp_head', [$this, 'content']);
    }

    public function content()
    {
        $nonce = wp_create_nonce( 'nonce' );
        echo "<meta name='csrf-token' content='$nonce'>";
    }
}
