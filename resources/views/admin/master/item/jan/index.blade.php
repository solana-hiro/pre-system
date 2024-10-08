@extends('layouts.admin.app')
@section('page_title', 'JANコード登録マスタ')
@section('title', 'JANコード登録マスタ')
@section('description', '')
@section('keywords', '')
@section('canonical', '')
@section('blade_script')
    <script src="{{ asset('js/master/item/jan/index.js') }}"></script>
@endsection
@section('content')
    <form role="search" action="{{ route('master.item.jan.update') }}" method="post" data-monitoring>
        @csrf
        <div class="main-area">
            <div class="button_area">
                <div class="div">
                    <button type="button" data-toggle="modal" data-target="#modal_cancel" data-value="" class="button"
                        data-url="" name="cancel2">
                        <div class="text_wrapper">キャンセル</div>
                    </button>
                    <button type="button" data-toggle="modal" data-target="#modal_confirm" data-value="" class="button-2"
                        data-url="" name="update2">
                        <div class="text_wrapper_3">登録する</div>
                    </button>
                </div>
            </div>
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @elseif (Session::has('sessionErrors'))
                <div class="alert alert-danger">
                    <ul>
                        @foreach (session('sessionErrors') as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @elseif (Session::has('flashmessage'))
                @include('components.modal.message', ['flashmessage' => session('flashmessage')])
            @endif
            <div class="alert alert-danger">
                <ul id="alert-danger-ul">
            </div>
            <div class="element-form">
                <div class="element-form-two-stage">
                    <div class="text_wrapper_two-stage">商品コード</div>
                    <div class="frame-two-stage">
                        <div class="textbox">
                            <input type="text" name="item_code" id="input_item_code"
                                onblur="eventBlurCodeautoSku(arguments[0], this)" class="element" minlength="0"
                                maxlength="9" size="9" data-monitoring-exclude
                                value="{{ old('item_code', isset($itemDetail) ? $itemDetail['mtStockKeepingUnit'][0]['item_cd'] : '') }}" />
                            <img class="vector" id="img_item_code" src="/img/icon/vector.svg"
                                data-smm-open="search_item_cd_modal" />
                        </div>
                        <div class="textbox textbox_middle" id="names_item_code">
                            <input type="text" name="item_name" id="item_name" class="element" minlength="0" maxlength="20" size="20" readonly
                            value="{{ old('item_name', isset($itemDetail) ? $itemDetail['mtStockKeepingUnit'][0]['item_name'] : '') }}"
                            >
                        </div>
                    </div>
                </div>
                <input type="hidden" id="hidden_item_id"
                    value="{{ isset($itemDetail) ? $itemDetail['mtStockKeepingUnit'][0]['mt_item_id'] : '' }}"
                    name="hidden_item_id" />
                <input type="hidden" id="hidden_item_code" value="" name="hidden_item_code" />
            </div>
            <div class="alert alert-danger">
                <ul id="alert-danger-table">
            </div>
            <div class="grid">
                <table class="">
                    @if (null != old('item_code'))
                        <thead class="grid_header_jan">
                            <tr>
                                <th colspan="2" class="grid_wrapper_left grid_wrapper_white col7 td_160px no_border">
                                </th>
                                <th colspan="20" class="grid_wrapper_center col10"><span class="td_center">サイズ</span></th>
                            </tr>
                            <tr>
                                <th colspan="2" class="grid_wrapper_center col7 td_min_140px">カラー</th>
                                @for ($i = 0; $i < count(old('size_cd')); $i++)
                                    <th class="grid_wrapper_center col_rec_blue td_100px">
                                        <input type="text" name="size_cd[]" class="grid_textbox " readonly
                                        value="{{ old("size_cd.{$i}")}}">
                                    </th>
                                    <th class="grid_wrapper_center col_rec_blue td_240px">
                                        <input type="text" name="size_name[]" id="size_name" class="grid_textbox " readonly
                                        value="{{ old("size_name.{$i}")}}">
                                    </th>
                                @endfor
                                @if (count(old('size_cd')) < 10)
                                    @for ($i = 0; $i < 10 - count(old('size_cd')); $i++)
                                        <td class="grid_wrapper_center col_rec_blue td_100px"></td>
                                        <td class="grid_wrapper_center col_rec_blue td_240px"></td>
                                    @endfor
                                @endif
                            </tr>
                        </thead>
                        <tbody class="grid_body">
                            @for ($i = 0; $i < count(old('color_cd')); $i++)
                                <tr>
                                    <th class="grid_col_1 col_rec_blue td_160px">
                                        <input type="text" name="color_cd[]" class="grid_textbox" readonly
                                        value="{{ old("color_cd.{$i}")}}">
                                    </th>
                                    <th class="grid_col_2 col_rec_blue td_160px">
                                        <input type="text" name="color_name[]" class="grid_textbox" readonly
                                        value="{{ old("color_name.{$i}")}}">
                                    </th>
                                    <!-- JANコード入力 -->
                                    @for ($j = 0; $j < count(old('size_cd')); $j++)
                                        @php
                                            $index = "";
                                            if($i == 0){
                                                $index = $j;
                                            }else{
                                                $index = $i * count(old('size_cd')) + $j;
                                            }
                                        @endphp
                                            <td colspan="2" class="grid_col_2 col_rec td_200px"><input
                                                    onblur="eventBlurJanCode(arguments[0], this)"
                                                    type="number" placeholder="" name="jan_code[]"
                                                    class="grid_textbox td_130px" minlength="0" maxlength="13"
                                                    size="13" value="{{ old("jan_code.{$index}") }}"></td>
                                            <input type="hidden" name="hidden_item_id[]" value="{{ old("hidden_item_id.{$index}") }}">
                                    @endfor
                                    @if (count(old('size_cd')) < 10)
                                    @for ($k = 0; $k < 10 - count(old('size_cd')); $k++)
                                        <td colspan="2" class="grid_col_2 col_rec_blue td_200px"></td>
                                    @endfor
                                @endif
                                </tr>
                            @endfor
                            <!-- JANコード入力（データなし部分） -->
                            @if (count(old('color_cd')) < 20)
                                @for ($i = 0; $i < 20 - count(old('color_cd')); $i++)
                                    <tr>
                                        <th class="grid_col_1 col_rec_blue td_80px"></th>
                                        <th class="grid_col_2 col_rec_blue td_160px"></th>
                                        @for ($j = 0; $j < 10; $j++)
                                            <td colspan="2" class="grid_col_2 col_rec td_200px"></td>
                                        @endfor
                                    </tr>
                                @endfor
                            @endif
                        </tbody>
                    @elseif (isset($itemDetail))
                        <thead class="grid_header_jan">
                            <tr>
                                <th colspan="2" class="grid_wrapper_left grid_wrapper_white col7 td_160px no_border">
                                </th>
                                <th colspan="20" class="grid_wrapper_center col10"><span class="td_center">サイズ</span></th>
                            </tr>
                            <tr>
                                <td colspan="2" class="grid_wrapper_center col7 td_min_140px">カラー</td>
                                @foreach ($itemDetail['mtSize'] as $size)
                                <td class="grid_wrapper_center col_rec_blue td_100px">
                                    <input type="text" name="size_cd[]" class="grid_textbox " readonly
                                    value="{{ $size['size_cd'] }}" >
                                </td>
                                <td class="grid_wrapper_center col_rec_blue td_240px">
                                    <input type="text" name="size_name[]" class="grid_textbox " readonly
                                    value="{{ $size['size_name'] }}" >
                                </td>
                                @endforeach
                                @if (count($itemDetail['mtSize']) < 10)
                                    @for ($i = 0; $i < 10 - count($itemDetail['mtSize']); $i++)
                                        <td class="grid_wrapper_center col_rec_blue td_100px"></td>
                                        <td class="grid_wrapper_center col_rec_blue td_240px"></td>
                                    @endfor
                                @endif
                            </tr>
                        </thead>
                        <tbody class="grid_body">
                            @foreach ($itemDetail['mtColor'] as $color)
                                <tr>
                                    <th class="grid_col_1 col_rec_blue td_160px">
                                        <input type="text" name="color_cd[]" class="grid_textbox " readonly
                                        value="{{ $color['color_cd'] }}" >
                                    </th>
                                    <th class="grid_col_2 col_rec_blue td_160px">
                                        <input type="text" name="color_name[]" class="grid_textbox " readonly
                                        value="{{ $color['color_name'] }}" >
                                    </th>
                                    <!-- JANコード入力 -->
                                    @foreach ($itemDetail['mtSize'] as $size)
                                        @php
                                            $item = $itemDetail['mtStockKeepingUnit']
                                                ->where('mt_color_id', $color['id'])
                                                ->where('mt_size_id', $size['id'])
                                                ->first();
                                        @endphp
                                        @if ($item)
                                            @if($item['hidden_flg'] == 0)
                                                <td colspan="2" class="grid_col_2 col_rec td_200px"><input
                                                        onblur="eventBlurJanCode(arguments[0], this)"
                                                        type="number" placeholder="" name="jan_code[]"
                                                        class="grid_textbox td_130px" minlength="0" maxlength="13"
                                                        size="13" value="{{ $item['jan_cd'] }}">
                                                </td>
                                            @else
                                                <td colspan="2" class="grid_col_2 col_rec td_200px bg-slate-300"><input
                                                    onblur="eventBlurJanCode(arguments[0], this)"
                                                    type="number" placeholder="" name="jan_code[]"
                                                    class="grid_textbox td_130px" minlength="0" maxlength="13"
                                                    size="13" value="{{ $item['jan_cd'] }}" readonly>
                                                </td>
                                            @endif
                                            <input type="hidden" name="hidden_item_id[]" value="{{ $item['id'] }}">
                                            <input type="hidden" name="hidden_flg[]" value="{{ $item['hidden_flg'] }}">
                                        @else
                                            <td colspan="2" class="grid_col_2 col_rec td_200px"></td>
                                        @endif
                                    @endforeach
                                    <!-- JANコード入力（データなし部分） -->
                                    @if (count($itemDetail['mtSize']) < 10)
                                        @for ($i = 0; $i < 10 - count($itemDetail['mtSize']); $i++)
                                            <td colspan="2" class="grid_col_2 col_rec td_200px"></td>
                                        @endfor
                                    @endif
                                </tr>
                            @endforeach
                            <!-- データなし行 -->
                            @if (count($itemDetail['mtColor']) < 20)
                                @for ($i = 0; $i < 20 - count($itemDetail['mtColor']); $i++)
                                    <tr>
                                        <th class="grid_col_1 col_rec_blue td_80px"></th>
                                        <th class="grid_col_2 col_rec_blue td_160px"></th>
                                        <!-- JANコード入力（データなし部分） -->
                                        @for ($j = 0; $j < 10; $j++)
                                            <td colspan="2" class="grid_col_2 col_rec td_200px"></td>
                                        @endfor
                                    </tr>
                                @endfor
                            @endif
                        </tbody>
                    @else
                        <thead class="grid_header_jan">
                            <tr>
                                <td colspan="2" class="grid_wrapper_left grid_wrapper_white col7 td_260px no_border">
                                </td>
                                <td colspan="20" class="grid_wrapper_center col10"><span class="td_center">サイズ</span></td>
                            </tr>
                            <!-- データなし行 -->
                            <tr>
                                <td colspan="2" class="grid_wrapper_center col7 td_260px">カラー</td>
                                @for ($i = 0; $i < 10; $i++)
                                    <td class="grid_wrapper_center col8 col_rec_blue td_100px"></td>
                                    <td class="grid_wrapper_center col9 col_rec_blue td_200px"></td>
                                @endfor
                            </tr>
                        </thead>
                        <!-- JANコード入力（データなし部分） -->
                        <tbody class="grid_body">
                            @for ($i = 0; $i < 10; $i++)
                                <tr>
                                    @for ($j = 0; $j < 11; $j++)
                                        <td colspan="2" class="grid_col_1 col_rec td_100px"></td>
                                    @endfor
                                </tr>
                            @endfor
                        </tbody>
                    @endif
                </table>
            </div>
        </div>
        <button type="submit" id="cancel" name="cancel" class="display_none_all"></button>
        <button type="submit" id="update" name="update" class="display_none_all"></button>
        <button type="submit" id="redirect" name="redirect" class="display_none_all" value=""></button>

        @include('components.menu.selected', ['view' => 'main'])
    </form>
    @include('admin.master.search.brand1')
    @include('admin.master.search.game_category')
    @include('admin.master.search.genre')
    @include('admin.master.search.item_class_thing4')
    @include('admin.master.search.item_class_thing5')
    @include('admin.master.search.item_class_thing6')
    @include('admin.master.search.item_class_thing7')
    @include('admin.master.search.item_cd')
@endsection
