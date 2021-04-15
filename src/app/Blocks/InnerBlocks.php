<?php

namespace Prophe1\WPProjectsCore\Blocks;

use Prophe1\ACFBlockz\AbstractACFBladeBlock;
use StoutLogic\AcfBuilder\FieldNameCollisionException;
use StoutLogic\AcfBuilder\FieldsBuilder;

class InnerBlocks extends AbstractACFBladeBlock
{
    /**
     * Hero constructor.
     * @throws \ReflectionException
     */
    public function __construct()
    {
        parent::__construct([
            'title' => __('Inner Blocks', 'sage'),
            'description' => __('Create a Inner Block', 'sage'),
            'category' => 'layout',
            'icon' => 'businessman',
            'mode' => 'preview',
            'dir' => 'WPPRCORE::',
            'supports' => [
                'align' => false,
                'mode' => false,
                'jsx' => true
            ],
        ]);
    }

    public function bgIsColor()
    {
        return $this->acf['background'] === 'color';
    }

    public function bgIsImage()
    {
        return $this->acf['background'] === 'image';
    }

    public function hasColor()
    {
        return $this->bgIsColor() && $this->getColor();
    }

    public function hasImage()
    {
        return $this->bgIsImage() && $this->getImage();
    }

    public function getImage()
    {
        return isset($this->acf['background_image']) ? $this->acf['background_image'] : null;
    }

    public function getColor()
    {
        return isset($this->acf['color']) ? $this->acf['color'] : null;
    }

    public function getWrap()
    {
        return isset($this->acf['wrap']) ? $this->acf['wrap'] : null;
    }

    /**
     * @return \string[][]
     */
    public function getInnerBlocks()
    {
        return [
            'allowed_blocks' => [
                'core/heading',
                'core/paragraph',
                'acf/icon-with-content',
                'core/columns',
                'acf/resources',
                'acf/icon-list',
                'core/table',
                'acf/inner-blocks',
                'core/block'
            ]
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
            ->addSelect('background')
                ->addChoices([
                    'none' => 'None',
                    'color' => 'Color',
                    'image' => 'Image'
                ]);

        $block
            ->addImage('background_image', [
                'return_format' => 'id',
                'conditional_logic' => [
                    'field' => 'background',
                    'operator' => '==',
                    'value' => 'image',
                ]
            ]);

        $block
            ->addSelect('color', [
                'default' => 'bg-deep-blue-5',
                'conditional_logic' => [
                    'field' => 'background',
                    'operator' => '==',
                    'value' => 'color',
                ]
            ])
                ->addChoices([
                    'bg-deep-blue-5' => 'Light Grey'
                ]);

        $block
            ->addSelect('wrap', [
                'default' => null
            ])
                ->addChoices([
                    null => 'Default',
                    'laptop:max-w-992' => 'Normal',
                    'laptop:max-w-768' => 'Small'
                ]);

        $block->setLocation('block', '==', sprintf('acf/%s', $this->name));

        return $block->build();
    }
}
