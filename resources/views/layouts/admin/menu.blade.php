@php
    //Userごと
    $def1Security = App\Models\MtUser1Security::where('mt_user_id', Auth::guard('user')->user()->id)
        ->where('auth_use_flg', 1)
        ->pluck('def_1_menu_id')
        ->toArray();
    $def2Security = App\Models\MtUser2Security::where('mt_user_id', Auth::guard('user')->user()->id)
        ->where('auth_use_flg', 1)
        ->pluck('def_2_menu_id')
        ->toArray();
    $def3Security = App\Models\MtUser3Security::where('mt_user_id', Auth::guard('user')->user()->id)
        ->where('auth_use_flg', 1)
        ->pluck('def_3_menu_id')
        ->toArray();
@endphp

<form class="bg-side-menu" role="search" action="{{ route('side.redirect') }}" method="get">
    <div class="menu">
        <div class="overlap" id="overlap">
            <div class="rectangle" id="rectangle">
                <div class="group" id="menu-group">
                    <div class="overlap-group is-active" id="overlap-group"><img class="component" id="menu-img"
                            src="{{ asset('/img/icon/arrow-left.svg') }}" /></div>
                </div>
                <div class="frame" id="menu-frame">
                    <nav class="subArea__nav u-spHides">
                        <ul class="accordion-menu">
                            @foreach ($commonParams['menus']['def1'] as $def1)
                                @if (in_array($def1['id'], $def1Security))
                                    <li class="toggle_title" data-content="#box{{ $def1['id'] }}">
                                        <button type="button"
                                            class="sidemenu1 bg-arrow-right w-full ps-4 text-left text-base font-normal {{ in_array($def1['id'], session('selected_def1') ?? []) ? 'selected' : '' }}"
                                            data-sidemenu="1">{{ $def1['menu_1_name'] }}</button>
                                    </li>
                                    @php
                                        $def2Data = $commonParams['menus']['def2']
                                            ->where('def_1_menu_id', $def1['id'])
                                            ->sortBy('sort_order');
                                    @endphp
                                    <div id="box{{ $def1['id'] }}"
                                        class="{{ in_array($def1['id'], session('selected_def1') ?? []) ? '' : 'hidden' }}">
                                        @foreach ($def2Data as $def2)
                                            @if (in_array($def2['id'], $def2Security))
                                                <ul class="accordion-menu-child1">
                                                    <li class="toggle_title_sub"
                                                        data-content="#box{{ $def1['id'] }}_{{ $def2['id'] }}">
                                                        <button type="button"
                                                            class="sidemenu2 bg-arrow-right w-full ps-4 text-left text-base font-normal rounded-xl {{ in_array($def2['id'], session('selected_def2') ?? []) ? 'selected' : '' }}"
                                                            data-sidemenu="2">{{ $def2['menu_2_name'] }}</button>
                                                    </li>
                                                </ul>

                                                @php
                                                    $def3Data = $commonParams['menus']['def3']
                                                        ->where('def_2_menu_id', $def2['id'])
                                                        ->where('def_1_menu_id', $def1['id'])
                                                        ->sortBy('sort_order');
                                                @endphp

                                                <ul class="accordion-menu-child2 {{ in_array($def2['id'], session('selected_def2') ?? []) ? '' : 'hidden' }}"
                                                    id="box{{ $def1['id'] }}_{{ $def2['id'] }}">
                                                    @foreach ($def3Data as $def3)
                                                        {{-- 一時的な対応：PS区分別得意先掛率マスタ一覧入力,売価情報マスタ,売価情報マスタリストの非表示 --}}
                                                        @if ($def3['id'] == 96 || $def3['id'] == 97 || $def3['id'] == 98)
                                                            @continue
                                                        @endif
                                                        @if (in_array($def3['id'], $def3Security))
                                                            <li class="toggle_title_sub2">
                                                                <button type="submit" name="route_name"
                                                                    data-sidemenu="3"
                                                                    class="w-full ps-4 text-left text-base font-normal text-gray-400 hover:bg-blue-50 hover:text-gray-800"
                                                                    value="{{ MenuConsts::DEF3[$def3['id']] }}"
                                                                    data-route="{{ MenuConsts::DEF3[$def3['id']] ? route(MenuConsts::DEF3[$def3['id']]) : '' }}">{{ $def3['menu_3_name'] }}</button>
                                                            </li>
                                                        @endif
                                                    @endforeach
                                                </ul>
                                            @endif
                                        @endforeach
                                    </div>
                                @endif
                            @endforeach
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <div class="hidden fixed w-52 bg-white border border-solid border-gray-300 shadow-sm" style="z-index:9999"
        id="sidemenu-context">
        <ul class="list-none py-2">
            <li class="list-none py-1 px-2 text-sm cursor-pointer">
                <button id="open-new-tab" type="button" name="route_name" value="">
                    新しいタブで開く
                </button>
            </li>
        </ul>
    </div>
    @include('components.menu.selected', ['view' => 'sidemenu'])
</form>
