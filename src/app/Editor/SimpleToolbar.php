<?php

namespace Prophe1\WPProjectsCore\Editor;

class SimpleToolbar
{
    const TOOLBAR_SLUG = 'toolbar_simple';

    public function __construct()
    {
        /**
         * Add "Simple" toolbar to ACF WYSIWYG
         */
        add_filter('acf/fields/wysiwyg/toolbars', function ($toolbars) {
            // formatselect,bold,italic,bullist,numlist,blockquote,alignleft,aligncenter,alignright,link,unlink,wp_more
            // spellchecker,fullscreen,wp_adv,strikethrough,hr,forecolor,pastetext,removeformat,charmap,outdent,indent,undo,redo,wp_help
            $toolbars[THEME_TOOLBAR_SIMPLE][] = [
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
            ];

            return $toolbars;
        });
    }
}