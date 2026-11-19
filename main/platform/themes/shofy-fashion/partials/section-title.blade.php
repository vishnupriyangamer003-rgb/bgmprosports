@php
    $title = $shortcode->title;
    $subtitle = $shortcode->subtitle;
    $isCenter = ($shortcode->align ?? null) === 'center' || str_contains($class ?? '', 'text-center');
@endphp

@if($title || $subtitle)
    <div @class(['tp-section-title-wrapper-2', $class ?? null, 'text-center' => $isCenter])>
        @if($subtitle)
            <span class="tp-section-title-pre-2">
                {!! BaseHelper::clean($subtitle) !!}
                @if(! $isCenter)
                    {!! Theme::partial('section-title-shape') !!}
                @endif
            </span>
        @endif
        @if($title)
            <h3 class="section-title tp-section-title-2">
                @if($isCenter)
                    {!! BaseHelper::clean($title) !!}
                @else
                    @include(Theme::getThemeNamespace('partials.section-title-inner'))
                @endif
            </h3>
        @endif
    </div>
@endif
