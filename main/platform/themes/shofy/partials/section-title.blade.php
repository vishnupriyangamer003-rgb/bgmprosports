@php
    $title ??= $shortcode->title;
    $subtitle ??= $shortcode->subtitle;
    $isCenter = ($shortcode->align ?? null) === 'center' || str_contains($class ?? '', 'text-center');
@endphp

@if($title || $subtitle)
    <div @class(['tp-section-title-wrapper', 'text-center' => $isCenter, $class ?? null])>
        @if($subtitle)
            <span class="tp-section-title-pre d-inline-block">
                {!! BaseHelper::clean($subtitle) !!}
            </span>
        @endif
        @if($title)
            <h3 class="section-title tp-section-title">
                @if($isCenter)
                    {!! BaseHelper::clean($title) !!}
                @else
                    @include(Theme::getThemeNamespace('partials.section-title-inner'))
                @endif
            </h3>
        @endif
    </div>
@endif
