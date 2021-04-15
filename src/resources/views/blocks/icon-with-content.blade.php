<div class="flex {{ $controller->getClassName() }} {{ $className }}">
  <div class="min-w-60 max-w-60 {{ $icon_position === 'left' ? 'mr-1' : 'mb-0-5' }} {{ $icon_position === 'top_center' ? 'mx-auto' : '' }}">
    @if ($icon)
      {!! wp_get_attachment_image($icon) !!}
    @endif
  </div>
  <div class="editor-text">
    {!! $content !!}
  </div>
</div>
