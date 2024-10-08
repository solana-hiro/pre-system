@extends('layouts.admin.app')
@section('page_title', '出荷検品処理')
@section('title', '出荷検品処理')
@section('description', '')
@section('keywords', '')
@section('canonical', '')

@section('content')
	<div class="main-area">
		<form role="search" action="{{ route('sales_management.shipping.inspection.execute') }}" method="post">
		@csrf
			<div class="button_area">
				<div class="div">
					<button class="button" type="submit" name="cancel"><div class="text_wrapper">キャンセル</div></button>
					<button class="div-wrapper" type="submit" name="inspection"><div class="text_wrapper_2">手検品</div></button>
					<button class="button-2" type="submit" name="update"><div class="text_wrapper_3">登録する</div></button>
				</div>
	    	</div>
	    	<div class="elements_both">
				<div class="element-form-left">
					<div class="element-form element-form-rows">
						<div class="text_wrapper label">指定納期</div>
						<div class="frame">
							<div class="textbox">
							    <input type="text" name="year" class="element textbox_40px" minlength="0" maxlength="4" value="{{ date('Y') }}">年
							    <input type="text" name="month" class="element textbox_24px" minlength="0" maxlength="2" value="{{ date('m') }}">月
							    <input type="text" name="day" class="element textbox_24px" minlength="0" maxlength="2" value="{{ date('d') }}">日
							    <img src="/img/icon/calender.svg">
							</div>
						</div>
					</div><br>
					<div class="element-form element-form-rows">
						<div class="text_wrapper label">検品担当</div>
						<div class="frame">
						    <div class="textbox">
								<input type="text" name="inspection_code" class="element" minlength="0" maxlength="4" size="4" />
								<img class="vector" src="/img/icon/vector.svg" />
							</div>
							<div class="textbox td_200px">

							</div>
						</div>
					</div><br>
					<div class="element-form element-form-rows">
						<div class="text_wrapper label">得意先</div>
						<div class="frame">
						    <div class="textbox">
								<input type="text" name="customer_code" class="element" minlength="0" maxlength="6" size="6" />
								<img class="vector" src="/img/icon/vector.svg" />
							</div>
							<div class="textbox td_200px">

							</div>
						</div>
					</div><br>
					<div class="element-form element-form-rows">
						<div class="text_wrapper label">納品先</div>
						<div class="frame">
						    <div class="textbox">
								<input type="text" name="delivery_code" class="element" minlength="0" maxlength="6" size="6" />
								<img class="vector" src="/img/icon/vector.svg" />
							</div>
							<div class="textbox td_200px">

							</div>
						</div>
					</div><br>
					<div class="element-form element-form-rows">
						<div class="text_wrapper label">受注No.</div>
						<div class="frame">
						    <div class="textbox">
								<input type="text" name="order_receive_no" class="element" minlength="0" maxlength="8" size="8" />
								<img class="vector" src="/img/icon/vector.svg" />
							</div>
						</div>
					</div><br>
				</div>
				<div class="element-form-right">
					<div class="box">
						<div class="group">
							<div class="element-form element-form-rows">
								<div class="frame">
									<div class="text_wrapper label">ピッキング担当（大口）</div>
								    <div class="textbox">
										<input type="text" name="picking_manager_id" class="element" minlength="0" maxlength="4" size="4" />
										<img class="vector" src="/img/icon/vector.svg" />
									</div>
									<div class="textbox td_200px">
									</div>
								</div>
							</div><br>
							<div class="element-form element-form-rows">
								<div class="frame">
									<div class="text_wrapper label">&emsp;&emsp;&emsp;&emsp;&emsp;受注伝票枚数</div>
									<div class="textbox td_100px">
									</div>
								</div>
							</div><br>
							<div class="element-form element-form-rows">
								<div class="frame">
									<div class="text_wrapper label">&emsp;ピッキングリスト枚数</div>
									<div class="textbox td_100px">
									</div>
								</div>
							</div><br>
						</div>
					</div>
				</div>
			</div>

			<div class="grid">
				<table class="table_sticky">
					<thead class="grid_header">
						<tr>
							<td class="grid_wrapper_center td_10p">受注No.</td>
							<td class="grid_wrapper_center td_5p">枚数</td>
							<td class="grid_wrapper_center td_10p">ピッキング<br>担当者コード</td>
							<td class="grid_wrapper_center td_20p">ピッキング担当者名</td>
							<td class="grid_wrapper_center td_10p">最終ピッキング<br>担当者コード</td>
							<td class="grid_wrapper_center td_20p">最終ピッキング担当者名</td>
							<td class="grid_wrapper_center td_10p">検品<br>担当者コード</td>
							<td class="grid_wrapper_center td_20p">検品担当者名</td>
							<td class="grid_wrapper_center td_5p">検品</td>
							<td class="grid_wrapper_center td_5p">保留</td>
						</tr>
					</thead>
					<tbody class="tbody_scroll">
						@for($i = 0; $i <= 80; $i++)
							<tr>
								<td class="grid_wrapper_left"></td>
								<td class="grid_wrapper_left"></td>
								<td class="grid_wrapper_left"></td>
								<td class="grid_wrapper_left"></td>
								<td class="grid_wrapper_left"></td>
								<td class="grid_wrapper_left"></td>
								<td class="grid_wrapper_left"></td>
								<td class="grid_wrapper_left"></td>
								<td class="grid_wrapper_left"></td>
								<td class="grid_wrapper_left"></td>
							</tr>
						@endfor
					</tbody>
				</table>
			</div>
		</form>
	</div>
@endsection
