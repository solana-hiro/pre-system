@extends('layouts.admin.app')
@section('page_title', '請求履歴問合せ')
@section('title', '請求履歴問合せ')
@section('description', '')
@section('keywords', '')
@section('canonical', '')

@section('content')
	<form role="search" action="{{ route('sales_management.demand.history.inquiry.update') }}" method="post">
	    @csrf
		<div class="main-area">
			<div class="button_area">
				<div class="div">
					<button class="button" type="submit" name="cancel"><div class="text_wrapper">キャンセル</div></button>
					<button class="div-wrapper" type="submit" name="back"><div class="text_wrapper_2">前頁</div></button>
					<button class="div-wrapper" type="submit" name="next"><div class="text_wrapper_2">次頁</div></button>
					<button class="button-2" type="submit" name="execute"><div class="text_wrapper_3">実行する</div></button>
				</div>
	    	</div>
	    	<div class="box">
				<div class="element-form element-form-rows">
					<div class="text_wrapper label">対象請求締日</div>
					<div class="frame">
						<div class="textbox">
						    <input type="text" name="year" class="element textbox_40px" minlength="0" maxlength="4" value="{{ date('Y') }}">年
						    <input type="text" name="month" class="element textbox_24px" minlength="0" maxlength="2" value="{{ date('m') }}">月
						    <input type="text" name="day" class="element textbox_24px" minlength="0" maxlength="2" value="{{ date('d') }}">日
						    <img src="/img/icon/calender.svg">
						</div>
						<div class="txt_memo">
							（末日=99）
						</div>
					</div>
				</div><br>
				<div class="element-form element-form-rows">
					<div class="text_wrapper label">請求先コード範囲</div>
					<div class="frame">
					    <div class="textbox">
							<input type="text" name="billing_address_code_start" class="element" minlength="0" maxlength="6" size="6" />
							<img class="vector" src="/img/icon/vector.svg" />
						</div>
						<div class="text_wrapper">～</div>
					    <div class="textbox">
							<input type="text" name="billing_address_code_end" class="element" minlength="0" maxlength="6" size="6" />
							<img class="vector" src="/img/icon/vector.svg" />
						</div>
					</div>
				</div>
				<div class="element-form-rows">
			        <div class="element-form element-form-columns right_20px">
						<div class="text_wrapper">最大表示件数</div>
						<div class="frame">
							<select name="record_count" class="selectbox">
								<option value="6">6</option>
								<option value="12" selected>12</option>
								<option value="24">24</option>
								<option value="36">36</option>
							</select>
						</div>
					</div>
				</div>
			</div>
			<div class="grid">
				<table>
					<thead class="grid_header">
						<tr>
							<td class="grid_wrapper_center td_20p">請求締日</td>
							<td class="grid_wrapper_center td_35p">前回請求額</td>
							<td class="grid_wrapper_center td_15p">（総売上額）</td>
							<td class="grid_wrapper_center td_15p">（返品値引額）</td>
							<td class="grid_wrapper_center td_15p">純売上額</td>
							<td class="grid_wrapper_center td_15p">消費税</td>
							<td class="grid_wrapper_center td_15p">（現金・振込）</td>
							<td class="grid_wrapper_center td_15p">（手形）</td>
							<td class="grid_wrapper_center td_15p">（相殺値引）</td>
							<td class="grid_wrapper_center td_15p">（手数料・他）</td>
							<td class="grid_wrapper_center td_15p">入金額</td>
							<td class="grid_wrapper_center td_15p">今回請求額</td>
							<td class="grid_wrapper_center td_15p">伝票枚数</td>
						</tr>
					</thead>
					<tbody class="grid_body">
                        @for($i = 0; $i < 12; $i++)
                            <tr>
                                <td class="grid_wrapper_left"></td>
                                <td class="grid_wrapper_right"></td>
                                <td class="grid_wrapper_right"></td>
                                <td class="grid_wrapper_right"></td>
                                <td class="grid_wrapper_right"></td>
                                <td class="grid_wrapper_right"></td>
                                <td class="grid_wrapper_right"></td>
                                <td class="grid_wrapper_right"></td>
                                <td class="grid_wrapper_right"></td>
                                <td class="grid_wrapper_right"></td>
                                <td class="grid_wrapper_right"></td>
                                <td class="grid_wrapper_right"></td>
                                <td class="grid_wrapper_right"></td>
                            </tr>
                        @endfor
					</tbody>
				</table>
			</div>
		</div>
	</form>
@endsection
