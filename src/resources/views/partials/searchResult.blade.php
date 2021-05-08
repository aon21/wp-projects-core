@php $sep = '<span class="mx-1">></span>'; @endphp

@if ($posts)
    @foreach ($posts as $post)
        <div class="result py-4 border-b last:border-0 border-dblu-lbor">
            <a href="{{ get_the_permalink($post) }}">
                <div class="flex justify-between">
                    <div class="flex text-deep-blue-3 text-s">
                        @foreach (get_the_terms($post, 'knowledge-topics') as $cat)
                            <span>{!! $loop->count > 1 ? (!$loop->last ? $cat->name . $sep : $cat->name) : $cat->name !!}</span>
                        @endforeach
                    </div>
                    @include('contents.partials.counter', $counter = ['seen' => '0', 'articles' => '0'])
                </div>
                <h5 class="item__name my-1">{{ get_the_title($post) }}</h5>
                <p class="item__excerpt">{!! preg_replace('/(' . $param .')/i', '<b class="text-green">'.$param.'</b>', get_the_excerpt($post)) !!}</p>
            </a>
        </div>
    @endforeach
@else
    <div class="not-found py-3 border-b last:border-0 border-deep-blue-3 text-center">{{ __(sprintf('Your search for "%s" did not return any results. Please try again.', $param ), 'sage') }}</div>
@endif
