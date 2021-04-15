@foreach($resources as $resource)
  <{{ is_admin() ? 'div' : 'a' }} download href="{{ $resource['url'] }}" class="hover:text-green py-2 flex border-t last:border-b border-deep-blue-4 font-bold">
    <div class="flex-1 text-p-3">
      {!! $resource['title'] !!}
    </div>
    <div class="flex">
      @svg('icons/pdf.svg', 'mr-1')
      {{ __('Download') }}
    </div>
  </{{ is_admin() ? 'div' : 'a' }}>
@endforeach
