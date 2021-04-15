<?php

namespace Prophe1\WPProjectsCore\Directives;

use Prophe1\WPProjectsCore\Feature;
use function App\asset_path;
use function App\sage;

class SVG extends Feature {

    public function register()
    {
        /**
         * Create @svg() Blade directive
         */
        sage('blade')->compiler()->directive('svg', function ($arguments) {
            // Funky madness to accept multiple arguments into the directive
            [$path, $class] = array_pad(explode(',', trim($arguments, "() ")), 2, '');
            $path = trim($path, "' ");
            $class = trim($class, "' ");

            $svg_directory = get_template_directory() . '/assets/' . $path;

            if (!file_exists($svg_directory)) {
                return false;
            }

            // Create the dom document as per the other answers
            $svg = new \DOMDocument();

            if (!$svg->load(asset_path($path))) {
                $svg->load($svg_directory);
            }

            $svg->documentElement->setAttribute("class", $class);
            $output = $svg->saveXML($svg->documentElement);

            return $output;
        });
    }
}