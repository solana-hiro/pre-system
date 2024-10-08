@extends('layouts.admin.app')
@section('page_title', '入出庫チェックリスト')
@section('title', '入出庫チェックリスト')
@section('description', '')
@section('keywords', '')
@section('canonical', '')

@section('blade_script')
    <script src="{{ asset('/js/calendar.js') }}"></script>
@endsection

@section('content')
    @include('admin.common.calendar', ['calendarId' => 'calendar1'])
    @include('admin.common.calendar', ['calendarId' => 'calendar2'])
    @include('admin.common.calendar', ['calendarId' => 'calendar3'])
	<form role="search" action="{{ route('stock_management.stock.in_out.checklist.export') }}" method="post">
	    @csrf
		<div class="main-area">
			<div class="button_area">
				<div class="div">
					<button class="button" type="submit" name="cancel"><div class="text_wrapper">キャンセル</div></button>
					<button class="div-wrapper" type="submit" name="excel"><div class="text_wrapper_2">Excelへ出力</div></button>
				</div>
	    	</div>

			<div class="element-form element-form-rows">
				<div class="text_wrapper">帳票区分：</div>
				<div class="frame">
					<div class="div">
						<label class="text_wrapper_2">
							<input type="radio" id="" name="report_kbn" value="0" />
							商品単位
						</label>
					</div>
					<div class="div">
						<label class="text_wrapper_2">
							<input type="radio" id="" name="report_kbn" value="1" checked />
							SKU単位
						</label>
					</div>
				</div>
			</div><br>
			<div class="element-form element-form-rows">
				<div class="text_wrapper">出力順：</div>
				<div class="frame">
					<div class="div">
						<label class="text_wrapper_2">
							<input type="radio" id="" name="output_kbn" value="1" checked />
							入力日付＋処理区分＋伝票No.順
						</label>
					</div>
					<div class="div">
						<label class="text_wrapper_2">
							<input type="radio" id="" name="output_kbn" value="2" />
							伝票日付＋伝票No.順
						</label>
					</div>
				</div>
			</div><br>
			<div class="element-form element-form-rows">
				<div class="text_wrapper label">対象日付</div>
				<div class="frame">
					<div class="textbox">
					    <input type="text" name="date_year_start" class="element textbox_40px" minlength="0" maxlength="4" value="{{ date('Y') }}">年
					    <input type="text" name="date_month_start" class="element textbox_24px" minlength="0" maxlength="2" value="{{ date('m') }}">月
					    <input type="text" name="date_day_start" class="element textbox_24px" minlength="0" maxlength="2" value="{{ date('d') }}">日
					    <img src="/img/icon/calender.svg" onclick="onOpenCalendar('calendar1')">
					</div>
					<div class="text_wrapper">～</div>
					<div class="textbox">
					    <input type="text" name="date_year_end" class="element textbox_40px" minlength="0" maxlength="4" value="{{ date('Y') }}">年
					    <input type="text" name="date_month_end" class="element textbox_24px" minlength="0" maxlength="2" value="{{ date('m') }}">月
					    <input type="text" name="date_day_end" class="element textbox_24px" minlength="0" maxlength="2" value="{{ date('d') }}">日
					    <img src="/img/icon/calender.svg" onclick="onOpenCalendar('calendar1')">
					</div>
				</div>
			</div><br>
			<div class="element-form element-form-rows">
				<div class="text_wrapper">処理伝票種別：</div>
				<div class="frame">
					<div class="div">
						<label class="text_wrapper_2">
							<input type="radio" id="" name="process_kbn" value="0" />
							新規伝票
						</label>
					</div>
					<div class="div">
						<label class="text_wrapper_2">
							<input type="radio" id="" name="process_kbn" value="1" />
							修正伝票
						</label>
					</div>
					<div class="div">
						<label class="text_wrapper_2">
							<input type="radio" id="" name="process_kbn" value="2"  checked />
							すべて
						</label>
					</div>
				</div>
			</div><br>
			<div class="element-form element-form-rows">
				<div class="text_wrapper label">入力者コード範囲</div>
				<div class="frame">
				    <div class="textbox">
						<input type="text" name="user_cd_start" class="element" minlength="0" maxlength="4" size="4" value="" />
						<img class="vector" src="/img/icon/vector.svg"  data-smm-open="search_member_site_item_class"  />
					</div>
					<div class="text_wrapper">～</div>
					<div class="textbox">
						<input type="text" name="user_cd_end" class="element" minlength="0" maxlength="4" size="4" value="" />
						<img class="vector" src="/img/icon/vector.svg"  data-smm-open="search_member_site_item_class"  />
					</div>
				</div>
			</div><br>
			<div class="element-form element-form-rows">
				<div class="text_wrapper label">倉庫コード範囲</div>
				<div class="frame">
				    <div class="textbox">
						<input type="text" name="warehouse_cd_start" class="element" minlength="0" maxlength="6" size="6" value="" />
						<img class="vector" src="/img/icon/vector.svg" data-smm-open="search_warehouse_modal"/>
					</div>
					<div class="text_wrapper">～</div>
					<div class="textbox">
						<input type="text" name="warehouse_cd_end" class="element" minlength="0" maxlength="6" size="6" value="" />
						<img class="vector" src="/img/icon/vector.svg" data-smm-open="search_warehouse_modal"/>
					</div>
				</div>
			</div><br>
			<div class="element-form element-form-rows">
				<div class="text_wrapper label">取引区分</div>
				<div class="relative w-[120px]">
					<select id="def_in_out_kbn_id" name="def_in_out_kbn_id" class="w-full h-7 border border-border rounded-sm px-2">
						<option></option>
						@foreach ($inOutKbnData as $data)
							<option value="{{ $data->id }}">{{ $data->in_out_kbn_name }}</option>
						@endforeach
					</select>
				</div>
			</div><br>
			<div class="element-form element-form-rows">
				<div class="text_wrapper label">商品コード範囲</div>
				<div class="frame">
				    <div class="textbox">
						<input type="text" name="item_cd_start" class="element" minlength="0" maxlength="13" size="13" value="" />
						<img class="vector" src="/img/icon/vector.svg" data-smm-open="search_item_cd_modal"  />
					</div>
					<div class="text_wrapper">～</div>
					<div class="textbox">
						<input type="text" name="item_cd_end" class="element" minlength="0" maxlength="13" size="13" value=""/>
						<img class="vector" src="/img/icon/vector.svg" data-smm-open="search_item_cd_modal"  />
					</div>
				</div>
			</div><br>
			<div class="element-form element-form-rows">
				<div class="text_wrapper label">入出庫伝票No.範囲</div>
				<div class="frame">
				    <div class="textbox">
						<input type="text" name="in_out_number_start" class="element" minlength="0" maxlength="8" size="8" value="" />
						<img class="vector" src="/img/icon/vector.svg" data-smm-open="search_inout_number_modal" />
					</div>
					<div class="text_wrapper">～</div>
					<div class="textbox">
						<input type="text" name="in_out_number_end" class="element" minlength="0" maxlength="8" size="8" value="" />
						<img class="vector" src="/img/icon/vector.svg" data-smm-open="search_inout_number_modal" />
					</div>
				</div>
			</div><br>
		</div>
	</form>
    @include('admin.master.search.item_class_thing5')
    @include('admin.master.search.item_class_thing6')
    @include('admin.master.search.item_class_thing7')
    @include('admin.master.search.supplier')
    @include('admin.master.search.color_pattern')
    @include('admin.master.search.color')
    @include('admin.master.search.size_pattern')
    @include('admin.master.search.size')
    @include('admin.master.search.tax_rate_kbn')
    @include('admin.master.search.brand1')
    @include('admin.master.search.game_category')
    @include('admin.master.search.genre')
    @include('admin.master.search.item_class_thing4')
    @include('admin.master.search.item_cd')
    @include('admin.master.search.member_site_item')
    @include('admin.master.search.warehouse')
    @include('admin.master.search.stock_cd')
@endsection
