<?php

namespace Prophe1\WPProjectsCore\Blocks;

use Prophe1\ACFBlockz\AbstractACFBladeBlock;
use Prophe1\WPProjectsCore\Editor\SimpleToolbar;
use StoutLogic\AcfBuilder\FieldsBuilder;

class IconWithContent extends AbstractACFBladeBlock
{
    /**
     * Hero constructor.
     * @throws \ReflectionException
     */
    public function __construct()
    {
        parent::__construct([
            'title' => __('Icon with Content', 'sage'),
            'description' => __('Create a Icon with Content block', 'sage'),
            'category' => 'layout',
            'icon' => 'businessman',
            'mode' => 'preview',
            'dir' => 'WPPRCORE::',
            'parent' => ['acf/image-with-inners', 'acf/card'],
            'supports' => [
                'align' => false,
                'mode' => false,
                'jsx' => true
            ],
        ]);
    }

    public function getClassName()
    {
        $positionClass = 'flex-col';
        $alignmentCLass = 'text-left';

        switch ($this->acf['icon_position']) {
            case 'left':
                $positionClass = 'flex-row';
                break;

            case 'top_center':
                $alignmentCLass = 'text-center';
                break;
        }

        return sprintf(
            '%s %s',
            $positionClass,
            $alignmentCLass
        );
    }

    public function getSize()
    {

        switch ($this->acf['image_size']) {
            case 'XS':
                $sizeClass = '16';
                break;

            case 'S':
                $sizeClass = '23';
                break;

            case 'M':
                $sizeClass = '36';
                break;

            case 'L':
                $sizeClass = '48';
                break;

            case 'XL':
                $sizeClass = '60';
                break;
        }

        return $sizeClass;
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
            ->addImage('icon', [
                'return_format' => 'id',
                'required' => true
            ])
            ->addSelect('icon_position', [
                'label' => 'Icon Position'
            ])
            ->addChoices([
                'left' => 'Left',
                'top_left' => 'Top Left',
                'top_center' => 'Top Center'
            ])
            ->addSelect('image_size', [
                'label' => 'Icon Size'
            ])
            ->addChoices([
                'XS' => 'XS',
                'S' => 'S',
                'M' => 'M',
                'L' => 'L',
                'XL' => 'XL'
            ]);
        $block
            ->addWysiwyg('content', [
                'label' => 'Content',
                'toolbar' => SimpleToolbar::TOOLBAR_SLUG
            ]);

        $block->setLocation('block', '==', sprintf('acf/%s', $this->name));

        return $block->build();
    }
}
