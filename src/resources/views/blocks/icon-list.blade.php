<ul class="listmt-3 space-y-2 list-none pl-0 ml-0 mb-0">
  @foreach($items as $item)
    <li class="flex">
      @if ($item['icon'])
        {!! wp_get_attachment_image($item['icon'], 'full', false, ['class' => 'inline max-w-23 mr-1']) !!}
      @else
        @svg('icons/check-circle.svg', 'fill-current text-green inline max-w-23 mr-1')
      @endif
      <span class="{{ $mode === 'dark' ? 'text-white' : '' }}">{{ $item['title'] }}</span>
    </li>
  @endforeach
</ul>
