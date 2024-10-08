@extends('layouts.admin.app')
@section('page_title', '（ユーザマスタ）メンテナンス')
@section('title', '（ユーザマスタ）メンテナンス')
@section('description', '')
@section('keywords', '')
@section('canonical', '')

@section('content')
    <div class="main-area">
        <form role="search" action="{{ route('system.security.user.maintenance.update') }}" method="post" data-monitoring>
            @csrf
            <div class="button_area">
                <div class="div">
                    <button type="button" data-toggle="modal" data-target="#modal_cancel" data-value="" class="button"
                        data-url="" name="cancel2">
                        <div class="text_wrapper">キャンセル</div>
                    </button>
                    @if ($commonParams['auth']['auth_del_flg'] !== 1)
                        <button class="button" type="button" data-toggle="modal" data-target="#modal_delete" data-value=""
                            class="display_none" name="delete" disabled>
                            <div class="text_wrapper">削除する</div>
                        </button>
                    @elseif(isset($initData['mtUser']['id']))
                        <button class="button" type="button" data-toggle="modal" data-target="#modal_delete" data-value=""
                            class="display_none" name="delete">
                            <div class="text_wrapper">削除する</div>
                        </button>
                    @else
                        <button class="button" type="button" data-toggle="modal" data-target="#modal_delete" data-value=""
                            class="display_none" name="delete" disabled>
                            <div class="text_wrapper">削除する</div>
                        </button>
                    @endif
                    @if (isset($initData['mtUser']['id']) && $minId !== $initData['mtUser']['id'])
                        <button class="button" type="submit" name="prev">
                            <div class="text_wrapper_2">前頁</div>
                        </button>
                    @else
                        <button class="button" type="submit" name="prev" disabled>
                            <div class="text_wrapper_2">前頁</div>
                        </button>
                    @endif
                    @if ((isset($initData['mtUser']['id']) && $maxId !== $initData['mtUser']['id']) || (!isset($initData) && $maxId > 0))
                        <button class="button" type="submit" name="next">
                            <div class="text_wrapper_2">次頁</div>
                        </button>
                    @else
                        <button class="button" type="submit" name="next" disabled>
                            <div class="text_wrapper_2">次頁</div>
                        </button>
                    @endif
                    @if (isset($initData['mtUser']['id']) && $commonParams['auth']['auth_register_flg'] === 1)
                        <button class="button" type="submit" name="copy">
                            <div class="text_wrapper_2">コピーする</div>
                        </button>
                    @else
                        <button class="button" type="submit" name="copy" disabled>
                            <div class="text_wrapper_2">コピーする</div>
                        </button>
                    @endif
                    @if (isset($initData['mtUser']['id']) && $commonParams['auth']['auth_change_flg'] === 1)
                        <button type="button" data-toggle="modal" data-target="#modal_confirm" data-value=""
                            class="button-2" data-url="" name="update2">
                            <div class="text_wrapper_3">登録する</div>
                        </button>
                    @elseif(!isset($initData['mtUser']['id']) && $commonParams['auth']['auth_register_flg'] === 1)
                        <button type="button" data-toggle="modal" data-target="#modal_confirm" data-value=""
                            class="button-2" data-url="" name="update2">
                            <div class="text_wrapper_3">登録する</div>
                        </button>
                    @else
                        <button type="button" data-toggle="modal" data-target="#modal_confirm" data-value=""
                            class="button-2" data-url="" name="update2" disabled>
                            <div class="text_wrapper_3">登録する</div>
                        </button>
                    @endif
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
            @elseif (Session::has('errormessage'))
                @include('components.modal.error', ['errormessage' => session('errormessage')])
            @endif
            <div class="alert alert-danger">
                <ul id="alert-danger-ul">
            </div>

            <div class="box">
                <div class="element-form element-form-rows" style="align-items: flex-start;">
                    <div class="group">
                        <div class="element-form-rows">
                            <div class="element-form element-form-rows">
                                <div class="text_wrapper td_110px txt_required grid_wrapper_right">ユーザコード</div>
                                <div class="frame">
                                    <div class="textbox">
                                        <input type="number" name="user_cd" class="element input_number_4" data-limit-len="4" data-limit-minus id="user_cd"
                                            onblur="eventBlurCodeautoUser(arguments[0], this)"
                                            value="{{ old('user_cd', isset($initData['mtUser']) ? $initData['mtUser']['user_cd'] : '') }}" />
                                    </div>
                                </div>
                            </div>
                        </div><br>
                        <div class="element-form-rows">
                            <div class="element-form element-form-rows">
                                <div class="element-form element-form-rows">
                                    <div class="text_wrapper td_110px txt_required grid_wrapper_right">パスワード</div>
                                    <div class="frame">
                                        <div class="textbox">
                                            @if (isset($initData['mtUser']['password']))
                                                <input type="password" name="password" id="password1" class="element"
                                                    minlength="0" maxlength="16" size="16"
                                                    value="{{ 'passwordtype' }}" disabled />
                                                <i id="eye1" class="fa-solid fa-eye-slash"
                                                    @if (isset($initData['mtUser'])) style="display:none" @endif></i>
                                            @else
                                                <input type="password" name="password" id="password1" class="element"
                                                    minlength="0" maxlength="16" size="16" value="" />
                                                <i id="eye1" class="fa-solid fa-eye-slash"></i>
                                            @endif
                                        </div>
                                    </div>
                                    @if (isset($initData['mtUser']['password']))
                                        <button class="button gray_button" type="button" data-toggle="modal"
                                            data-target="#modal_password_reset" data-value="" class="display_none"
                                            name="password_reset"><img
                                                src="{{ asset('/img/icon/reset.svg') }}">パスワードをリセットする</button>
                                    @else
                                        <button class="button gray_button" type="button" data-toggle="modal"
                                            data-target="#modal_password_reset" data-value="" class="display_none"
                                            name="password_reset" style="display:none"><img
                                                src="{{ asset('/img/icon/reset.svg') }}">パスワードをリセットする</button>
                                    @endif
                                </div>
                            </div>
                        </div><br>
                        <div class="element-form-rows">
                            <div class="element-form element-form-rows">
                                <div class="text_wrapper td_110px txt_required grid_wrapper_right">パスワード(確認)</div>
                                <div class="frame">
                                    <div class="textbox">
                                        @if (isset($initData['mtUser']['password']))
                                            <input type="password" name="password_confirmation" id="password2"
                                                class="element" minlength="0" maxlength="16" size="16"
                                                value="{{ 'passwordtype' }}" disabled />
                                            <i id="eye2" class="fa-solid fa-eye-slash"
                                                @if (isset($initData['mtUser'])) style="display:none" @endif></i>
                                        @else
                                            <input type="password" name="password_confirmation" id="password2"
                                                class="element" minlength="0" maxlength="16" size="16"
                                                value="" />
                                            <i id="eye2" class="fa-solid fa-eye-slash"></i>
                                        @endif

                                    </div>
                                </div>
                            </div>
                            <input type="hidden" name="password_mode" id="password_mode"
                                value="{{ isset($initData['mtUser']['password']) ? 0 : 1 }}" />
                        </div><br>
                        <div class="element-form-rows">
                            <div class="element-form element-form-rows">
                                <div class="text_wrapper td_110px txt_required grid_wrapper_right">ユーザ名</div>
                                <div class="frame">
                                    <div class="textbox">
                                        <input type="text" name="user_name" class="element" minlength="0"
                                            maxlength="20" size="20"
                                            value="{{ old('user_name', isset($initData['mtUser']) ? $initData['mtUser']['user_name'] : '') }}" />
                                    </div>
                                </div>
                            </div>
                        </div><br>
                        <div class="element-form-rows">
                            <div class="element-form element-form-rows">
                                <div class="text_wrapper td_110px txt_required grid_wrapper_right">ユーザ名カナ</div>
                                <div class="frame">
                                    <div class="textbox">
                                        <input type="text" name="user_name_kana" class="element" minlength="0"
                                            maxlength="10" size="10"
                                            value="{{ old('user_name_kana', isset($initData['mtUser']) ? $initData['mtUser']['user_name_kana'] : '') }}" />
                                    </div>
                                </div>
                            </div>
                        </div><br>
                        <div class="element-form-rows">
                            <div class="element-form element-form-rows">
                                <div class="text_wrapper td_110px txt_required grid_wrapper_right">メールアドレス</div>
                                <div class="frame">
                                    <div class="textbox">
                                        <input type="text" name="mail" class="element" minlength="0"
                                            maxlength="256" size="30"
                                            value="{{ old('mail', isset($initData['mtUser']) ? $initData['mtUser']['mail'] : '') }}" />
                                    </div>
                                </div>
                            </div>
                        </div><br>
                        <div class="alert alert-danger">
                            <ul id="alert-danger-ul">
                        </div>
                        <div class="element-form element-form-rows">
                            <div class="text_wrapper td_110px txt_required grid_wrapper_right">部門</div>
                            <div class="frame">
                                <div class="textbox">
                                    <input type="number" name="department_cd" class="element input_number_4" id="input_department" 
                                    onblur="blurCodeAutoDepartments(arguments[0], this)" data-limit-len="4" data-limit-minus
                                        value="{{ old('department_cd', isset($initData['mtUser']) ? $initData['mtUser']['department_cd'] : '') }}" />
                                    <img class="vector" id="img_department" src="/img/icon/vector.svg"
                                        data-smm-open="search_department_modal" />
                                    <input type="hidden" id="hidden_department" value=""
                                        name="hidden_department" />
                                </d>
                                <div class="textbox td_200px txt_blue" id="names_department">
                                    {{ isset($initData['mtUser']) ? $initData['mtUser']['department_name'] : '' }}
                                </div>
                            </div>
                        </div>
                    </div><br>
                    <label for="switch" class="switch_label">
                        <div class="switch">
                            <input type="checkbox" id="switch" name="validity_flg" value="1"
                                @if (old('validity_flg') === '1' ||
                                        (null === old('validity_flg') && isset($initData['mtUser']) && $initData['mtUser']['validity_flg'] === 1)) checked @endif />
                            <div class="circle"></div>
                            <div class="base"></div>
                        </div>
                        <span class="title">このユーザを有効にする</span>
                    </label>
                </div>
            </div>

            <div class="element-form element-form-columns">
                <div class="blue_box_left" style="width: 200px;">
                    <span>特殊権限設定</span>
                </div>
                <div class="element-form element-form-rows">
                    <div class="element">
                        <div class="frame">
                            <div class="element-form" style="gap: 80px;">
                                <div class="element-form element-form-rows">
                                    <div class="div">
                                        <label class="text_wrapper_2">
                                            <input type="checkbox" id="sp_auth_price_correction_possible"
                                                name="sp_auth_price_correction_possible" value="1"
                                                @if (old('sp_auth_price_correction_possible') === '1' ||
                                                        (null === old('sp_auth_price_correction_possible') &&
                                                            isset($initData['mtUser']) &&
                                                            $initData['mtUser']['sp_auth_price_correction_possible'] === 1)) checked @endif />
                                            単価訂正可能
                                        </label>
                                        <div class="frame">
                                            <span class="tooltip"
                                                data-tooltip="受注計上入力・・・「受注単価」「原価単価」「受注金額」「原価金額」の変更を可能とする&#13;&#10;売上計上入力・・・「受注単価」「原価単価」「売上」の変更を可能とする"><img
                                                    src="{{ asset('/img/icon/info.svg') }}"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="element-form element-form-rows">
                                    <div class="div">
                                        <label class="text_wrapper_2">
                                            <input type="checkbox" id="sp_auth_star_none_possible"
                                                name="sp_auth_star_none_possible" value="1"
                                                @if (old('sp_auth_star_none_possible') === '1' ||
                                                        (null === old('sp_auth_star_none_possible') &&
                                                            isset($initData['mtUser']) &&
                                                            $initData['mtUser']['sp_auth_star_none_possible'] === 1)) checked @endif />
                                            ★無し可能
                                        </label>
                                        <div class="frame">
                                            <span class="tooltip"
                                                data-tooltip="受注リストのチェックに「★」がないWEB受注の&#13;&#10;「変更」を可能とする"><img
                                                    src="{{ asset('/img/icon/info.svg') }}"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="element-form element-form-rows">
                                    <div class="div">
                                        <label class="text_wrapper_2">
                                            <input type="checkbox" id="sp_auth_hand_inspection_possible"
                                                name="sp_auth_hand_inspection_possible" value="1"
                                                @if (old('sp_auth_hand_inspection_possible') === '1' ||
                                                        (null === old('sp_auth_hand_inspection_possible') &&
                                                            isset($initData['mtUser']) &&
                                                            $initData['mtUser']['sp_auth_hand_inspection_possible'] === 1)) checked @endif />
                                            手検品可能
                                        </label>
                                        <div class="frame">
                                            <span class="tooltip"
                                                data-tooltip="出荷検品処理で「大口検品」（箱単位出荷伝票）の&#13;&#10;検品処理を可能とする"><img
                                                    src="{{ asset('/img/icon/info.svg') }}"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <input type="hidden" name="update_id" value="{{ isset($userId) ? $userId : '' }}" />
                <input type="hidden" name="init_switch" id="init_switch"
                    value="{{ isset($initData['mtUser']['validity_flg']) ? $initData['mtUser']['validity_flg'] : '' }}" />
                <input type="hidden" name="updated_switch" id="updated_switch" value="" />
            </div><br>
            <div class="element-form">
                <div class="blue_box_left" style="width: 200px;">
                    <span>セキュリティ設定</span>
                </div>
            </div><br><br>
            <div class="element-form">
                @php
                    $j = 0;
                    $k = 0;
                @endphp
                @foreach ($def1Data as $def1)
                    <input id="def1_{{ $def1['id'] }}" type="radio" name="tab_item"
                        @if ($j === 0) checked @endif />
                    <label class="tab_item" for="def1_{{ $def1['id'] }}">{{ $def1['menu_1_name'] }}</label>
                    <div class="tab_content" id="def1_{{ $def1['id'] }}_content">
                        <div class="box">
                            <div class="element-form element-form-rows">
                                <div class="group">
                                    <input type="hidden" name="def1_auth_use_flg[{{ $def1['id'] }}]"
                                        value="0" />
                                    @if (isset($initData['mtUser1Securities']))
                                        @php $record = $initData['mtUser1Securities']->where('def_1_menu_id', $def1['id'] )->first(); @endphp
                                        <input type="checkbox" name="def1_auth_use_flg[{{ $def1['id'] }}]"
                                            value="1" @if (
                                                (null !== old('def1_auth_use_flg') && old('def1_auth_use_flg')[$def1['id']] === '1') ||
                                                    (null === old('def1_auth_use_flg') && isset($record) && $record['auth_use_flg'] === 1)) checked @endif />使用
                                    @else
                                        <input type="checkbox" name="def1_auth_use_flg[{{ $def1['id'] }}]"
                                            value="1" @if (null !== old('def1_auth_use_flg') && old('def1_auth_use_flg')[$def1['id']] === '1') checked @endif />使用
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="element-form">
                            @foreach ($def2Data as $def2)
                                @if ($def2['def_1_menu_id'] === $def1['id'])
                                    <input id="def2_{{ $def2['id'] }}" type="radio" name="sub_tab_item"
                                        @if ($k === 0) checked @endif />
                                    <label class="sub_tab_item"
                                        for="def2_{{ $def2['id'] }}">{{ $def2['menu_2_name'] }}</label>
                                    <div class="sub_tab_content" id="def2_{{ $def2['id'] }}_content">
                                        <div class="box">
                                            <div class="element-form element-form-rows">
                                                <div class="group">
                                                    <input type="hidden" name="def2_auth_use_flg[{{ $def2['id'] }}]"
                                                        value="0" />
                                                    @if (isset($initData['mtUser2Securities']))
                                                        @php $record = $initData['mtUser2Securities']->where('def_2_menu_id', $def2['id'] )->first(); @endphp
                                                        <input type="checkbox"
                                                            name="def2_auth_use_flg[{{ $def2['id'] }}]" value="1"
                                                            @if (
                                                                (null !== old('def2_auth_use_flg') && old('def2_auth_use_flg')[$def2['id']] === '1') ||
                                                                    (null === old('def2_auth_use_flg') && isset($record) && $record['auth_use_flg'] === 1)) checked @endif />使用
                                                    @else
                                                        <input type="checkbox"
                                                            name="def2_auth_use_flg[{{ $def2['id'] }}]" value="1"
                                                            @if (null !== old('def2_auth_use_flg') && old('def2_auth_use_flg')[$def2['id']] === '1') checked @endif />使用
                                                    @endif

                                                </div>
                                                <div class="element-form element-form-rows">
                                                    <a href="javascript:void(0);" onClick="clickCheckAllOff(this);"
                                                        class="def2_{{ $def2['id'] }}">&nbsp;&nbsp;&nbsp;すべてのチェックを外す</a>｜<a
                                                        href="javascript:void(0);" onClick="clickCheckAllOn(this);"
                                                        class="def2_{{ $def2['id'] }}">すべてにチェックする</a>
                                                </div>
                                            </div><br>
                                            <div class="grid">
                                                <table class="table_sticky" id="grid_table_1">
                                                    <thead class="grid_header">
                                                        <tr>
                                                            <td rowspan="2" class="grid_wrapper_center td_200px">メニュー名
                                                            </td>
                                                            <td colspan="5" class="grid_wrapper_center td_500px">権限
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="grid_wrapper_center td_100px">使用</td>
                                                            <td class="grid_wrapper_center td_100px">登録</td>
                                                            <td class="grid_wrapper_center td_100px">削除</td>
                                                            <td class="grid_wrapper_center td_100px">印刷</td>
                                                            <td class="grid_wrapper_center td_100px">変更</td>
                                                        </tr>
                                                    </thead>
                                                    <tbody class="tbody_scroll">
                                                        @foreach ($def3Data as $def3)
                                                            @if ($def3['def_2_menu_id'] === $def2['id'])
                                                                @if (isset($initData['mtUser3Securities']))
                                                                    @php $record = $initData['mtUser3Securities']->where('def_3_menu_id', $def3['id'] )->first(); @endphp
                                                                @endif
                                                                <tr>
                                                                    <input type="hidden"
                                                                        name="def3_auth_use_flg[{{ $def3['id'] }}]"
                                                                        value="0" />
                                                                    <input type="hidden"
                                                                        name="def3_auth_register_flg[{{ $def3['id'] }}]"
                                                                        value="0" />
                                                                    <input type="hidden"
                                                                        name="def3_auth_del_flg[{{ $def3['id'] }}]"
                                                                        value="0" />
                                                                    <input type="hidden"
                                                                        name="def3_auth_print_flg[{{ $def3['id'] }}]"
                                                                        value="0" />
                                                                    <input type="hidden"
                                                                        name="def3_auth_change_flg[{{ $def3['id'] }}]"
                                                                        value="0" />
                                                                    <td class="grid_wrapper_left">
                                                                        {{ $def3['menu_3_name'] }}</td>
                                                                    <td class="grid_wrapper_center  td_100px"><input
                                                                            type="checkbox"
                                                                            name="def3_auth_use_flg[{{ $def3['id'] }}]"
                                                                            value="1"
                                                                            class="gray def2_{{ $def2['id'] }}"
                                                                            @if (
                                                                                (null !== old('def3_auth_use_flg') && old('def3_auth_use_flg')[$def3['id']] === '1') ||
                                                                                    (null === old('def3_auth_use_flg') && isset($record) && $record['auth_use_flg'] === 1)) checked @endif />
                                                                    </td>
                                                                    <td class="grid_wrapper_center  td_100px"><input
                                                                            type="checkbox"
                                                                            name="def3_auth_register_flg[{{ $def3['id'] }}]"
                                                                            value="1"
                                                                            class="gray def2_{{ $def2['id'] }}"
                                                                            @if (
                                                                                (null !== old('def3_auth_register_flg') && old('def3_auth_register_flg')[$def3['id']] === '1') ||
                                                                                    (null === old('def3_auth_register_flg') && isset($record) && $record['auth_register_flg'] === 1)) checked @endif />
                                                                    </td>
                                                                    <td class="grid_wrapper_center  td_100px"><input
                                                                            type="checkbox"
                                                                            name="def3_auth_del_flg[{{ $def3['id'] }}]"
                                                                            value="1"
                                                                            class="gray def2_{{ $def2['id'] }}"
                                                                            @if (
                                                                                (null !== old('def3_auth_del_flg') && old('def3_auth_del_flg')[$def3['id']] === '1') ||
                                                                                    (null === old('def3_auth_del_flg') && isset($record) && $record['auth_del_flg'] === 1)) checked @endif />
                                                                    </td>
                                                                    <td class="grid_wrapper_center  td_100px"><input
                                                                            type="checkbox"
                                                                            name="def3_auth_print_flg[{{ $def3['id'] }}]"
                                                                            value="1"
                                                                            class="gray def2_{{ $def2['id'] }}"
                                                                            @if (
                                                                                (null !== old('def3_auth_print_flg') && old('def3_auth_print_flg')[$def3['id']] === '1') ||
                                                                                    (null === old('def3_auth_print_flg') && isset($record) && $record['auth_print_flg'] === 1)) checked @endif />
                                                                    </td>
                                                                    <td class="grid_wrapper_center  td_100px">
                                                                        @if ($def3['id'] === 1)
                                                                            <input type="checkbox"
                                                                                name="def3_auth_change_flg[{{ $def3['id'] }}]"
                                                                                value="1"
                                                                                class="gray def2_{{ $def2['id'] }}"
                                                                                @if (
                                                                                    (null !== old('def3_auth_change_flg') && old('def3_auth_change_flg')[$def3['id']] === '1') ||
                                                                                        (null === old('def3_auth_change_flg') && isset($record) && $record['auth_change_flg'] === 1)) checked @endif />
                                                                        @endif
                                                                    </td>
                                                                </tr>
                                                            @endif
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    @php $k++; @endphp
                                @endif
                            @endforeach
                        </div>
                    </div>
                    @php $j++; @endphp
                @endforeach
            </div>
            <button type="submit" id="cancel" name="cancel" class="display_none_all"></button>
            <button type="submit" id="update" name="update" class="display_none_all"></button>
            <button type="submit" id="delete" name="delete" class="display_none_all" value=""></button>
            <button type="submit" id="password_reset" name="password_reset" class="display_none_all"
                value=""></button>
        </form>
    </div>
    @include('admin.master.search.department', ['departmentData' => $departmentData])
    <script src="{{ asset('js/system/security/userMaster.js') }}"></script>
    <script>
        inputBox1 = document.getElementById('user_cd');
        inputBox1.onblur = function() {
            if("" != inputBox1.value) {
                inputBox1.value = inputBox1.value.toString().padStart(4, '0');
            }
        }

        const checkbox = document.getElementById('switch');
        checkbox.addEventListener('click', () => {
            const title = document.querySelector('.title');
            if (!checkbox.checked) {
                document.getElementById('updated_switch').value = 0;
            } else {
                document.getElementById('updated_switch').value = 1;
            }
            //初期設定
            let initSwitch = document.getElementById('init_switch').value;
            let updatedSwitch = document.getElementById('updated_switch').value;
            console.log(initSwitch);
            console.log(updatedSwitch);
            if (updatedSwitch === '0' && initSwitch === '1') {
                document.getElementById('modal_attention').innerHTML = "有効フラグがOFFです。登録しますか？";
            } else {
                document.getElementById('modal_attention').innerHTML = "登録します。よろしいですか？";
            }
            //初期データがON, 更新後データがOFFの場合のみ確認コメントを出力
        });

        let eye1 = document.getElementById("eye1");
        eye1.addEventListener('click', function() {
            if (this.previousElementSibling.getAttribute('type') == 'password') {
                this.previousElementSibling.setAttribute('type', 'text');
                this.classList.toggle('fa-eye');
                this.classList.toggle('fa-eye-slash');
            } else {
                this.previousElementSibling.setAttribute('type', 'password');
                this.classList.toggle('fa-eye');
                this.classList.toggle('fa-eye-slash');
            }
        })

        let eye2 = document.getElementById("eye2");
        eye2.addEventListener('click', function() {
            if (this.previousElementSibling.getAttribute('type') == 'password') {
                this.previousElementSibling.setAttribute('type', 'text');
                this.classList.toggle('fa-eye');
                this.classList.toggle('fa-eye-slash');
            } else {
                this.previousElementSibling.setAttribute('type', 'password');
                this.classList.toggle('fa-eye');
                this.classList.toggle('fa-eye-slash');
            }
        })

        function clickCheckAllOff(elm) {
            className = elm.className;
            const checks = document.querySelectorAll("." + className);
            for (val of checks) {
                //受注計上入力以外の変更権限を更新しない
                if (val.name.indexOf('def3_auth_change_flg') > -1 && val.name !== 'def3_auth_change_flg[1]') {
                    continue;
                }
                val.checked = false;
            }
        }

        function clickCheckAllOn(elm) {
            className = elm.className;
            const checks = document.querySelectorAll("." + className);
            for (val of checks) {
                //受注計上入力以外の変更権限を更新しない
                if (val.name.indexOf('def3_auth_change_flg') > -1 && val.name !== 'def3_auth_change_flg[1]') {
                    continue;
                }
                console.log(val.name);
                val.checked = true;
            }
        }

        window.onload = function() {
            let def1_1 = document.getElementById('def1_1');
            let def1_2 = document.getElementById('def1_2');
            let def1_3 = document.getElementById('def1_3');
            let def1_4 = document.getElementById('def1_4');
            let def1_5 = document.getElementById('def1_5');
            let def1_6 = document.getElementById('def1_6');
            let def1_7 = document.getElementById('def1_7');

            def1_1.addEventListener('click', function(e) {
                document.getElementById('def2_1').checked = true;
            }, false);

            def1_2.addEventListener('click', function(e) {
                document.getElementById('def2_6').checked = true;
            }, false);

            def1_3.addEventListener('click', function(e) {
                document.getElementById('def2_10').checked = true;
            }, false);

            def1_4.addEventListener('click', function(e) {
                document.getElementById('def2_13').checked = true;
            }, false);

            def1_5.addEventListener('click', function(e) {
                document.getElementById('def2_20').checked = true;
            }, false);

            def1_6.addEventListener('click', function(e) {
                document.getElementById('def2_22').checked = true;
            }, false);

            def1_7.addEventListener('click', function(e) {
                document.getElementById('def2_24').checked = true;
            }, false);
        }
        /*
        window.onload = function() {
            let rec = document.getElementById('input_department');
            console.log(rec);
            if(null !== rec) {
                rec.focus();
                rec.blur();
            }
        }
        */
    </script>
@endsection
