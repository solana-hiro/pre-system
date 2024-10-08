@extends('layouts.admin.app')
@section('page_title', '売上確定処理')
@section('title', '売上確定処理')
@section('description', '')
@section('keywords', '')
@section('canonical', '')

@section('content')
	<div class="main-area">
        <form role="search" action="{{ route('sales_management.shipping.sale.decision.update') }}" method="post">
		@csrf
            <div class="button_area">
                <div class="div">
                    <button class="button" type="submit" name="cancel"><div class="text_wrapper">キャンセル</div></button>
                    <button class="div-wrapper" type="submit" name="execute"><div class="text_wrapper_2">一括反映</div></button>
                    <button class="button-2" type="submit" name="update"><div class="text_wrapper_3">登録する</div></button>
                </div>
            </div>
            <div class="element-form element-form-rows">
                <div class="frame">
                    <div class="text_wrapper label">入力者</div>
                    <div class="textbox">
                        <input type="text" name="input_user" class="element" minlength="0" maxlength="4" size="4" />
                        <img class="vector" src="/img/icon/vector.svg" />
                    </div>
                    <div class="textbox td_200px">
                    </div>
                </div>
            </div>
            <div class="element-form element-form-rows">
                <div class="frame">
                    <div class="text_wrapper label">指定納期</div>
                    <div class="frame">
                        <div class="textbox">
                            <input type="text" name="year" class="element textbox_40px" minlength="0" maxlength="4" value="{{ date('Y') }}">年
                            <input type="text" name="month" class="element textbox_24px" minlength="0" maxlength="2" value="{{ date('m') }}">月
                            <input type="text" name="day" class="element textbox_24px" minlength="0" maxlength="2" value="{{ date('d') }}">日
                            <img src="/img/icon/calender.svg">
                        </div>
                    </div>
                </div>
            </div><br>
            <div class="element-form element-form-rows">
                <div class="frame">
                    <div class="text_wrapper label">得意先</div>
                    <div class="textbox">
                        <input type="text" name="customer_code" class="element" minlength="0" maxlength="6" size="6" />
                        <img class="vector" src="/img/icon/vector.svg" />
                    </div>
                    <div class="textbox td_200px">
                    </div>
                </div>
            </div>
            <div class="element-form element-form-rows">
                <div class="frame">
                    <div class="text_wrapper label">納品先</div>
                    <div class="textbox">
                        <input type="text" name="delivery_name" class="element" minlength="0" maxlength="6" size="6" />
                        <img class="vector" src="/img/icon/vector.svg" />
                    </div>
                    <div class="textbox td_200px">
                    </div>
                </div>
            </div><br>
            <div class="element-form element-form-rows">
                <div class="frame">
                    <div class="text_wrapper label">受注枚数</div>
                    <div class="textbox td_100px">
                    </div>
                </div>
            </div>
            <div class="element-form element-form-rows">
                <div class="frame">
                    <div class="text_wrapper label">ピッキングリスト枚数</div>
                    <div class="textbox td_100px">
                    </div>
                </div>
            </div>
            <div class="element-form element-form-rows">
                <div class="frame">
                    <div class="text_wrapper label">受注No.</div>
                    <div class="textbox">
                        <input type="text" name="order_receive_id" class="element" minlength="0" maxlength="8" size="8" />
                        <img class="vector" src="/img/icon/vector.svg" />
                    </div>
                </div>
            </div>

            <div class="grid">
                <table class="table_sticky">
                    <thead class="grid_header">
                        <tr>
                            <td class="grid_wrapper_center td_15p">受注No.</td>
                            <td class="grid_wrapper_center td_10p">枚数</td>
                            <td class="grid_wrapper_center td_105p">検品</td>
                            <td class="grid_wrapper_center td_10p">検品保留</td>
                            <td class="grid_wrapper_center td_10p">チェック</td>
                            <td class="grid_wrapper_center td_15p">売上No.</td>
                            <td class="grid_wrapper_center td_20p">発送便</td>
                            <td class="grid_wrapper_center td_10p">個口</td>
                            <td class="grid_wrapper_center td_25p">送り状番号</td>
                        </tr>
                    </thead>
                    <tbody class="tbody_scroll">
                        @for($i = 0; $i < 16; $i++)
                            <tr>
                                <td class="grid_col_1 col_rec col_rec"></td>
                                <td class="grid_col_1 col_rec col_rec"></td>
                                <td class="grid_col_1 col_rec col_rec"></td>
                                <td class="grid_col_1 col_rec col_rec"></td>
                                <td class="grid_col_1 col_rec col_rec"></td>
                                <td class="grid_col_1 col_rec col_rec"></td>
                                <td class="grid_col_1 col_rec col_rec"></td>
                                <td class="grid_col_1 col_rec col_rec"></td>
                                <td class="grid_col_1 col_rec col_rec"></td>
                            </tr>
                        @endfor
                    </tbody>
                </table>
            </div>

            <div class="element-form-right">
                <div class="box">
                    <div class="group">
                        <div class="group_header">送り状情報
                        <button class="group_header_button" type="submit" name="execute"><div class="group_header_text_wrapper_3">一括反映</div></button></div>
                        <div class="element-form element-form-rows">
                            <div class="frame">
                                <div class="text_wrapper label">&emsp;&emsp;発送便</div>
                                <div class="textbox">
                                    <input type="text" name="mt_shipping_company_id" class="element" minlength="0" maxlength="4" size="4" />
                                    <img class="vector" src="/img/icon/vector.svg" />
                                </div>
                                <div class="textbox td_200px">
                                </div>
                            </div>
                        </div><br>
                        <div class="element-form element-form-rows">
                            <div class="frame">
                                <div class="text_wrapper label">送り状番号</div>
                                <div class="textbox">
                                    <input type="text" name="shipping_document_numbers1" class="element" minlength="0" maxlength="100" size="20" />
                                </div>
                                <div class="textbox">
                                    <input type="text" name="shipping_document_numbers2" class="element" minlength="0" maxlength="256" size="100" />
                                </div>
                            </div>
                        </div><br>
                        <div class="element-form element-form-rows">
                            <div class="frame">
                                <div class="text_wrapper label">&emsp;&emsp;個口数</div>
                                <div class="textbox">
                                    <input type="text" name="piece_number" class="element" minlength="0" maxlength="3" size="3" />
                                </div>
                            </div>
                        </div><br>
                    </div>
                </div>
            </div>
        </form>
	</div>
@endsection
