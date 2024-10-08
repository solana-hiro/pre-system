@extends('layouts.admin.app')
@section('page_title', '受注計上入力')
@section('title', '受注計上入力')
@section('description', '')
@section('keywords', '')
@section('canonical', '')
@section('blade_script')
<script>
var default_mt_customer_id =  @json(old('mt_customer_id', isset($accountant_default_data['mt_customer_id']) ? $accountant_default_data['mt_customer_id'] : ''));
var default_mt_delivery_destination_id = @json(old('mt_delivery_destination_id', isset($accountant_default_data['mt_delivery_destination_id']) ? $accountant_default_data['mt_delivery_destination_id'] : ''));
var default_mt_warehouse_id = @json(old('mt_warehouse_id', isset($accountant_default_data['mt_warehouse_id']) ? $accountant_default_data['mt_warehouse_id'] : ''));
</script>
<script src="{{ asset('/js/calendar.js') }}"></script>
<script src="{{ asset('/js/sales/trn_order_receive_header/accountantIndex.js') }}"></script>
<script type="module" src="{{ asset('/js/sales/trn_order_receive_header/accountantIndexSub.js') }}"></script>
@if ($errors->any() && $errors->has('confirm_error'))
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // モーダルを表示
        var modal = document.getElementById('errorModal');
        var closeButtons = document.querySelectorAll('.close');
        var confirmButtons = document.querySelectorAll('.submit');

        // モーダルを表示
        modal.style.display = 'flex';

        // 閉じるボタンがクリックされた場合
        closeButtons.forEach(function(btn) {
            btn.onclick = function () {
                modal.style.display = 'none';
            };
        });

        // confirmButtonsボタンを押したらformにtype=hidden, name=amount_checkの値を1にセットしてsubmit
        confirmButtons.forEach(function(btn) {
            btn.onclick = function () {
                var form = document.getElementById('form');
                var input = document.createElement('input');
                input.setAttribute('type', 'hidden');
                input.setAttribute('name', 'amount_check');
                input.setAttribute('value', 1);
                form.appendChild(input);
                form.submit();
                modal.style.display = 'none';
            };
        });

        // モーダルの外側をクリックした場合
        window.onclick = function (event) {
            if (event.target == modal) {
                modal.style.display = 'none';
            }
        };
    });
</script>
@endif
@if ($errors->any() && $errors->has('commission_confirm_error'))
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // モーダルを表示
        var modal = document.getElementById('commissionAutoModal');
        var closeButtons = document.querySelectorAll('.close');
        var confirmButtons = document.querySelectorAll('.submit');

        // モーダルを表示
        modal.style.display = 'flex';

        // 閉じるボタンがクリックされた場合
        closeButtons.forEach(function(btn) {
            btn.onclick = function () {
                modal.style.display = 'none';
            };
        });

        // confirmButtonsボタンを押したら
        confirmButtons.forEach(function(btn) {
            btn.onclick = function () {
                const table_row_append_btn = document.getElementById('table_row_append_btn');
                // clickをtriggerする
                table_row_append_btn.click();
                const table_body = document.getElementById('table_body');
                // n-1目の行を取得
                const last_row = table_body.querySelector(`#table_row_${table_body.children.length - 1}`);
                // 商品コードの値を850000000にセット
                const item_cd = last_row.querySelector('.item_cd');
                item_cd.value = '850000000';
                modal.style.display = 'none';
            };
        });

        // モーダルの外側をクリックした場合
        window.onclick = function (event) {
            if (event.target == modal) {
                modal.style.display = 'none';
            }
        };
    });
</script>
@endif
@if ($errors->any() && $errors->has('custom_error'))
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // モーダルを表示
        var modal = document.getElementById('confirmModal');
        var closeButtons = document.querySelectorAll('.close');

        // モーダルを表示
        modal.style.display = 'flex';

        // 閉じるボタンがクリックされた場合
        closeButtons.forEach(function(btn) {
            btn.onclick = function () {
                modal.style.display = 'none';
            };
        });

        // モーダルの外側をクリックした場合
        window.onclick = function (event) {
            if (event.target == modal) {
                modal.style.display = 'none';
            }
        };
    });
</script>
@endif
@endsection

@section('content')
<?php
$default_details = array(
  array(
    'order_receive_detail_cd' => '001',
    'item_kbn' => '0',
    'item_cd' => '',
    'price_rate' => '',
    'retail_price' => '',
    'order_receive_price' => '',
    'order_receive_amount' => '',
    'release_start_datetime_year' => date("Y"),
    'release_start_datetime_month' => date("m"),
    'release_start_datetime_day' => date("d"),
    'specify_deadline_none_flg' => 0,
    'order_receive_finish_flg' => 0,
    'memo_1' => '',
    'shortage_flg' => 0,
    'remaining_flg' => 0,
    'payment_finish_flg' => 0,
    'item_name' => '',
    'order_receive_quantity' => '0',
    'cost_price' => '',
    'cost_amount' => '',
    'memo_2' => '',
  )
)
?>
@include('admin.common.calendar', ['calendarId' => 'calendar1'])
@include('admin.common.calendar', ['calendarId' => 'calendar2'])
@include('admin.common.calendar', ['calendarId' => 'calendar3'])
@include('admin.common.calendar', ['calendarId' => 'specify_deadline_from'])
@include('admin.common.calendar', ['calendarId' => 'specify_deadline_to'])
@include('admin.common.calendar', ['calendarId' => 'release_start_datetime'])
@include('admin.common.calendar', ['calendarId' => 'information_arrival_date'])
@include('admin.common.calendar', ['calendarId' => 'income_date'])
<form method="POST" id="form" action="{{ route('sales_management.order_receive.accountant.update') }}">
    @csrf
	<div class="main-area">
		<div class="button_area">
			<div class="div">
				<button class="button"><div class="text_wrapper">キャンセル</div></button>
				<button class="button"><div class="text_wrapper">削除する</div></button>
				<button class="div-wrapper" type="button" onclick="showReferenceMenu()"><div class="text_wrapper_2">参照する</div></button>
				<button class="div-wrapper"><div class="text_wrapper_2">前伝票</div></button>
				<button class="div-wrapper"><div class="text_wrapper_2">次伝票</div></button>
				<button class="div-wrapper" onclick="showExtendedItemInput()" type="button"><div class="text_wrapper_2">伝票拡張</div></button>
				<button class="button-2" type="submit" name="create"><div class="text_wrapper_3">登録する</div></button>
			</div>
    </div>
    <div>
      <div class="flex">
        <div class="mr-5">
          <label class="text-required text-sm">受注No.</label>
          <div class="relative w-[112px]">
            <input type="text" class="w-full h-7 border border-border rounded-sm px-2" name="order_receive_number" minlength="0" maxlength="8" value="{{ old('order_receive_number', isset($accountant_default_data['order_receive_number']) ? $accountant_default_data['order_receive_number'] : '') }}" />
            <i class="absolute top-[5px] right-2 fa-solid fa-magnifying-glass text-[#B6B6B6]" data-smm-open="search_order_receive_header"></i>
          </div>
        </div>
        <div class="mr-5 element-form flex flex-col items-start">
          <label class="text-required text-sm">受注日</label>
          <div class="frame" style="margin-left: 0">
            <div class="textbox">
              <input type="text" id="calendar1-year" name="order_date_year"
                     class="element textbox_40px" minlength="0" maxlength="4"
                     value="{{ old('order_date_year', isset($accountant_default_data['order_date_year']) ? $accountant_default_data['order_date_year'] : '') }}">年
              <input type="text" id="calendar1-month" name="order_date_month"
                     class="element textbox_24px" minlength="0" maxlength="2"
                     value="{{ old('order_date_month', isset($accountant_default_data['order_date_month']) ? $accountant_default_data['order_date_month'] : '') }}">月
              <input type="text" id="calendar1-date" name="order_date_day"
                     class="element textbox_24px" minlength="0" maxlength="2"
                     value="{{ old('order_date_day', isset($accountant_default_data['order_date_day']) ? $accountant_default_data['order_date_day'] : '') }}">日
              <img src="/img/icon/calender.svg" onclick="onOpenCalendar('calendar1')">
            </div>
          </div>
        </div>
        <div class="mr-5">
          <label class="text-required text-sm">入力者<span id="alert-danger-ul-manager" class="alert alert-danger"></span></label>
          <div class="flex">
            <div class="relative w-[76px] mr-2">
              <input type="text" class="w-full h-7 border border-border rounded-sm px-2" name="user_cd" value="{{ old('user_cd', isset($accountant_default_data['user_cd']) ? $accountant_default_data['user_cd'] : '') }}" onblur="blurCodeautoUser(arguments[0], this)" />
              <i class="absolute top-[5px] right-2 fa-solid fa-magnifying-glass text-[#B6B6B6]" data-smm-open="search_manager_modal"></i>
            </div>
            <div class="relative min-w-[112px]">
                <div class="w-full h-7 flex items-center border border-border rounded-sm px-2" id="names_manager" >{{ old('user_name', isset($accountant_default_data['user_name']) ? $accountant_default_data['user_name'] : '') }}</div>
            </div>
          </div>
        </div>
        <div class="mr-5">
          <label class="text-baseText text-sm">EC注文番号</label>
          <div class="relative w-[96px]">
            <input type="text" class="w-full h-7 border border-border rounded-sm px-2" minlength="0" name="ec_order_receive_number" maxlength="9" value="{{ old('ec_order_receive_number', isset($accountant_default_data['ec_order_receive_number']) ? $accountant_default_data['ec_order_receive_number'] : '') }}" />
          </div>
        </div>
        <div class="mr-5">
          <label class="text-baseText text-sm">決済方法</label>
          <div class="relative w-[128px]">
            <input type="text" class="w-full h-7 border border-border rounded-sm px-2" name="settlement_method" readonly="true" />
          </div>
        </div>
        <div class="mr-5">
          <label class="text-baseText text-sm">伝票拡張付箋</label>
          <div class="relative w-[216px]">
            <select class="w-full h-7 border border-border rounded-sm px-2" name="mt_order_receive_sticky_note_id">
              @foreach ($accountant_default_data['mt_order_receive_sticky_notes'] as $sticky_note)
              <option value="{{ $sticky_note['id'] }}" {{ old('mt_order_receive_sticky_note_id', isset($accountant_default_data['mt_order_receive_sticky_note_id']) ? $accountant_default_data['mt_order_receive_sticky_note_id'] : '') == $sticky_note['id'] ? 'selected' : '' }}>{{ $sticky_note['sticky_note_name'] }}</option>
              @endforeach
            </select>
          </div>
        </div>
      </div>
      <div class="flex mt-3">
        <div class="mr-5">
          <label class="text-required text-sm">得意先<span id="alert-danger-customer"></span></label>
          <div class="flex">
            <div class="relative w-[96px] mr-2">
              <input type="text" class="w-full h-7 border border-border rounded-sm px-2" name="mt_customer_id" id="customer_cd_input" value="{{ old('mt_customer_id', isset($accountant_default_data['mt_customer_id']) ? $accountant_default_data['mt_customer_id'] : '') }}" onblur="blurCodeautoCustomer(arguments[0], this)" />
              <i data-smm-open="search_customer_modal" class="absolute top-[5px] right-2 fa-solid fa-magnifying-glass text-[#B6B6B6]"></i>
            </div>
            <div class="relative w-[256px] mr-2">
                <input type="text" readonly="true" name="customer_name" class="w-full h-7 border border-border rounded-sm px-2" id="customer_name" />
            </div>
            <div class="relative w-[160px]">
                <div class="w-full h-7 border border-border rounded-sm px-2" id="sticky_note_name" ></div>
            </div>
          </div>
          <input type="hidden" name="name_input_kbn" id="name_input_kbn" />
          <input type="hidden" name="delivery_destination_name_input_kbn" id="delivery_destination_name_input_kbn" />
            @if ($errors->has('mt_customer_id'))
            <div class="text-red-500 text-sm">
                {{ $errors->first('mt_customer_id') }}
            </div>
            @endif
        </div>
        <div>
          <label class="text-required text-sm">得意先担当者</label>
          <div class="relative w-[240px]">
            <select class="w-full h-7 border border-border rounded-sm px-2" id="customer_manager" name="mt_user_manager_id" value="{{ old('mt_user_manager_id', isset($accountant_default_data['mt_user_manager_id']) ? $accountant_default_data['mt_user_manager_id'] : '') }}"></select>
          </div>
            @if ($errors->has('mt_manager_id'))
            <div class="text-red-500 text-sm">
                {{ $errors->first('mt_manager_id') }}
            </div>
            @endif
        </div>
      </div>
      <div class="flex mt-3">
        <div class="mr-5">
          <label class="text-baseText text-sm">納品先<span id="alert-danger-delivery-destination"></span></label>
          <div class="flex">
            <div class="relative w-[96px] mr-2">
              <input type="text" class="w-full h-7 border border-border rounded-sm px-2" name="mt_delivery_destination_id" value="{{ old('mt_delivery_destination_id', isset($accountant_default_data['mt_delivery_destination_id']) ? $accountant_default_data['mt_delivery_destination_id'] : '') }}" onblur="blurCodeautoDeliveryDestination(arguments[0], this)" />
              <i class="absolute top-[5px] right-2 fa-solid fa-magnifying-glass text-[#B6B6B6]" data-smm-open="search_delivery_destination_modal"></i>
            </div>
            <div class="relative w-[256px] mr-2">
                <div class="w-full h-7 border border-border rounded-sm px-2" id="delivery_destination_name" ></div>
            </div>
          </div>
            @if ($errors->has('mt_delivery_destination_id'))
            <div class="text-red-500 text-sm">
                {{ $errors->first('mt_delivery_destination_id') }}
            </div>
            @endif
        </div>
        <div class="mr-5">
          <label class="text-baseText text-sm">オーダーNo.</label>
          <div class="relative w-[150px]">
            <input type="text" class="w-full h-7 border border-border rounded-sm px-2" name="order_number" value="{{ old('order_number', isset($accountant_default_data['order_number']) ? $accountant_default_data['order_number'] : '') }}" />
          </div>
        </div>
        <div class="mr-5">
          <label class="text-baseText text-sm">倉庫<span id="alert-danger-warehouse"></span></label>
          <div class="flex">
            <div class="relative w-[96px] mr-2">
              <input type="text" class="w-full h-7 border border-border rounded-sm px-2" id="mt_warehouse_id" name="mt_warehouse_id" onblur="blurCodeAutoWareHouse(arguments[0], this)" value="{{ old('mt_warehouse_id', isset($accountant_default_data['mt_warehouse_id']) ? $accountant_default_data['mt_warehouse_id'] : '') }}" />
              <i class="absolute top-[5px] right-2 fa-solid fa-magnifying-glass text-[#B6B6B6]" data-smm-open="search_warehouse_modal"></i>
            </div>
            <div class="relative min-w-[128px]">
              <div class="w-full h-7 border border-border rounded-sm px-2" id="warehouse_name"></div>
            </div>
          </div>
        </div>
      </div>
      <div class="flex mt-4">
        <div class="mr-[50px]">
          <div class="flex items-center">
            <label class="text-sm text-baseText mr-2">入金口座</label>
            <div class="flex items-center">
              <input type="checkbox" class="mr-2" name="payment_kbn" value="1" {{ old('payment_kbn', isset($accountant_default_data['payment_kbn']) ? $accountant_default_data['payment_kbn'] : '') == '1' ? 'checked' : '' }} />
              <div class="flex items-center justify-content h-7 px-2 rounded-sm bg-[#8BC4FF] text-white text-sm mr-3" onclick="paymentGuidanceShow()">入金案内</div>
              <div class="flex items-center">
                <label class="flex items-center text-sm mr-5">
                  <input class="mr-2" name="payment_guidance_kbn" type="radio" value="0" {{ old('payment_guidance_kbn', isset($accountant_default_data['payment_guidance_kbn']) ? $accountant_default_data['payment_guidance_kbn'] : '0') == '0' ? 'checked' : '' }} />
                  未指定
                </label>
                <label class="flex items-center text-sm mr-5">
                  <input class="mr-2" name="payment_guidance_kbn" type="radio" value="1" {{ old('payment_guidance_kbn', isset($accountant_default_data['payment_guidance_kbn']) ? $accountant_default_data['payment_guidance_kbn'] : '') == '1' ? 'checked' : '' }} />
                  一部
                </label>
                <label class="flex items-center text-sm mr-5">
                  <input class="mr-2" name="payment_guidance_kbn" type="radio" value="2" {{ old('payment_guidance_kbn', isset($accountant_default_data['payment_guidance_kbn']) ? $accountant_default_data['payment_guidance_kbn'] : '') == '2' ? 'checked' : '' }} />
                  全て
                </label>
                <label class="flex items-center text-sm">
                  <input class="mr-1" type="checkbox" readonly id="payment_guidance_flg" value="1" name="payment_guidance_flg" {{ old('payment_guidance_flg', isset($accountant_default_data['payment_guidance_flg']) ? $accountant_default_data['payment_guidance_flg'] : '') == '1' ? 'checked' : '' }} />
                  済
                </label>
              </div>
            </div>
          </div>
          @if ($errors->has('payment_kbn'))
          <div class="text-red-500 text-sm">
            {{ $errors->first('payment_kbn') }}
          </div>
          @endif
          @if ($errors->has('payment_guidance_kbn'))
          <div class="text-red-500 text-sm">
            {{ $errors->first('payment_guidance_kbn') }}
          </div>
          @endif
          @if ($errors->has('payment_guidance_flg'))
          <div class="text-red-500 text-sm">
            {{ $errors->first('payment_guidance_flg') }}
          </div>
          @endif
        </div>
        <div class="mr-[50px]">
          <div class="flex items-center">
            <div class="flex items-center justify-content h-7 px-2 rounded-sm bg-[#8BC4FF] text-white text-sm mr-2" onclick="shortageGuidanceDownload()">欠品案内</div>
            <label class="flex items-center text-sm">
              <input class="mr-1" type="checkbox" id="shortage_guidance_flg" value="1" name="shortage_guidance_flg" {{ old('shortage_guidance_flg', isset($accountant_default_data['shortage_guidance_flg']) ? $accountant_default_data['shortage_guidance_flg'] : '') == 1 ? 'checked' : '' }} readonly />
              済
            </label>
          </div>
          @if ($errors->has('shortage_guidance_flg'))
          <div class="text-red-500 text-sm">
            {{ $errors->first('shortage_guidance_flg') }}
          </div>
          @endif
        </div>
        <div class="mr-[50px]">
          <div class="flex items-center">
            <div class="flex items-center justify-content h-7 px-2 rounded-sm bg-[#8BC4FF] text-white text-sm mr-2" onclick="shippingGuidanceDownload()">出荷案内</div>
            <label class="flex items-center text-sm">
              <input class="mr-1" type="checkbox" id="shipping_guidance_flg" value="1" name="shipping_guidance_flg" readonly {{ old('shipping_guidance_flg', isset($accountant_default_data['shipping_guidance_flg']) ? $accountant_default_data['shipping_guidance_flg'] : '') == 1 ? 'checked' : '' }} />
              済
            </label>
          </div>
          @if ($errors->has('shipping_guidance_flg'))
          <div class="text-red-500 text-sm">
            {{ $errors->first('shipping_guidance_flg') }}
          </div>
          @endif
        </div>
        <div class="mr-[50px]">
          <div class="flex items-center">
            <div class="flex items-center justify-content h-7 px-2 rounded-sm bg-[#8BC4FF] text-white text-sm mr-2" onclick="keepGuidanceDownload()">KEEP案内</div>
            <label class="flex items-center text-sm mr-2">
              <input class="mr-1" type="checkbox" name="keep_guidance_target_flg" value="1" {{ old('keep_guidance_target_flg', isset($accountant_default_data['keep_guidance_target_flg']) ? $accountant_default_data['keep_guidance_target_flg'] : '') == 1 ? 'checked' : '' }} />
              対象
            </label>
            <label class="flex items-center text-sm mr-2">
              <input class="mr-1" type="checkbox" name="keep_guidance_flg" id="keep_guidance_flg" readonly value="1" {{ old('keep_guidance_flg', isset($accountant_default_data['keep_guidance_flg']) ? $accountant_default_data['keep_guidance_flg'] : '') ? 'checked' : '' }} />
              済
            </label>
            <label class="flex items-center text-sm">
              <input class="mr-1" type="checkbox" name="keep_guidance_expiration_flg" value="1" {{ old('keep_guidance_expiration_flg', isset($accountant_default_data['keep_guidance_expiration_flg']) ? $accountant_default_data['keep_guidance_expiration_flg'] : '') == 1 ? 'checked' : '' }} />
              期限切
            </label>
          </div>
          @if ($errors->has('keep_guidance_target_flg'))
          <div class="text-red-500 text-sm">
            {{ $errors->first('keep_guidance_target_flg') }}
          </div>
          @endif
          @if ($errors->has('keep_guidance_flg'))
          <div class="text-red-500 text-sm">
            {{ $errors->first('keep_guidance_flg') }}
          </div>
          @endif
          @if ($errors->has('keep_guidance_expiration_flg'))
          <div class="text-red-500 text-sm">
            {{ $errors->first('keep_guidance_expiration_flg') }}
          </div>
          @endif
        </div>
      </div>
      <div class="flex mt-3 items-end">
        <div class="flex items-center mr-10 pb-1">
          <label class="text-baseText text-sm">処理：</label>
          <div class="flex items-center">
            <label class="text-sm flex items-center mr-5">
              <input type="radio" class="mr-2" name="process_kbn" value="0" {{ old('process_kbn', isset($accountant_default_data['process_kbn']) ? $accountant_default_data['process_kbn'] : '0') == 0 ? 'checked' : '' }} />
              なし
            </label>
            <label class="text-sm flex items-center mr-5">
              <input type="radio" class="mr-2" name="process_kbn" value="1" {{ old('process_kbn', isset($accountant_default_data['process_kbn']) ? $accountant_default_data['process_kbn'] : '') == 1 ? 'checked' : '' }} />
              未確定（ピッキング対象外）
            </label>
            <label class="text-sm flex items-center mr-5">
              <input type="radio" class="mr-2" name="process_kbn" value="2" {{ old('process_kbn', isset($accountant_default_data['process_kbn']) ? $accountant_default_data['process_kbn'] : '') == 2 ? 'checked' : '' }} />
              揃出
            </label>
            <label class="text-sm flex items-center mr-5">
              <input type="radio" class="mr-2" name="process_kbn" value="3" {{ old('process_kbn', isset($accountant_default_data['process_kbn']) ? $accountant_default_data['process_kbn'] : '') == 3 ? 'checked' : '' }} />
              有出無銭
            </label>
            <label class="text-sm flex items-center">
              <input type="radio" class="mr-2" name="process_kbn" value="4" {{ old('process_kbn', isset($accountant_default_data['process_kbn']) ? $accountant_default_data['process_kbn'] : '') == 4 ? 'checked' : '' }} />
              他
            </label>
          </div>
        </div>
        <div class="mr-10 element-form flex flex-col items-start">
          <label class="text-baseText text-sm">指定納期</label>
          <div class="flex items-center">
            <div class="frame mr-2" style="margin-left: 0">
              <div class="textbox">
                <input type="text" id="release_start_datetime-year"
                       class="element textbox_40px" minlength="0" maxlength="4">年
                <input type="text" id="release_start_datetime-month"
                       class="element textbox_24px" minlength="0" maxlength="2">月
                <input type="text" id="release_start_datetime-date"
                       class="element textbox_24px" minlength="0" maxlength="2">日
                <img src="/img/icon/calender.svg" onclick="onOpenCalendar('release_start_datetime')">
              </div>
            </div>
            <div class="flex items-center justify-content h-7 px-2 rounded-sm bg-[#8BC4FF] text-white text-sm mr-3" onclick="applyReleaseStartDate()">適　用</div>
          </div>
        </div>
      </div>
    </div>
    <div class="mt-5 overflow-x-auto">
      <table class="min-w-full border-collapse">
        <thead class="bg-[#3A5A9B] text-white">
          <tr>
            <th class="p-1 border border-gray-300 text-sm" rowspan="2">N0.</th>
            <th class="p-1 border border-gray-300 text-sm">商品区分</th>
            <th class="p-1 border border-gray-300 text-sm">商品コード</th>
            <th class="p-1 border border-gray-300 text-sm">課税</th>
            <th class="p-1 border border-gray-300 text-sm">掛率</th>
            <th class="p-1 border border-gray-300 text-sm" colspan="2">上代単価</th>
            <th class="p-1 border border-gray-300 text-sm">受注単価</th>
            <th class="p-1 border border-gray-300 text-sm">受注金額</th>
            <th class="p-1 border border-gray-300 text-sm" rowspan="2">
              <div class="flex items-center pl-3 justify-center">
                <div class="mr-8">指定納期</div>
                <div>
                  <div class="flex items-center justify-content px-3 h-6 text-[10px] bg-[#1483F8] rounded-sm mb-1">全完了</div>
                  <div>受注完了</div>
                </div>
              </div>
            </th>
            <th class="p-1 border border-gray-300 text-sm" rowspan="2">備考</th>
            <th class="p-1 border border-gray-300 text-sm w-[100px]" rowspan="2" colspan="2"></th>
            <th class="w-[32px] bg-white" rowspan="2"></th>
          </tr>
          <tr>
            <th class="p-1 border border-gray-300 text-sm" colspan="3">商品名</th>
            <th class="p-1 border border-gray-300 text-sm">単位</th>
            <th class="p-1 border border-gray-300 text-[10px]">受注数</th>
            <th class="p-1 border border-gray-300 text-[10px]">売上<br/>確定</th>
            <th class="p-1 border border-gray-300 text-sm">粗利用単価</th>
            <th class="p-1 border border-gray-300 text-[10px]">粗利用<br/>原価金額</th>
          </tr>
        </thead>
        <tbody id="table_body">
          @foreach (old('details', isset($accountant_default_data['details']) ? $accountant_default_data['details'] : $default_details) as $key => $detail)
            <tr id="table_row_1" class="item_cd_search_row">
              <td class="border border-tableBorder text-center px-2 text-sm detail_id" rowspan="2">{{ $detail['order_receive_detail_cd'] }}</td>
              <input type="hidden" name="details[{{$key}}][order_receive_detail_cd]" class="order_receive_detail_cd" value="{{ $detail['order_receive_detail_cd'] }}" />
              <input type="hidden" name="details[{{$key}}][order_line_no]" class="order_line_no" value="{{ $key + 1 }}" />
              <td class="border border-tableBorder px-2 w-[120px]">
                <select class="border border-border w-[100px] h-7 rounded-sm text-sm item_kbn" name="details[{{$key}}][item_kbn]" onchange="itemKbnChange(this)">
                  <option value="0" {{ $detail['item_kbn'] == "0" ? 'selected' : '' }}>商品</option>
                  <option value="1" {{ $detail['item_kbn'] == "1" ? 'selected' : '' }}>製品</option>
                  <option value="2" {{ $detail['item_kbn'] == "2" ? 'selected' : '' }}>部品</option>
                  <option value="4" {{ $detail['item_kbn'] == "4" ? 'selected' : '' }}>運賃</option>
                  <option value="6" {{ $detail['item_kbn'] == "6" ? 'selected' : '' }}>値引</option>
                </select>
              </td>
              <td class="border border-tableBorder px-2 text-sm w-[120px]">
                <div class="relative w-full">
                  <input type="text" class="w-full h-7 border border-border rounded-sm px-2 item_cd" name="details[{{$key}}][item_cd]" value="{{ $detail['item_cd'] }}" minlength="0" maxlength="8" onblur="blurItemCdChange(arguments[0], this)" />
                  <i class="absolute top-[7px] right-2 fa-solid fa-magnifying-glass text-[#B6B6B6] item_cd_search_btn" data-smm-open="search_item_cd_modal"></i>
                </div>
              </td>
              <td class="border border-tableBorder px-2 text-sm non_tax_kbn"></td>
              <td class="border border-tableBorder px-2 text-sm">
                <div class="w-[48px]">
                  <input type="text" class="w-full h-7 px-2 item_cd price_rate_input" name="details[{{$key}}][price_rate]" value="{{ $detail['price_rate'] }}" min="0" max="100" onblur="blurPriceRate(arguments[0], this)" />
                </div>
              </td>
              <td class="border border-tableBorder px-2 text-sm" colspan="2">
                <div>
                  <input type="text" class="w-full h-7 px-2 item_cd retail_price_tax" name="details[{{$key}}][retail_price]" value="{{ $detail['retail_price'] }}" />
                </div>
              </td>
              <td class="border border-tableBorder px-2 text-sm">
                <div>
                  <input type="text" class="w-full h-7 px-2 item_cd order_receive_price" name="details[{{$key}}][order_receive_price]" value="{{ $detail['order_receive_price'] }}" onblur="orderReceivePriceChange(arguments[0], this)" />
                </div>
              </td>
              <td class="border border-tableBorder px-2 text-sm">
                <div>
                  <input type="text" class="w-full h-7 px-2 item_cd order_receive_amount" name="details[{{$key}}][order_receive_amount]" value="{{ $detail['order_receive_amount'] }}" readonly="true" onchange="orderReceivePriceChange(arguments[0], this)" onblur="orderReceivePriceChange(arguments[0], this)" />
                </div>
              </td>
              <td class="border border-tableBorder px-2 text-sm" rowspan="2">
                <div class="element-form">
                  <div class="frame" style="margin-left: 0; display: block;">
                    <div class="textbox" style="border: 0;">
                      <input type="text" id="calendar3-year" name="details[{{$key}}][release_start_datetime_year]"
                             class="element textbox_40px release_start_datetime_year_with_td" minlength="0" maxlength="4" value="{{ $detail['release_start_datetime_year'] }}">年
                      <input type="text" id="calendar3-month" name="details[{{$key}}][release_start_datetime_month]"
                             class="element textbox_24px release_start_datetime_month_with_td" minlength="0" maxlength="2" value="{{ $detail['release_start_datetime_month'] }}">月
                      <input type="text" id="calendar3-date" name="details[{{$key}}][release_start_datetime_day]"
                             class="element textbox_24px release_start_datetime_day_with_td" minlength="0" maxlength="2" value="{{ $detail['release_start_datetime_day'] }}">日
                      <img src="/img/icon/calender.svg" onclick="onOpenCalendar('calendar3')">
                    </div>
                    <div class="flex items-center mt-1">
                      <label class="text-sm mr-2"><input type="checkbox" class="mr-1 specify_deadline_none_flg" name="details[{{$key}}][specify_deadline_none_flg]" value="1" {{ isset($detail['specify_deadline_none_flg']) && $detail['specify_deadline_none_flg'] == 1 ? 'checked' : '' }} />予定なし</label>
                      <select class="border border-border rounded-sm ml-auto order_receive_finish_flg" name="details[{{$key}}][order_receive_finish_flg]">
                        <option value="0" {{ $detail['order_receive_finish_flg'] == '0' ? 'selected' : (!isset($detail['order_receive_finish_flg']) ? 'selected' : '') }}>未完</option>
                        <option value="1" {{ $detail['order_receive_finish_flg'] == '1' ? 'selected' : '' }}>完了</option>
                      </select>
                    </div>
                  </div>
                </div>
              </td>
              <td class="border border-tableBorder px-2 text-sm">
                <div>
                  <input type="text" class="w-full h-7 px-2 item_cd memo_1" name="details[{{$key}}][memo_1]" value="{{ $detail['memo_1'] }}" />
                </div>
              </td>
              <td class="border border-tableBorder px-2 text-sm" rowspan="2">
                <div>
                  <label class="flex items-center text-sm">
                    <input class="mr-1 shortage_flg" type="checkbox" value="1" name="details[{{$key}}][shortage_flg]" {{ isset($detail['shortage_flg']) && $detail['shortage_flg'] == 1 ? 'checked' : '' }} />
                    欠品
                  </label>
                  <label class="flex items-center text-sm">
                    <input class="mr-1 remaining_flg" type="checkbox" value="1" name="details[{{$key}}][remaining_flg]" {{ isset($detail['remaining_flg']) && $detail['remaining_flg'] == 1 ? 'checked' : '' }} />
                    残
                  </label>
                  <label class="flex items-center text-sm">
                    <input class="mr-1 payment_finish_flg" type="checkbox" value="1" name="details[{{$key}}][payment_finish_flg]" {{ isset($detail['payment_finish_flg']) && $detail['payment_finish_flg'] == 1 ? 'checked' : '' }} />
                    入金済
                  </label>
                </div>
              </td>
              <td class="border border-tableBorder px-2 text-xs" rowspan="2">
                <div onclick="showDetailExtensionItem()">明細<br/>拡張</div>
              </td>
              <td class="border border-tableBorder p-2 text-sm" rowspan="2">
                <div class="text-center border border-border bg-[#F9F9F9] text-[10px] w-[20px]" onclick="deleteTableRow(this)" style="text-orientation: upright;">行削除</div>
              </td>
            </tr>
            <tr id="table_row_2">
              <td class="border border-tableBorder px-2 text-sm" colspan="3">
                <div class="w-[200px]">
                  <input type="text" class="w-full h-7 px-2 item_cd item_name text-[#1170C7]" name="details[{{$key}}][item_name]" value="{{ $detail['item_name'] }}" />
                </div>
              </td>
              <td class="border border-tableBorder px-2 text-sm unit"></td>
              <td class="border border-tableBorder px-2 text-sm">
                <div class="w-[48px]">
                  <input type="text" class="w-full h-7 px-2 item_cd order_receive_quantity {{ $errors->has('details.'.$key.'.order_receive_quantity') ? 'border-red-500 border' : '' }}" readonly onclick="showOrderBreakdownModal(this)" name="details[{{$key}}][order_receive_quantity]" value="{{ $detail['order_receive_quantity'] }}" onblur="orderReceiveQuantityChange(arguments[0], this)" />
                </div>
              </td>
              <td class="border border-tableBorder px-2 text-sm">済み</td>
              <td class="border border-tableBorder px-2 text-sm">
                <div>
                  <input type="text" class="w-full h-7 px-2 item_cd profit_calculation_cost_price" name="details[{{$key}}][cost_price]" value="{{ $detail['cost_price'] }}" />
                </div>
              </td>
              <td class="border border-tableBorder px-2 text-sm">
                <div>
                  <input type="text" class="w-full h-7 px-2 item_cd cost_amount" name="details[{{$key}}][cost_amount]" readonly="true" value="{{ $detail['cost_amount'] }}" }}" />
                </div>
              </td>
              <td class="border border-tableBorder px-2 text-sm">
                <div>
                  <input type="text" class="w-full h-7 px-2 item_cd memo_2" name="details[{{$key}}][memo_2]" value="{{ $detail['memo_2'] }}" />
                </div>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
      <div class="flex mt-3">
        <div class="pl-1">
          <a class="flex items-center text-sm text-active cursor-pointer" id="table_row_append_btn"><i class="fa-solid fa-plus mr-1"></i>明細の行を追加する</a>
        </div>
        <div class="flex ml-auto p-[6px] bg-[#F9F9F9] border-b border-[#DDDDDD] mt-2">
          <div class="flex items-center mr-10">
            <label class="text-sm mr-5">送料</label>
            <div class="text-base">
                <input type="text" readonly id="total_postage" name="postage" value="{{ old('postage', isset($accountant_default_data['postage']) ? $accountant_default_data['postage'] : '') }}" class="bg-transparent w-[100px]" />
            </div>
          </div>
          <div class="flex items-center mr-10">
            <label class="text-sm mr-5">数量</label>
            <div class="text-base">
                <input type="text" readonly id="total_order_receive_quantity" name="quantity_total" value="{{ old('quantity_total', isset($accountant_default_data['quantity_total']) ? $accountant_default_data['quantity_total'] : '') }}" class="bg-transparent w-[100px]" />
            </div>
          </div>
          <div class="flex items-center mr-6">
            <label class="text-sm mr-5">合計金額</label>
            <div class="text-base">
                <input type="text" readonly id="total_order_receive_amount" name="amount_total" value="{{ old('amount_total', isset($accountant_default_data['amount_total']) ? $accountant_default_data['amount_total'] : '') }}" class="bg-transparent w-[100px]" />
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="mt-5">
      <div class="flex items-center">
        <div class="mr-5">
          <label class="text-sm">伝票備考</label>
          <div>
            <input type="text" class="w-[370px] border border-border rounded-sm h-7" name="slip_memo" value="{{ old('slip_memo', isset($accountant_default_data['slip_memo']) ? $accountant_default_data['slip_memo'] : '') }}" maxlength="40" />
          </div>
        </div>
        <div class="mr-5">
          <label class="text-sm">得意先発注番号</label>
          <div>
            <input type="text" class="w-[280px] border border-border rounded-sm h-7" name="customer_order_number" value="{{ old('customer_order_number', isset($accountant_default_data['customer_order_number']) ? $accountant_default_data['customer_order_number'] : '') }}" maxlength="30" />
          </div>
        </div>
        <div>
          <label class="text-sm">別便</label>
          <div>
            <input type="text" class="w-[280px] border border-border rounded-sm h-7" name="separate_mail" value="{{ old('separate_mail', isset($accountant_default_data['separate_mail']) ? $accountant_default_data['separate_mail'] : '') }}" maxlength="30" />
          </div>
        </div>
      </div>
      <div class="flex items-center mt-2">
        <div class="mr-5">
          <label class="text-sm">送り状記載必要欄</label>
          <div>
            <input type="text" class="w-[370px] border border-border rounded-sm h-7" name="shipping_document_description_need_column" value="{{ old('shipping_document_description_need_column', isset($accountant_default_data['shipping_document_description_need_column']) ? $accountant_default_data['shipping_document_description_need_column'] : '') }}" maxlength="30" />
          </div>
        </div>
        <div class="flex-1">
          <label class="text-sm">業務メモ</label>
          <div>
            <input type="text" class="w-full border border-border rounded-sm h-7" name="business_memo" value="{{ old('business_memo', isset($accountant_default_data['business_memo']) ? $accountant_default_data['business_memo'] : '') }}" maxlength="80" />
          </div>
        </div>
      </div>
    </div>
  </div>
</form>

<div id="errorModal" class="fixed inset-0 bg-gray-900 bg-opacity-50 flex items-center justify-center" style="display: none; z-index: 9003;">
    <div class="bg-white rounded-lg shadow-lg w-3/4 md:w-1/2 lg:w-1/3 p-6">
        <div class="flex justify-end items-center">
            <span class="close cursor-pointer text-gray-500 text-2xl">&times;</span>
        </div>
        <div class="modal-body mt-4">
            <!-- セッションからエラーメッセージを表示 -->
            @if ($errors->any())
            <ul class="mt-0">
                @foreach ($errors->all() as $error)
                <li class="flex text-base" style="list-style: none;"><span class="mr-[6px]"><img src="/img/icon/error.svg" /></span>{{ $error }}</li>
                @endforeach
            </ul>
            @endif
        </div>
        <div class="flex justify-end mt-3">
            <button class="close w-[112px] h-8 text-sm text-[#2D3842] border border-[#D0DFE4] rounded">はい</button>
        </div>
    </div>
</div>

<div id="confirmModal" class="fixed inset-0 bg-gray-900 bg-opacity-50 flex items-center justify-center" style="display: none; z-index: 9003;">
    <div class="bg-white rounded-lg shadow-lg w-3/4 md:w-1/2 lg:w-1/3 p-6">
        <div class="flex justify-end items-center">
            <span class="close cursor-pointer text-gray-500 text-2xl">&times;</span>
        </div>
        <div class="modal-body mt-4">
            <!-- セッションからエラーメッセージを表示 -->
            @if ($errors->any())
            <ul class="mt-0">
                @foreach ($errors->all() as $error)
                <li class="flex text-base" style="list-style: none;"><span class="mr-[6px]"><img src="/img/icon/error.svg" /></span>{{ $error }}</li>
                @endforeach
            </ul>
            @endif
        </div>
        <div class="flex justify-end mt-3">
            <button class="close w-[112px] h-8 text-sm text-[#2D3842] border border-[#D0DFE4] rounded mr-4">いいえ</button>
            <button class="submit w-[112px] h-8 text-sm bg-[#1483F8] text-white rounded">はい</button>
        </div>
    </div>
</div>

<div id="commissionAutoModal" class="fixed inset-0 bg-gray-900 bg-opacity-50 flex items-center justify-center" style="display: none; z-index: 9003;">
    <div class="bg-white rounded-lg shadow-lg w-3/4 md:w-1/2 lg:w-1/3 p-6">
        <div class="flex justify-end items-center">
            <span class="close cursor-pointer text-gray-500 text-2xl">&times;</span>
        </div>
        <div class="modal-body mt-4">
            <!-- セッションからエラーメッセージを表示 -->
            @if ($errors->any())
            <ul class="mt-0">
                @foreach ($errors->all() as $error)
                <li class="flex text-base" style="list-style: none;"><span class="mr-[6px]"><img src="/img/icon/error.svg" /></span>{{ $error }}</li>
                @endforeach
            </ul>
            @endif
        </div>
        <div class="flex justify-end mt-3">
            <button class="close w-[112px] h-8 text-sm text-[#2D3842] border border-[#D0DFE4] rounded mr-4">いいえ</button>
            <button class="submit w-[112px] h-8 text-sm bg-[#1483F8] text-white rounded">はい</button>
        </div>
    </div>
</div>

@include('admin.master.search.order_receive_header')
@include('admin.master.search.manager')
@include('admin.master.search.customer')
@include('admin.master.search.delivery_destination')
@include('admin.master.search.warehouse')
@include('admin.sales.trn_order_receive_header.partialDepositInformationModal')
@include('admin.master.search.item_cd')
@include('admin.master.search.brand1')
@include('admin.master.search.game_category')
@include('admin.master.search.genre')
@include('admin.master.search.item_class_thing4')
@include('admin.master.search.item_class_thing5')
@include('admin.master.search.item_class_thing6')
@include('admin.master.search.item_class_thing7')
@include('admin.master.search.ps_kbn')
@include('admin.sales.trn_order_receive_header.orderBreakdown')
@include('admin.sales.trn_order_receive_header.stockQuantityBySizeByColor')
@include('admin.sales.trn_order_receive_header.extendedItemInput')
@include('admin.sales.trn_order_receive_header.detailExtensionItemModal')
@include('admin.sales.trn_order_receive_header.referenceMenu')

@endsection
