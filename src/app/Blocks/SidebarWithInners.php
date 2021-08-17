<?php

namespace Prophe1\WPProjectsCore\Blocks;

use Prophe1\ACFBlockz\AbstractACFBladeBlock;
use StoutLogic\AcfBuilder\FieldNameCollisionException;
use StoutLogic\AcfBuilder\FieldsBuilder;

class SidebarWithInners extends AbstractACFBladeBlock
{
    /**
     * Hero constructor.
     * @throws \ReflectionException
     */
    public function __construct()
    {
        parent::__construct([
            'title' => __('Sidebar With Inners', 'sage'),
            'description' => __('Create a Sidebar with Inners block', 'sage'),
            'category' => 'layout',
            'icon' => 'businessman',
            'mode' => 'preview',
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
            'allowed_blocks' => apply_filters('wp-projects-core_sidebar_with_inners_allowed_blocks', [
                'core/heading',
                'core/paragraph',
                'acf/image-with-inners',
                'core/columns',
            ])
        ];
    }

    /**
     * Generate block fields
     *
     * @return array
     * @throws FieldNameCollisionException
     */
    protected function registerFields(): array
    {
        $block = new FieldsBuilder($this->name);

        $block
            ->addText('offsetTop', [
                'label' => __('Top Offset', 'sage')
            ]);
        $block
            ->addSelect('sidebar_position')
            ->addChoices([
                'left' => 'Left',
                'right' => 'Right'
            ]);
        $block
            ->addRepeater('sidebarItems', [
                'label' => __('Sidebar Items', 'sage'),
                'layout' => 'block',
            ])
            ->addLink('sidebarLink', [
                'label' => __('Select sidebar link', 'sage'),
                'return' => 'array'
            ])
            ->endRepeater();

        $block->setLocation('block', '==', sprintf('acf/%s', $this->name));

        return $block->build();
    }
}
