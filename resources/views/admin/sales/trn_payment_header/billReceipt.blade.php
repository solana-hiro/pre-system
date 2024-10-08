@extends('layouts.admin.app')
@section('page_title', '受取手形一覧表')
@section('title', '受取手形一覧表')
@section('description', '')
@section('keywords', '')
@section('canonical', '')
<script src="{{ asset('/js/calendar.js') }}"></script>

@section('content')
	<form role="search" action="{{ route('sales_management.accounts_receivable.bill_receipt.list.export') }}" method="post">
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
				<div class="text_wrapper label">対象年月</div>
				<div class="frame">
					<div class="textbox">
					    <input type="text" id="calendar1-year" name="year" class="element textbox_40px" minlength="0" maxlength="4" value="{{ old('year', date('Y')) }}">年
					    <input type="text" id="calendar1-month" name="month" class="element textbox_24px" minlength="0" maxlength="2" value="{{ old('month', date('m')) }}">月
					    <input type="hidden" id="calendar1-date" name="day" class="element textbox_24px" minlength="0" maxlength="2" value="">
                        <img src="/img/icon/calender.svg" onclick="onOpenCalendar('calendar1')">
					</div>
					<div class="text_wrapper">以降</div>
				</div>
			</div>
		</div>
        <button type="submit" id="cancel" name="cancel" class="display_none_all"></button>
	</form>
    @include('admin.common.calendar', ['calendarId' => 'calendar1'])
@endsection
