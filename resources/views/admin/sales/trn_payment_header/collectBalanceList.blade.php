@extends('layouts.admin.app')
@section('page_title', '未回収残一覧表')
@section('title', '未回収残一覧表')
@section('description', '')
@section('keywords', '')
@section('canonical', '')
<script src="{{ asset('/js/calendar.js') }}"></script>

@section('content')
	<form role="search" action="{{ route('sales_management.accounts_receivable.collect_balance.list.export') }}" method="post">
	    @csrf
		<div class="main-area">
			<div class="button_area">
				<div class="div">
					<button type="button" data-toggle="modal" data-target="#modal_cancel" data-value="" class="button" data-url="" name="cancel2"><div class="text_wrapper">キャンセル</div></button>
					<button class="div-wrapper" type="submit" name="excel"><div class="text_wrapper_2">Excelへ出力</div></button>
				</div>
	    	</div>
            @if ($errors->any())
                <div class="alert alert-da nger">
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
                @include('components.modal.message', ['flashmessage' => session('flashmessage') ])
            @elseif (Session::has('errormessage'))
                @include('components.modal.error', ['errormessage' => session('errormessage') ])
            @endif
            <div class="alert alert-danger">
                <ul id="alert-danger-ul">
            </div>

			<div class="element-form element-form-rows">
				<div class="text_wrapper label txt_required">対象年月</div>
				<div class="frame">
					<div class="textbox">
					    <input type="text" id="calendar1-year" name="year" class="element textbox_40px" minlength="0" maxlength="4" value="{{ date('Y') }}">年
					    <input type="text" id="calendar1-month" name="month" class="element textbox_24px" minlength="0" maxlength="2" value="{{ date('m') }}">月
                        <input type="hidden" id="calendar1-date" name="" >
					    <img src="/img/icon/calender.svg" onclick="onOpenCalendar('calendar1')">
					</div>
				</div>
			</div><br>
			<div class="element-form element-form-rows">
				<div class="text_wrapper label txt_required">担当者コード範囲</div>
				<div class="frame">
				    <div class="textbox">
						<input type="text" name="manager_code_start" class="element" minlength="0" maxlength="4" size="4" value="" />
						<img class="vector" src="/img/icon/vector.svg" />
					</div>
					<div class="text_wrapper">～</div>
					<div class="textbox">
						<input type="text" name="manager_code_end" class="element" minlength="0" maxlength="4" size="4" value="" />
						<img class="vector" src="/img/icon/vector.svg" />
					</div>
                    <input type="hidden" id="hidden_manager_start" value="" name="hidden_manager_start" />
                    <input type="hidden" id="hidden_manager_end" value="" name="hidden_manager_end" />
				</div>
			</div><br>
			<div class="element-form element-form-rows">
				<div class="text_wrapper label">請求先コード範囲</div>
				<div class="frame">
				    <div class="textbox">
						<input type="text" name="billing_address_code_start" class="element" minlength="0" maxlength="6" size="6" value="" />
						<img class="vector" src="/img/icon/vector.svg" />
					</div>
					<div class="text_wrapper">～</div>
					<div class="textbox">
						<input type="text" name="billing_address_code_end" class="element" minlength="0" maxlength="6" size="6" value="" />
						<img class="vector" src="/img/icon/vector.svg" />
					</div>
				</div>
			</div>
		</div>
        <button type="submit" id="cancel" name="cancel" class="display_none_all"></button>
	</form>
    @include('admin.master.search.manager', ['managerData' => $managerData])
    @include('admin.master.search.billing_address', ['billingAddressData' => $billingAddressData])
    @include('admin.common.calendar', ['calendarId' => 'calendar1'])
@endsection
