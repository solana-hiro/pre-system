@extends('layouts.admin.app')
@section('page_title', 'ユーザマスタ')
@section('title', 'ユーザマスタ')
@section('description', '')
@section('keywords', '')
@section('canonical', '')

@section('content')
    <form role="search" action="{{ route('system.security.user.update') }}" method="post">
        @csrf
        <div class="main-area">
            <div class="button_area">
                <div class="div">
                    @if ($commonParams['auth']['auth_print_flg'] === 1)
                        <button class="div-wrapper" type="button" name="download" id="download">
                            <div class="text_wrapper_2">Excelへ出力</div>
                        </button>
                    @else
                        <button class="div-wrapper" type="button" name="download" id="download" disabled>
                            <div class="text_wrapper_2">Excelへ出力</div>
                        </button>
                    @endif
                    @if ($commonParams['auth']['auth_register_flg'] === 1)
                        <button type="button" class="button-2" data-url="" name="update" id="updateRec">
                            <div class="text_wrapper_3">登録する</div>
                        </button>
                    @else
                        <button type="button" class="button-2" data-url="" name="update" id="updateRec" disabled>
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
                <div class="group">
                    <div class="element-form-rows">
                        <div class="element-form-columns">
                            <div class="element-form element-form-rows">
                                <div class="text_wrapper td_120px">ユーザコード</div>
                                <div class="frame">
                                    <div class="textbox">
                                        <input type="number" name="user_cd" class="element input_number_4" id="user_cd" data-limit-len="4" data-limit-minus
                                            value="{{ isset($param['user_cd']) ? $param['user_cd'] : '' }}" />
                                    </div>
                                </div>
                            </div><br>
                            <div class="element-form element-form-rows">
                                <div class="text_wrapper td_120px">ユーザ名部分</div>
                                <div class="frame">
                                    <div class="textbox">
                                        <input type="text" name="user_name" class="element" minlength="0" maxlength="20"
                                            size="20"
                                            value="{{ isset($param['user_name']) ? $param['user_name'] : '' }}" />
                                    </div>
                                </div>
                            </div><br>
                            <div class="element-form element-form-rows">
                                <div class="text_wrapper td_120px">ユーザ名カナ部分</div>
                                <div class="frame">
                                    <div class="textbox">
                                        <input type="text" name="user_name_kana" class="element" minlength="0"
                                            maxlength="10" size="10"
                                            value="{{ isset($param['user_name_kana']) ? $param['user_name_kana'] : '' }}" />
                                    </div>
                                </div>
                            </div><br>
                            <div class="alert alert-danger">
                                <ul id="alert-danger-ul">
                            </div>
                            <div class="element-form element-form-rows">
                                <div class="text_wrapper td_120px">部門</div>
                                <div class="frame">
                                    <div class="textbox">
                                        <input type="number" name="department_cd" class="element input_number_4" id="input_department"
                                        onblur="blurCodeAutoDepartments(arguments[0], this)" data-limit-len="4" data-limit-minus
                                            value="{{ isset($param['department_cd']) ? $param['department_cd'] : '' }}" />
                                        <img class="vector" id="img_department" src="/img/icon/vector.svg"
                                            data-smm-open="search_department_modal" />
                                        <input type="hidden" id="hidden_department" value=""
                                            name="hidden_department" />
                                    </div>
                                    <div class="textbox td_200px txt_blue" id="names_department">
                                        {{ isset($param['department_name']) ? $param['department_name'] : '' }}
                                    </div>
                                </div>
                            </div>
                        </div><br>
                        <div class="element-form-columns">
                            <div class="element-form element-form-columns">
                                <label>
                                    <input type="checkbox" id="" value="1"
                                        name="sp_auth_price_correction_possible"
                                        @if (isset($param['sp_auth_price_correction_possible']) && $param['sp_auth_price_correction_possible'] === '1') checked @endif />
                                    <span class="">単価訂正可能のみ</span>
                                </label>
                            </div>
                            <div class="element-form element-form-columns">
                                <label>
                                    <input type="checkbox" id="" value="1"
                                        name="sp_auth_star_none_possible"
                                        @if (isset($param['sp_auth_star_none_possible']) && $param['sp_auth_star_none_possible'] === '1') checked @endif />
                                    <span class="">★無し可能のみ</span>
                                </label>
                            </div>
                            <div class="element-form element-form-columns">
                                <label>
                                    <input type="checkbox" id="" value="1"
                                        name="sp_auth_hand_inspection_possible"
                                        @if (isset($param['sp_auth_hand_inspection_possible']) && $param['sp_auth_hand_inspection_possible'] === '1') checked @endif />
                                    <span class="">手検品可能のみ</span>
                                </label>
                            </div>
                            <div class="element-form element-form-columns">
                                <label>
                                    <input type="checkbox" id="" value="1" name="validity_flg"
                                        @if (isset($param['validity_flg']) && $param['validity_flg'] === '1') checked @endif />
                                    <span class="">有効のみ</span>
                                </label>
                            </div>
                            <div class="button_area_blue">
                                <div class="div">
                                    <button class="div-wrapper" type="submit" name="search" id="search">
                                        <div class="text_wrapper_2">検索する</div>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="grid">
                <table>
                    <thead class="grid_header">
                        <tr>
                            <td class="grid_wrapper_center td_5p">編集</td>
                            <td class="grid_wrapper_center td_10p">ユーザコード</td>
                            <td class="grid_wrapper_center td_20p">ユーザ名</td>
                            <td class="grid_wrapper_center td_20p">ユーザ名カナ</td>
                            <td class="grid_wrapper_center td_10p">部門コード</td>
                            <td class="grid_wrapper_center td_20p">部門名</td>
                            <td class="grid_wrapper_center td_10p">単価訂正可能</td>
                            <td class="grid_wrapper_center td_10p">★無し可能</td>
                            <td class="grid_wrapper_center td_10p">手検品可能</td>
                            <td class="grid_wrapper_center td_10p">有効</td>
                        </tr>
                    </thead>
                    <tbody class="grid_body">
                        @if (isset($initData) && count($initData) > 0)
                            <p>検索結果: {{ count($initData) }} 件</p>
                        @elseif(isset($initData) && count($initData) === 0)
                            <p>検索結果: 0件</p>
                        @endif
                        @if (isset($initData) && count($initData) > 0)
                            @php $i=0; @endphp
                            @foreach ($initData as $data)
                                <tr>
                                    <td class="grid_col_1 col_rec center">
                                        <button type="submit" name="edit" value="{{ $data['id'] }}"
                                            class="display_none">
                                            <img class="grid_img_center" src="{{ asset('/img/icon/edit.svg') }}"></a>
                                        </button>
                                    </td>
                                    <td class="grid_col_2 col_rec">{{ $data['user_cd'] }}</td>
                                    <td class="grid_col_2 col_rec">{{ $data['user_name'] }}</td>
                                    <td class="grid_col_2 col_rec">{{ $data['user_name_kana'] }}</td>
                                    <td class="grid_col_2 col_rec">{{ $data['department_cd'] }}</td>
                                    <td class="grid_col_2 col_rec">{{ $data['department_name'] }}</td>
                                    <td class="grid_col_1 col_rec center"><input type="checkbox" id=""
                                            name="" value="{{ $data['sp_auth_price_correction_possible'] }}"
                                            class="gray_checkbox" @if ($data['sp_auth_price_correction_possible'] === 1) checked @endif
                                            onclick="return false;" /></td>
                                    <td class="grid_col_1 col_rec center"><input type="checkbox" id=""
                                            name="" value="{{ $data['sp_auth_star_none_possible'] }}"
                                            class="gray_checkbox" @if ($data['sp_auth_star_none_possible'] === 1) checked @endif
                                            onclick="return false;" /></td>
                                    <td class="grid_col_1 col_rec center"><input type="checkbox" id=""
                                            name="" value="{{ $data['sp_auth_hand_inspection_possible'] }}"
                                            class="gray_checkbox" @if ($data['sp_auth_hand_inspection_possible'] === 1) checked @endif
                                            onclick="return false;" /></td>
                                    <td class="grid_col_1 col_rec center"><input type="checkbox" id=""
                                            name="" value="{{ $data['validity_flg'] }}" class="gray_checkbox"
                                            @if ($data['validity_flg'] === 1) checked @endif onclick="return false;" />
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
        <button type="submit" id="cancel" name="cancel" class="display_none_all"></button>
        <button type="submit" id="update" name="update" class="display_none_all"></button>
        <button type="submit" id="delete" name="delete" class="display_none_all" value=""></button>
        <button type="submit" id="redirect" name="redirect" class="display_none_all" value=""></button>
        <button type="submit" id="excel" name="excel" class="display_none_all" value=""></button>
    </form>
    @include('admin.master.search.department', ['departmentData' => $departmentData])
    <script src="{{ asset('js/system/security/userList.js') }}"></script>
    <script>
        inputBox1 = document.getElementById('user_cd');
        inputBox1.onblur = function() {
            if("" != inputBox1.value) {
                inputBox1.value = inputBox1.value.toString().padStart(4, '0');
            }
        }
        document.addEventListener('DOMContentLoaded', pageLoad)
        /* ページをロードした時にテキストボックスにリスナを登録 */
        function pageLoad() {
            var userCd = document.getElementById('user_cd');
            userCd.addEventListener('keydown', enterKeyPress);
        }
        /* テキストボックスでEnterキーが押されたらコンソールに文字を表示 */
        function enterKeyPress(event) {
            if (event.key === 'Enter') {
                document.getElementById("search").click();
            }
        }
        document.getElementById("download").addEventListener('click', function(e) {
            document.getElementById('excel').click();
        }, false);

        document.getElementById("updateRec").addEventListener('click', function(e) {
            document.getElementById('update').click();
        }, false);
    </script>
@endsection
