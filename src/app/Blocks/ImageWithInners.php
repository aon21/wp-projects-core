<?php

namespace Prophe1\WPProjectsCore\Blocks;

use Prophe1\ACFBlockz\AbstractACFBladeBlock;
use StoutLogic\AcfBuilder\FieldsBuilder;

class ImageWithInners extends AbstractACFBladeBlock
{
    /**
     * Hero constructor.
     * @throws \ReflectionException
     */
    public function __construct()
    {
        parent::__construct([
            'title' => __('Image with Inners', 'sage'),
            'description' => __('Create a Image with Inners block', 'sage'),
            'category' => 'layout',
            'icon' => 'businessman',
            'mode' => 'preview',
            'dir' => 'WPPRCORE::',
            'parent' => ['acf/image-with-inners', 'acf/inner-blocks'],
            'supports' => [
                'align' => false,
                'mode' => false,
                'jsx' => true
            ],
        ]);
    }

    /**
     * @return \string[][]
     */
    public function getInnerBlocks()
    {
        return [
            'allowed_blocks' => apply_filters('wp-projects-core_image_with_inners_allowed_blocks', [
                'core/heading',
                'core/paragraph',
                'acf/icon-with-content',
                'acf/card',
                'acf/form'
            ])
        ];
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
            ->addImage('image', [
                'return_format' => 'id'
            ])
            ->addSelect('image_position')
                ->addChoices([
                    'left' => 'Left',
                    'right' => 'Right'
                ]);

        $block
            ->addSelect('image_alignment')
                ->addChoices([
                    'top' => 'Top',
                    'center' => 'Center'
                ]);

        $block
            ->addTrueFalse('shadows', [
                'label' => 'Enable Shadows'
            ])
            ->addTrueFalse('image_fixed', [
                'label' => 'Fix Image',
                'conditional_logic' => [
                    'field' => 'image_alignment',
                    'operator' => '==',
                    'value' => 'top',
                ]
            ]);

        $block->setLocation('block', '==', sprintf('acf/%s', $this->name));

        return $block->build();
    }
}
