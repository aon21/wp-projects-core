@php /** @var \Prophe1\WPProjectsCore\Blocks\ImageWithInners $controller */ @endphp

@php
  $image_alignment = isset($image_alignment) ? $image_alignment : null;
  $image_fixed = isset($image_fixed) ? $image_fixed : null;
@endphp

@component('blocks.partials.block-wrap')
  <div class="container {{ $image_fixed ? 'has-draggable' : '' }}" {{ $image_fixed ? 'data-smTrigger=.desc' : '' }}>
    <div class="laptop:flex {{ $image_fixed ? '' : ($image_alignment === 'center' ? 'items-center' : '') }} {{ $image_position === 'right' ? 'flex-row-reverse' : '' }}">
      <div class="flex-1 is-sm-container">
        <div class="to-drag">
          {!! \Prophe1\Wp\Image\Render::output($image, 'fr-hero-tablet', [
          ], ['class' => 'mx-auto mb-4 laptop:mb-0 ' . ($shadows ? 'shadow-4xl' : '')]) !!}
        </div>
      </div>

      <div class="desc flex-1 {{ $image_position === 'right' ? 'laptop:mr-7' : 'laptop:ml-7' }}">
        @include('WPPRCORE::blocks.partials.block-inners', $controller->getInnerBlocks())
      </div>
    </div>
  </div>
@endcomponent
