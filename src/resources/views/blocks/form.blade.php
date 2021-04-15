@if ($form)

  {!! str_replace('space', ' ', do_shortcode(sprintf('[contact-form-7 id=%s]', $form))) !!}

@else

  <p>Select the Contact Form!</p>

@endif
