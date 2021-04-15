@php /** @var \Prophe1\WPProjectsCore\Blocks\InnerBlocks $controller */ @endphp

@includeWhen($controller->hasImage(), 'blocks.partials.background-image', ['imageId' => $controller->getImage()])
@includeWhen($controller->hasColor(), 'blocks.partials.background-color', ['colorClass' => $controller->getColor()])

<div class="container relative flow-root {{ $controller->getWrap() }}">
  @include('blocks.partials.block-inners', $controller->getInnerBlocks())
</div>
