@extends('layouts.admin.app')
@section('page_title', '棚卸終了処理')
@section('title', '棚卸終了処理')
@section('description', '')
@section('keywords', '')
@section('canonical', '')

@section('content')
	<form role="search" action="{{ route('stock_management.inventory.end.update') }}" method="post">
	    @csrf
		<div class="main-area">
			<div class="button_area">
				<div class="div">
					<button class="button-2" type="submit" name="execute"><div class="text_wrapper_3">実行する</div></button>
				</div>
	    	</div>

			<div class="box">
				<div class="element-form element-form-rows">
					<div class="text_wrapper label">今回棚卸日付</div>
					<div class="frame">
						<div class="textbox">
						    <input type="text" name="year" class="element textbox_40px" minlength="0" maxlength="4" value="{{ isset($nowInventoryDate) ? date('Y', strtotime($nowInventoryDate)) : '' }}">年
						    <input type="text" name="month" class="element textbox_24px" minlength="0" maxlength="2" value="{{ isset($nowInventoryDate) ? date('m', strtotime($nowInventoryDate)) : '' }}">月
						    <input type="text" name="day" class="element textbox_24px" minlength="0" maxlength="2" value="{{ isset($nowInventoryDate) ? date('d', strtotime($nowInventoryDate)) : '' }}">日
						    <img src="/img/icon/calender.svg">
						</div>
					</div>
				</div><br>
			</div>
		</div>
	</form>
@endsection
