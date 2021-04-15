@php /** @var \Prophe1\WPProjectsCore\Blocks\Card $controller */ @endphp

<div class="{{ $design }} py-3 px-2 h-full flow-root">
  @include('blocks.partials.block-inners', $controller->getInnerBlocks())
</div>
