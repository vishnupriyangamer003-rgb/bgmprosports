<ul {!! $options !!}>
    @foreach ($menu_nodes->loadMissing('metadata') as $key => $row)
        @php
            $isSale = strtolower(trim((string) $row->title)) === 'sale' || \Illuminate\Support\Str::contains(strtolower((string) $row->url), 'sale');
        @endphp
        <li @class(['has-dropdown' => $row->has_child, 'menu-item-sale' => $isSale])>
            <a href="{{ url($row->url) }}"
               title="{{ $row->title }}"
               @if ($row->target !== '_self') target="{{ $row->target }}" rel="noopener noreferrer" @endif
               @class(['menu-link-sale' => $isSale])
            >
                {!! $row->icon_html !!}

                {!! BaseHelper::clean($row->title) !!}

                @if ($row->has_child)
                    <x-core::icon name="ti ti-chevron-down" />
                @endif
            </a>

            @if ($row->has_child)
                {!!
                    Menu::generateMenu([
                        'menu' => $menu,
                        'menu_nodes' => $row->child,
                        'view' => 'main-menu',
                         'options' => [
                             'class' => 'tp-submenu',
                         ],
                     ])
                 !!}
            @endif
        </li>
    @endforeach
</ul>
