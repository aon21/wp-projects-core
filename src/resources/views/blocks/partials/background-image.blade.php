{!! \Prophe1\Wp\Image\Render::output($imageId, 'fr-hero-tablet', [
    'fr-hero-desktop' => \App\THEME_BREAKPOINT_DESKTOP,
    'fr-hero-laptop' => \App\THEME_BREAKPOINT_LAPTOP,
], ['class' => 'w-full z-0 h-full absolute top-0 left-0 object-cover']) !!}

@if (isset($hasGradient))
  <div class="bg-{{ $hasGradient }} absolute opacity-80 h-full w-full z-0"></div>
@endif
