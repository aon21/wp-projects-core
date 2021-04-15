<?php

namespace Prophe1\WPProjectsCore\Blocks;

use Prophe1\ACFBlockz\AbstractACFBladeBlock;
use StoutLogic\AcfBuilder\FieldsBuilder;

class Form extends AbstractACFBladeBlock
{
    /**
     * Hero constructor.
     * @throws \ReflectionException
     */
    public function __construct()
    {
        parent::__construct([
            'title' => __('Form', 'sage'),
            'description' => __('Create a Form block', 'sage'),
            'category' => 'layout',
            'icon' => 'businessman',
            'mode' => 'preview',
            'dir' => 'WPPRCORE::',
            'parent' => ['acf/image-with-inners', 'acf/inner-blocks', 'acf/card'],
            'supports' => [
                'align' => false,
                'mode' => false,
                'jsx' => true
            ],
        ]);
    }

    /**
     * Generate block fields
     *
     * @return array
     * @throws \StoutLogic\AcfBuilder\FieldNameCollisionException
     */
    protected function registerFields(): array
    {
        $block = new FieldsBuilder($this->name);

        $block
            ->addPostObject('form', [
                'label' => 'Form',
                'post_type' => ['wpcf7_contact_form'],
                'return_format' => 'id'
            ]);

        $block->setLocation('block', '==', sprintf('acf/%s', $this->name));

        return $block->build();
    }
}
