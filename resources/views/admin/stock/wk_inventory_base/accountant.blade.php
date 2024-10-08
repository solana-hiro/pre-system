@extends('layouts.admin.app')
@section('page_title', '棚卸計上入力')
@section('title', '棚卸計上入力')
@section('description', '')
@section('keywords', '')
@section('canonical', '')

@section('content')
	<form role="search" action="{{ route('stock_management.inventory.accountant.update') }}" method="post">
	    @csrf
		<div class="main-area">
			<div class="button_area">
				<div class="div">
					<button class="button-2" type="submit" name="update"><div class="text_wrapper_3">登録する</div></button>
				</div>
	    	</div>
	    	<div class="element-form">
				<div class="element-form element-form-rows">
					<div class="frame">
						<div class="text_wrapper label">対象請求締日</div>
						<div class="textbox">
						    <input type="text" name="name" class="element textbox_40px" minlength="0" maxlength="4" value="">年
						    <input type="text" name="name" class="element textbox_24px" minlength="0" maxlength="2" value="">月
						    <input type="text" name="name" class="element textbox_24px" minlength="0" maxlength="2" value="">日
						    <img src="/img/icon/calender.svg">
						</div>
					</div>
				</div>
				<div class="element-form element-form-rows">
					<div class="frame">
						<div class="text_wrapper label">棚卸No.</div>
					    <div class="textbox">
							<input type="text" name="name" class="element" minlength="0" maxlength="6" size="10" />
							<img class="vector" src="/img/icon/vector.svg" />
						</div>
					</div>
				</div>
				<div class="element-form element-form-rows">
					<div class="frame">
						<div class="text_wrapper label">入力者</div>
					    <div class="textbox">
							<input type="text" name="name" class="element" minlength="0" maxlength="6" size="10" />
							<img class="vector" src="/img/icon/vector.svg" />
						</div>
					    <div class="textbox">
							<input type="text" name="name" class="element" minlength="0" maxlength="6" size="10" />
						</div>
					</div>
				</div><br>
			</div>
	    	<div class="element-form">
				<div class="element-form element-form-rows">
					<div class="frame">
						<div class="text_wrapper label">実施棚卸日付</div>
						<div class="textbox">
						    <input type="text" name="name" class="element textbox_40px" minlength="0" maxlength="4" value="">年
						    <input type="text" name="name" class="element textbox_24px" minlength="0" maxlength="2" value="">月
						    <input type="text" name="name" class="element textbox_24px" minlength="0" maxlength="2" value="">日
						    <img src="/img/icon/calender.svg">
						</div>
					</div>
				</div>
				<div class="element-form element-form-rows">
					<div class="frame">
						<div class="text_wrapper label">倉庫</div>
					    <div class="textbox">
							<input type="text" name="name" class="element" minlength="0" maxlength="6" size="10" />
							<img class="vector" src="/img/icon/vector.svg" />
						</div>
					</div>
				</div>
				<div class="element-form element-form-rows">
					<div class="frame">
						<div class="text_wrapper label">棚番</div>
					    <div class="textbox">
							<input type="text" name="name" class="element" minlength="0" maxlength="6" size="10" />
							<img class="vector" src="/img/icon/vector.svg" />
						</div>
					    <div class="textbox">
							<input type="text" name="name" class="element" minlength="0" maxlength="6" size="10" />
						</div>
					</div>
				</div><br>
			</div>
			<div class="grid">
				<table>
					<thead class="grid_header">
						<tr>
							<td class="grid_wrapper_center td_15p" colspan="2">商品コード</td>
							<td class="grid_wrapper_center td_30p">商品</td>
							<td class="grid_wrapper_center td_5p">単位</td>
							<td class="grid_wrapper_center td_15p" colspan="2">サイズ</td>
							<td class="grid_wrapper_center td_15p" colspan="2">サイズ</td>
							<td class="grid_wrapper_center td_10p">棚卸数量</td>
							<td class="grid_wrapper_center td_10p">棚卸単価</td>
						</tr>
					</thead>
					<tbody class="grid_body">
						@for($i = 0; $i <= 30; $i++)
							<tr>
								<td class="grid_wrapper_left"><input type="text" placeholder="" class="grid_textbox"><img class="vector" src="{{ asset('/img/icon/vector.svg') }}" /></td>
								<td class="grid_wrapper_left"><input type="text" placeholder="" class="grid_textbox"></td>
								<td class="grid_wrapper_right"><input type="text" placeholder="" class="grid_textbox"></td>
								<td class="grid_wrapper_right"><input type="text" placeholder="" class="grid_textbox"></td>
								<td class="grid_wrapper_right"><input type="text" placeholder="" class="grid_textbox"></td>
								<td class="grid_wrapper_right"><input type="text" placeholder="" class="grid_textbox"></td>
								<td class="grid_wrapper_right"><input type="text" placeholder="" class="grid_textbox"></td>
								<td class="grid_wrapper_right"><input type="text" placeholder="" class="grid_textbox"></td>
								<td class="grid_wrapper_right"><input type="text" placeholder="" class="grid_textbox"></td>
								<td class="grid_wrapper_right"><input type="text" placeholder="" class="grid_textbox"></td>
							</tr>
						@endfor
					</tbody>
				</table>
			</div>
		</div>
	</form>
@endsection
