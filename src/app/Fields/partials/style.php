<?php

use StoutLogic\AcfBuilder\FieldsBuilder;

$group = new FieldsBuilder('style');

$group
    ->addSelect('style', [
        'default' => 'rounded'
    ])
    ->addChoices([
        'rounded' => 'Rounded',
        'simple' => 'Simple'
    ]);

return $group;
