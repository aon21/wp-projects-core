<?php

namespace Prophe1\WPProjectsCore\Blocks;

use Prophe1\ACFBlockz\AbstractACFBladeBlock;
use Prophe1\WPProjectsCore\Helpers;
use StoutLogic\AcfBuilder\FieldsBuilder;

class IconList extends AbstractACFBladeBlock
{
    /**
     * Hero constructor.
     * @throws \ReflectionException
     */
    public function __construct()
    {
        parent::__construct([
            'title' => __('Icon List', 'sage'),
            'description' => __('Create an Icon List block', 'sage'),
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
            ->addFields(Helpers::getFieldPartial('partials.mode'));

        $block
            ->addRepeater('items', [
                'layout' => 'block',
                'collapsed' => 'title',
                'min' => 1
            ])
                ->addImage('icon', [
                    'return_format' => 'id'
                ])
                ->addText('title')
            ->endRepeater();

        $block->setLocation('block', '==', sprintf('acf/%s', $this->name));

        return $block->build();
    }
}
