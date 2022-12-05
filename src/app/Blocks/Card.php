<?php

namespace Prophe1\WPProjectsCore\Blocks;

use Prophe1\ACFBlockz\AbstractACFBladeBlock;
use StoutLogic\AcfBuilder\FieldsBuilder;

class Card extends AbstractACFBladeBlock
{
    /**
     * Hero constructor.
     * @throws \ReflectionException
     */
    public function __construct()
    {
        parent::__construct([
            'title' => __('Card', 'sage'),
            'description' => __('Create a Card block', 'sage'),
            'category' => 'layout',
            'icon' => 'businessman',
            'mode' => 'preview',
            'dir' => 'WPPRCORE::',
            'parent' => ['acf/inner-blocks', 'core/column'],
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
            'allowed_blocks' => apply_filters('wp-projects-core_card_allowed_blocks', [
                'core/heading',
                'core/paragraph',
                'acf/button',
                'core/list',
                'core/list-item',
                'acf/resources',
                'acf/icon-list'
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
            ->addSelect('design', [
                'label' => 'Card Design'
            ])
                ->addChoices(apply_filters('wp-projects-core_card_design_choices', [
                    null => 'None',
                    'bg-deep-blue-5' => 'Grey',
                    'bg-white border border-deep-blue-4' => 'White Bordered'
                ]));

        $block->setLocation('block', '==', sprintf('acf/%s', $this->name));

        return $block->build();
    }
}
