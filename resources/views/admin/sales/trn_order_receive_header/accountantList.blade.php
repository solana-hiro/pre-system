@extends('layouts.admin.app')
@section('page_title', '受注リスト')
@section('title', '受注リスト')
@section('description', '')
@section('keywords', '')
@section('canonical', '')
@section('blade_script')
<script src="{{ asset('/js/calendar.js') }}"></script>
<script src="{{ asset('js/sales/trn_order_receive_header/accountantList.js') }}"></script>
@endsection
@section('content')
    @include('admin.common.calendar', ['calendarId' => 'deadline'])
    @include('admin.common.calendar', ['calendarId' => 'order_date_from'])
    @include('admin.common.calendar', ['calendarId' => 'order_date_to'])
    @include('admin.common.calendar', ['calendarId' => 'deadline_from'])
    @include('admin.common.calendar', ['calendarId' => 'deadline_to'])
	<div class="main-area">
		<div class="button_area">
			<div class="div">
				<button class="button" onclick="initialize()"><div class="text_wrapper">キャンセル</div></button>
				<button class="button" onclick="clearAllCheckbox()"><div class="text_wrapper">全クリア</div></button>
				<button class="div-wrapper" onclick="clickAllCheckbox()"><div class="text_wrapper_2">全選択</div></button>
				<button class="div-wrapper" form="accountantListSearchForm" type="submit" name="search"><div class="text_wrapper_2">表示する</div></button>
				<button class="div-wrapper" {{ $permission['auth_print_flg'] != 1 }}><div class="text_wrapper_2">Excelへ出力</div></button>
				<button class="button-2" form="updateForm" type="submit" {{ $permission['auth_register_flg'] != 1 }}><div class="text_wrapper_3">登録する</div></button>
			</div>
    	</div>

        @include('admin.sales.trn_order_receive_header.constrictedExtractionCondition')
        <form method="POST" id="updateForm" action="{{ route('sales_management.order_receive.accountant.list.update') }}">
    	<div class="box">
			<div class="group">
				<div class="element_row">
					<div class="frame">
					    <div class="text_wrapper">処理：</div>
						<div class="div">
							<label class="text_wrapper_2">
								<input type="radio" id="" name="kbn" value="0" checked onclick="selectKbn(0)" />
								EC受注チェック
							</label>
						</div>
						<div class="div">
							<label class="text_wrapper_2">
								<input type="radio" id="" name="kbn" value="1" onclick="selectKbn(1)" />
								出荷準備
							</label>
						</div>
						<div class="div">
							<label class="text_wrapper_2">
								<input type="radio" id="" name="kbn" value="2" onclick="selectKbn(2)" />
								納品確定
							</label>
						</div>
					</div>
					<div class="element-form">
						<div class="text_wrapper">準備対象納期</div>
						<div class="textbox">
						    <input type="text" id="deadline-year" name="name" class="element textbox_40px" minlength="0" maxlength="4" value="{{ date("Y") }}">年
						    <input type="text" id="deadline-month" name="name" class="element textbox_24px" minlength="0" maxlength="2" value="{{ date("m") }}">月
						    <input type="text" id="deadline-date" name="name" class="element textbox_24px" minlength="0" maxlength="2" value="{{ date("d") }}">日
						    <img id="deadline-calendar-btn" src="/img/icon/calender.svg" onclick="onOpenCalendar('deadline')">
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="grid">
			<table>
				<thead class="grid_header">
					<tr>
                        <td class="grid_wrapper_center td_2p">No.</td>
                        <td class="grid_wrapper_center td_5p">受注No.</td>
                        <td class="grid_wrapper_center td_10p">EC注文番号</td>
                        <td class="grid_wrapper_center td_5p">受注日</td>
                        <td class="grid_wrapper_center td_5p">得意先コード</td>
                        <td class="grid_wrapper_center td_15p">得意先名</td>
                        <td class="grid_wrapper_center td_5p">納品コード</td>
                        <td class="grid_wrapper_center td_15p">納品先名</td>
                        <td class="grid_wrapper_center td_5p kbn_2">入金区分</td>
                        <td class="grid_wrapper_center td_5p kbn_2">付箋</td>
                        <td class="grid_wrapper_center td_20p kbn_2">付箋名</td>
                        <td class="grid_wrapper_center td_5p kbn_1 kbn_2">出荷区分</td>
						<td class="grid_wrapper_center td_30p">伝票備考</td>
                        <td class="grid_wrapper_center td_20p kbn_1 kbn_2">得意先発注番号</td>
                        <td class="grid_wrapper_center td_20p kbn_2">別便（有料便）</td>
                        <td class="grid_wrapper_center td_10p kbn_2">与信額超過</td>
                        <td class="grid_wrapper_center td_5p">ECチェック済</td>
                        <td class="grid_wrapper_center td_10p">処理区分</td>
                        <td class="grid_wrapper_center td_5p kbn_0 kbn_1">納品先確認選択</td>
                        <td class="grid_wrapper_center td_5p kbn_0">自採納品処理済</td>
                        <td class="grid_wrapper_center td_5p kbn_0 kbn_2">出荷準備選択</td>
                        <td class="grid_wrapper_center td_5p kbn_0">準備</td>
                        <td class="grid_wrapper_center td_5p kbn_0 kbn_2">ピッキング</td>
                        <td class="grid_wrapper_center td_5p kbn_0 kbn_2">検品</td>
                        <td class="grid_wrapper_center td_5p kbn_0 kbn_2">売伝</td>
                        <td class="grid_wrapper_center td_5p kbn_0 kbn_2">日本郵政連携</td>
					</tr>
				</thead>
				<tbody class="grid_body">
          @foreach($orders as $index => $order)
            <tr>
                <input type="hidden" name="orders[{{$index}}][order_id]" value="{{ $order->id }}" />
              <td class="grid_wrapper_center td_2p">{{ $index + 1 }}</td>
              <td class="grid_wrapper_center td_5p">{{ $order['order_receive_number'] }}</td>
              <td class="grid_wrapper_center td_10p">{{ $order['ec_order_receive_number'] }}</td>
              <td class="grid_wrapper_center td_5p">{{ $order['order_receive_date'] }}</td>
              <td class="grid_wrapper_center td_5p">{{ $order['mtCustomer']['customer_cd'] }}</td>
              <td class="grid_wrapper_center td_15p">{{ $order['mtCustomer']['customer_name'] }}</td>
              <td class="grid_wrapper_center td_5p">{{ is_null($order['mtDeliveryDestination']) ? '' : $order['mtDeliveryDestination']['delivery_destination_id'] }}</td>
              <td class="grid_wrapper_center td_15p">{{ is_null($order['mtDeliveryDestination']) ? '' : $order['mtDeliveryDestination']['delivery_destination_name'] }}</td>
              <td class="grid_wrapper_center td_5p kbn_2">{{ is_null($order['mtCustomer']) ? '' : ($order['mtCustomer']['payment_kbn'] == 1 ? '掛売' : '入金後') }}</td>
              <td class="grid_wrapper_center td_5p kbn_2">{{ is_null($order['mtOrderReceiveStickyNote']) ? '' : $order['mtOrderReceiveStickyNote']['sticky_note_color'] }}</td>
              <td class="grid_wrapper_center td_20p kbn_2">{{ is_null($order['mtOrderReceiveStickyNote']) ? '' : $order['mtOrderReceiveStickyNote']['sticky_note_name'] }}</td>
              <td class="grid_wrapper_center td_5p kbn_1 kbn_2">{{ $order['shipping_kbn_name'] }}</td>
              <td class="grid_wrapper_center td_30p">{{$order['slip_memo']}}</td>
              <td class="grid_wrapper_center td_20p kbn_1 kbn_2">{{$order['customer_order_number']}}</td>
              <td class="grid_wrapper_center td_20p kbn_2">{{$order['separate_mail']}}</td>
              <td class="grid_wrapper_center td_10p kbn_2">{{$order['limitAmount']}}</td>
              <td class="grid_wrapper_center td_5p">
                <input type="checkbox" class="ec_check_flg" name="orders[{{$index}}][ec_check_flg]" value="1" {{ $order['ec_order_receive_check_flg'] == 1 ? 'checked' : '' }} />
              </td>
              <td class="grid_wrapper_center td_10p">{{$order['processKbnName']}}</td>
              <td class="grid_wrapper_center td_5p kbn_0 kbn_1">
                <input type="checkbox" class="destination_check_flg" name="orders[{{$index}}][destination_check_flg]" value="1" {{ $order['ec_order_receive_check_flg'] == 1 ? 'checked' : '' }} />
              </td>
              <td class="grid_wrapper_center td_5p kbn_0">{{ $order['delivery_destination_check_flg'] == 0 ? '' : '済' }}</td>
              <td class="grid_wrapper_center td_5p kbn_0 kbn_2">
                <input type="checkbox" class="shipping_check_flg" name="orders[{{$index}}][shipping_check_flg]" value="1" {{ $order['ec_order_receive_check_flg'] == 1 ? 'checked' : '' }} />
              </td>
              <td class="grid_wrapper_center td_5p kbn_0">{{$order['shippingPreparationFlg']}}</td>
              <td class="grid_wrapper_center td_5p kbn_0 kbn_2">{{ $order['pickingListOutput'] }}</td>
              <td class="grid_wrapper_center td_5p kbn_0 kbn_2">{{ $order['checkStatus'] }}</td>
              <td class="grid_wrapper_center td_5p kbn_0 kbn_2">{{ $order['salesDetailStatus'] }}</td>
              <td class="grid_wrapper_center td_5p kbn_0 kbn_2">{{ $order['totalPickingListOutput'] }}</td>
					  </tr>
          @endforeach
				</tbody>
			</table>
		</div>
        </form>
	</div>

@include('admin.master.search.order_receive_header')
@include('admin.master.search.manager')
@include('admin.master.search.customer')
@include('admin.master.search.delivery_destination')
@include('admin.master.search.root')

@endsection
