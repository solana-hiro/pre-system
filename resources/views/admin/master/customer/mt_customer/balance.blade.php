@extends('layouts.admin.app')
@section('page_title', '得意先入力（残高）')
@section('title', '得意先入力（残高）')
@section('description', '')
@section('keywords', '')
@section('canonical', '')

@section('content')
	<div class="main-area">
		<form role="search" action="{{ route('master.customer.mt_customer.balance.update') }}" method="post">
	    @csrf
			<div class="button_area">
				<div class="div">
					<button class="button" type="submit" name="cancel"><div class="text_wrapper">キャンセル</div></button>
					<button class="button" type="submit" name="delete"><div class="text_wrapper">削除する</div></button>
					<button class="div-wrapper" type="submit" name="back"><div class="text_wrapper_2">前頁</div></button>
					<button class="div-wrapper" type="submit" name="next"><div class="text_wrapper_2">次頁</div></button>
					<button class="button-2" type="submit" name="execute"><div class="text_wrapper_3">実行する</div></button>
				</div>
	    	</div>
	    	<div class="box">
				<div class="group">
					<div class="element">
						<div class="text_wrapper">区分</div>
						<div class="frame">
							<div class="div">
								<label class="text_wrapper_2">
									<input type="radio" id="" name="kbn" value="new" checked />
									新規
								</label>
							</div>
							<div class="div">
								<label class="text_wrapper_2">
									<input type="radio" id="" name="kbn" value="accounts_receivable" />
									修正売掛
								</label>
							</div>
							<div class="div">
								<label class="text_wrapper_2">
									<input type="radio" id="" name="kbn" value="pay" />
									修正支払
								</label>
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="grid">
				<table class="table_100p">
					<thead class="grid_header">
						<tr>
							<td rowspan="2" class="grid_wrapper_center td_10p">請求先<br>コード</td>
							<td rowspan="2" class="grid_wrapper_center td_30p">請求先略称</td>
							<td rowspan="2" colspan="3" class="grid_wrapper_center td_10p">締日</td>
							<td colspan="2" class="grid_wrapper_center td_20p">売掛</td>
							<td colspan="2" class="grid_wrapper_center td_20p">請求</td>
						</tr>
						<tr>
							<td class="grid_wrapper_center">日付</td>
							<td class="grid_wrapper_center">残高</td>
							<td class="grid_wrapper_center">日付</td>
							<td class="grid_wrapper_center">残高</td>
						</tr>
					</thead>
					<tbody class="grid_body">
						</tr>
						@for($i = 0; $i <= 14; $i++)
					        @if($i % 2 === 0)
					        	<tr>
					        @else
					        	<tr class="col_yellow">
				        	@endif
								<td class="grid_wrapper_left td_10p"><input type="text" placeholder="" class="grid_textbox"><img class="vector" src="{{ asset('/img/icon/vector.svg') }}" /></td>
								<td class="grid_wrapper_left td_10p"><input type="text" placeholder="" class="grid_textbox"></td>
								<td class="grid_wrapper_left td_3p"><input type="text" placeholder="" class="grid_textbox" minlength="0" maxlength="2"></td>
								<td class="grid_wrapper_left td_3p"><input type="text" placeholder="" class="grid_textbox" minlength="0" maxlength="2"></td>
								<td class="grid_wrapper_left td_3p"><input type="text" placeholder="" class="grid_textbox" minlength="0" maxlength="2"></td>
								<td class="grid_wrapper_left td_10p">
									<input type="text" placeholder="" class="grid_textbox grid_textbox_25em" minlength="0" maxlength="4">年
									<input type="text" placeholder="" class="grid_textbox grid_textbox_15em" minlength="0" maxlength="2">月
									<input type="text" placeholder="" class="grid_textbox grid_textbox_15em" minlength="0" maxlength="2">日
									<img src="{{ asset('/img/icon/calender.svg') }}" class="img_calender">
								</td>
							    <td class="grid_wrapper_left td_15p"><img src="{{ asset('/img/icon/star_border.svg') }}"><span class="text_amount"><input type="text" placeholder="" class="grid_textbox text_amount" minlength="0" maxlength="13"></td></span></td>
								<td class="grid_wrapper_left td_10p">
									<input type="text" placeholder="" class="grid_textbox grid_textbox_25em" minlength="0" maxlength="4">年
									<input type="text" placeholder="" class="grid_textbox grid_textbox_15em" minlength="0" maxlength="2">月
									<input type="text" placeholder="" class="grid_textbox grid_textbox_15em" minlength="0" maxlength="2">日
									<img src="{{ asset('/img/icon/calender.svg') }}" class="img_calender">
								</td>
							    <td class="grid_wrapper_left td_15p"><img src="{{ asset('/img/icon/star_border.svg') }}"><span class="text_amount"><input type="text" placeholder="" class="grid_textbox text_amount" minlength="0" maxlength="13"></td></span></td>
						@endfor
					</tbody>
				</table>
				<div class="note">☆：残設定あり</div>
			</div>
			@include('components.menu.selected', ['view' => 'main'])
		</form>
	</div>
@endsection
