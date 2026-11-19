@if ((bool) setting('sale_popup_enabled', 0))
    <div
        class="js-sale-popup-container hidden"
        data-include="{{ route('public.ajax.sale-popup') }}"
        data-show-on-mobile="{{ $show_on_mobile ? 'true' : 'false' }}"
    ></div>
@endif
