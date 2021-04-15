<?php

namespace App\Fields;

use StoutLogic\AcfBuilder\FieldsBuilder;

$group = new FieldsBuilder('mode');

$group
    ->addSelect('mode', [
        'default' => 'light'
    ])
        ->addChoices([
            'light' => 'Light',
            'dark' => 'Dark'
        ]);

return $group;
