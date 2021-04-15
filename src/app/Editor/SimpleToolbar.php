<?php

namespace Prophe1\WPProjectsCore\Editor;

use Prophe1\WPProjectsCore\Feature;

class SimpleToolbar extends Feature
{
    const TOOLBAR_SLUG = 'toolbar_simple';

    public function register()
    {
        add_filter('acf/fields/wysiwyg/toolbars', [$this, 'addToolbar']);
    }

    public function addToolbar()
    {
        // formatselect,bold,italic,bullist,numlist,blockquote,alignleft,aligncenter,alignright,link,unlink,wp_more
        // spellchecker,fullscreen,wp_adv,strikethrough,hr,forecolor,pastetext,removeformat,charmap,outdent,indent,undo,redo,wp_help
        $toolbars[self::TOOLBAR_SLUG][] = apply_filters('wp-projects-core_simple_toolbar_items', [
            'bold',
            'italic',
            'underline',
            'bullist',
            'numlist',
            'alignleft',
            'aligncenter',
            'alignright',
            'link',
            'unlink'
        ]);

        return $toolbars;
    }
}