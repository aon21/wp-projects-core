<?php

namespace Prophe1\WPProjectsCore\Blocks;

use Prophe1\ACFBlockz\AbstractACFBladeBlock;
use StoutLogic\AcfBuilder\FieldsBuilder;

class Resources extends AbstractACFBladeBlock
{
    /**
     * Hero constructor.
     * @throws \ReflectionException
     */
    public function __construct()
    {
        parent::__construct([
            'title' => __('Resources', 'sage'),
            'description' => __('Create a Resources block', 'sage'),
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
            ->addRepeater('resources', [
                'layout' => 'block',
                'collapsed' => 'title',
                'min' => 1
            ])
                ->addText('title')
                ->addFile('url', [
                    'return_format' => 'url'
                ])
            ->endRepeater();

        $block->setLocation('block', '==', sprintf('acf/%s', $this->name));

        return $block->build();
    }
}
