<?php

namespace Prophe1\WPProjectsCore\Blocks;

use Prophe1\ACFBlockz\AbstractACFBladeBlock;
use Prophe1\WPProjectsCore\Helpers;
use StoutLogic\AcfBuilder\FieldsBuilder;

class Button extends AbstractACFBladeBlock
{
    /**
     * Hero constructor.
     * @throws \ReflectionException
     */
    public function __construct()
    {
        parent::__construct([
            'title' => __('Button', 'sage'),
            'description' => __('Create a Button block', 'sage'),
            'category' => 'layout',
            'icon' => 'businessman',
            'mode' => 'preview',
            'dir' => 'WPPRCORE::',
            'parent' => ['acf/image-with-inners', 'acf/inner-blocks', 'acf/card'],
            'supports' => [
                'align' => ['left', 'right', 'center'],
                'mode' => false,
                'jsx' => true
            ],
        ]);
    }

    public function getButtonClass()
    {
        $class = isset($this->acf['full']) && $this->acf['full'] === true ? 'w-full ' : '';

        if ($this->acf['design'] === 'outlined') {
            $class .= 'btn--outline btn--outline--green ';

            if ($this->acf['mode'] === 'dark') {
                $class .= 'btn--outline--green--dark ';
            }
        } else {
            $class .= 'btn--green text-white';
        }

        return $class;
    }

    public function getRel()
    {
        return isset($this->acf['rel']) && $this->acf['rel'] ? $this->acf['rel'] : null;
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
            ->addFields(Helpers::getFieldPartial('partials.mode'));

        $block
            ->addSelect('design', [
                'default' => 'solid'
            ])
            ->addChoices([
                'solid' => 'Solid',
                'outlined' => 'Outlined'
            ]);

        $block
            ->addSelect('action', [
                'default' => 'link'
            ])
            ->addChoices([
                'link' => 'Link',
                'button' => 'Button',
                'modal' => 'Modal',
            ]);

        $block
            ->addLink('link', [
                'conditional_logic' => [
                    'field' => 'action',
                    'operator' => '==',
                    'value' => 'link',
                ]
            ]);
        $block
            ->addText('buttonName', [
                'label' => 'Button name',
                'conditional_logic' => [
                    [
                        'field' => 'action',
                        'operator' => '==',
                        'value' => 'modal',
                    ],
                ],
            ]);

        $block
            ->addText('kButtonName', [
                'label' => __('Kayako button name', 'sage'),
                'conditional_logic' => [
                    'field' => 'action',
                    'operator' => '==',
                    'value' => 'button',
                ]
            ]);

        $block
            ->addText('rel', [
                'conditional_logic' => [
                    'field' => 'action',
                    'operator' => '==',
                    'value' => 'link',
                ]
            ]);

        $block
            ->addTrueFalse('full', [
                'label' => __('Full Width?', 'sage'),
            ]);

        $block->setLocation('block', '==', sprintf('acf/%s', $this->name));

        return $block->build();
    }
}
