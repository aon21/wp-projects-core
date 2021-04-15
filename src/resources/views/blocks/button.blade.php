@php /** @var \Prophe1\WPProjectsCore\Blocks\Button $controller */ @endphp

@includeWhen($link, 'partials.button-link', ['button' => $link, 'rel' => $controller->getRel(), 'layout' => $controller->getButtonClass()])
