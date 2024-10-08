@extends('layouts.admin.file')
@section('page_title', '一覧表')
@section('title', '一覧表')
@section('content')

<table>
    <thead>
		<tr>
            <th style="text-align:left;">出力対象：</th>
            <th style="text-align:left;">{{ $params['target'] }}</th>
        </tr>
		<tr>
            <th style="text-align:left;">対象日付：</th>
            <th style="text-align:left;">{{ $params['startDate'] }}</th>
            <th style="text-align:left;">～</th>
            <th style="text-align:left;">{{ $params['endDate'] }}</th>
        </tr>
        <tr>
            <th style="text-align:left;">カラーコード範囲：</th>
            <th style="text-align:left;">{{ $params['startColorCode'] }}</th>
            <th style="text-align:left;">～</th>
            <th style="text-align:left;">{{ $params['endColorCode'] }}</th>
        </tr>
        <tr>
            <th style="text-align:left;">サイズコード範囲：</th>
            <th style="text-align:left;">{{ $params['startSizeCode'] }}</th>
            <th style="text-align:left;">～</th>
            <th style="text-align:left;">{{ $params['endSizeCode'] }}</th>
        </tr>
        <tr>
            <th style="text-align:left;">倉庫コード範囲：</th>
            <th style="text-align:left;">{{ $params['startWarehouseCode'] }}</th>
            <th style="text-align:left;">～</th>
            <th style="text-align:left;">{{ $params['endWarehouseCode'] }}</th>
        </tr>
        <tr>
            <th style="text-align:left;">処理日：</th>
            <th style="text-align:left;">{{ $params['currentDate'] }}</th>
        </tr>
        <tr></tr>
        <tr>
			<th style="text-align:left;">商品コード</th>
			<th style="text-align:left;">商品名</th>
			<th style="text-align:left;">カラーコード</th>
			<th style="text-align:left;">カラー名</th>
			<th style="text-align:left;">サイズコード</th>
			<th style="text-align:left;">サイズ名</th>
			<th style="text-align:left;">指定納期</th>
			<th style="text-align:left;">発注数量</th>
			<th style="text-align:left;">受注数量</th>
			<th style="text-align:left;">在庫予定数</th>
			<th style="text-align:left;">受発注No</th>
			<th style="text-align:left;">行No</th>
			<th style="text-align:left;">受発注日付</th>
			<th style="text-align:left;">取引先コード</th>
			<th style="text-align:left;">取引先名</th>
			<th style="text-align:left;">オーダーNo</th>
			<th style="text-align:left;">倉庫コード</th>
			<th style="text-align:left;">倉庫名</th>
		</tr>
    </thead>
    <tbody>
        @php
            $prevItemCd = null; $prevSizeCd = null; $prevColorCd= null;
            $orderAmountItem = null; $receiveAmountItem = null;
            $orderAmountColor = null; $receiveAmountColor = null;
            $orderAmountSize = null; $receiveAmountSize = null;
            $i = 0;
        @endphp
        @foreach($params['datas'] as $data)
            @php
            $itemAmountTag = null;
            $sizeAmountTag = null;
            $colorAmountTag = null;
            if($i === 0) {
                $orderAmountItem = $data->order_quantity;
                $receiveAmountItem = $data->order_receive_quantity;
                $orderAmountSize = $data->order_quantity;
                $receiveAmountSize = $data->order_receive_quantity;
                $orderAmountColor = $data->order_quantity;
                $receiveAmountColor = $data->order_receive_quantity;
            }

            // size
            if($i !== count(session('listDatas')) && !empty($prevSizeCd)) {
                if($prevSizeCd === $data->size_cd) {
                    $orderAmountSize += $data->order_quantity;
                    $receiveAmountSize += $data->order_receive_quantity;
                } elseif($prevSizeCd !== $data->size_cd) {
                    $sizeAmountTag = ['orderAmountSize' => $orderAmountSize, 'receiveAmountSize' => $receiveAmountSize];
                    if($i !== count(session('listDatas')) - 1) {
                        $orderAmountSize = 0;
                        $receiveAmountSize = 0;
                    }
                }
            }

            // color
            if($i !== count(session('listDatas')) && !empty($prevColorCd)) {
                if($prevColorCd === $data->color_cd) {
                    $orderAmountColor += $data->order_quantity;
                    $receiveAmountColor += $data->order_receive_quantity;
                } elseif($prevColorCd !== $data->color_cd) {
                    $colorAmountTag = ['orderAmountColor' => $orderAmountColor, 'receiveAmountColor' => $receiveAmountColor];
                    if($i !== count(session('listDatas')) - 1) {
                        $orderAmountColor = 0;
                        $receiveAmountColor = 0;
                    }
                }
            }

            //item
            if($i !== count(session('listDatas')) && !empty($prevItemCd)) {
                if($prevItemCd === $data->item_cd) {
                    $orderAmountItem += $data->order_quantity;
                    $receiveAmountItem += $data->order_receive_quantity;
                } elseif($prevItemCd !== $data->item_cd) {
                    $itemAmountTag = ['orderAmountItem' => $orderAmountItem, 'receiveAmountItem' => $receiveAmountItem];
                    if($i !== count(session('listDatas')) - 1) {
                        $orderAmountItem = 0;
                        $receiveAmountItem = 0;
                    }
                }
            }

            $prevItemCd = $data->item_cd;
            $prevSizeCd = $data->size_cd;
            $prevColorCd = $data->color_cd;
            $i++;
            @endphp
            @if(!empty($sizeAmountTag))
            <tr class="amount_row">
                <td class="grid_wrapper_left"></td>
                <td class="grid_wrapper_left"></td>
                <td class="grid_wrapper_left"></td>
                <td class="grid_wrapper_left">サイズ計</td>
                <td class="grid_wrapper_left"></td>
                <td class="grid_wrapper_left"></td>
                <td class="grid_wrapper_left"></td>
                <td class="grid_wrapper_right">{{ sprintf('%.1f', $sizeAmountTag["orderAmountSize"]) }}</td>
                <td class="grid_wrapper_right">{{ $sizeAmountTag["receiveAmountSize"] }}</td>
                <td class="grid_wrapper_right"></td>
                <td class="grid_wrapper_left"></td>
                <td class="grid_wrapper_left"></td>
                <td class="grid_wrapper_left"></td>
                <td class="grid_wrapper_left"></td>
                <td class="grid_wrapper_left"></td>
                <td class="grid_wrapper_left"></td>
                <td class="grid_wrapper_left"></td>
                <td class="grid_wrapper_left"></td>
            </tr>
            @endif
            @if(!empty($colorAmountTag))
            <tr class="amount_row">
                <td class="grid_wrapper_left"></td>
                <td class="grid_wrapper_left"></td>
                <td class="grid_wrapper_left"></td>
                <td class="grid_wrapper_left">カラー計</td>
                <td class="grid_wrapper_left"></td>
                <td class="grid_wrapper_left"></td>
                <td class="grid_wrapper_left"></td>
                <td class="grid_wrapper_right">{{ sprintf('%.1f', $colorAmountTag["orderAmountColor"]) }}</td>
                <td class="grid_wrapper_right">{{ $colorAmountTag["receiveAmountColor"] }}</td>
                <td class="grid_wrapper_right"></td>
                <td class="grid_wrapper_left"></td>
                <td class="grid_wrapper_left"></td>
                <td class="grid_wrapper_left"></td>
                <td class="grid_wrapper_left"></td>
                <td class="grid_wrapper_left"></td>
                <td class="grid_wrapper_left"></td>
                <td class="grid_wrapper_left"></td>
                <td class="grid_wrapper_left"></td>
            </tr>
            @endif
            @if(!empty($itemAmountTag))
            <tr class="amount_row">
                <td class="grid_wrapper_left"></td>
                <td class="grid_wrapper_left"></td>
                <td class="grid_wrapper_left"></td>
                <td class="grid_wrapper_left">商品計</td>
                <td class="grid_wrapper_left"></td>
                <td class="grid_wrapper_left"></td>
                <td class="grid_wrapper_left"></td>
                <td class="grid_wrapper_right">{{ sprintf('%.1f', $itemAmountTag["orderAmountItem"]) }}</td>
                <td class="grid_wrapper_right">{{ $itemAmountTag["receiveAmountItem"] }}</td>
                <td class="grid_wrapper_right"></td>
                <td class="grid_wrapper_left"></td>
                <td class="grid_wrapper_left"></td>
                <td class="grid_wrapper_left"></td>
                <td class="grid_wrapper_left"></td>
                <td class="grid_wrapper_left"></td>
                <td class="grid_wrapper_left"></td>
                <td class="grid_wrapper_left"></td>
                <td class="grid_wrapper_left"></td>
            </tr>
            @endif
            <tr>
				<td style="text-align:left;">{{ $data->item_cd }}</td>
				<td style="text-align:left;">{{ $data->item_name }}</td>
				<td style="text-align:left;">{{ $data->color_cd }}</td>
				<td style="text-align:left;">{{ $data->color_name }}</td>
				<td style="text-align:left;">{{ $data->size_cd }}</td>
				<td style="text-align:left;">{{ $data->size_name }}</td>
				<td style="text-align:left;">{{ $data->deadline }}</td>
				<td style="text-align:left;">{{ sprintf('%.1f', $data->order_quantity) }}</td>
                <td style="text-align:left;">{{ $data->order_receive_quantity }}</td>
				<td style="text-align:left;">@if($params['target'] === '0'){{ $data->now_stock_quantity }}@else{{ "" }}@endif</td>
				<td style="text-align:left;">{{ $data->number }}</td>
				<td style="text-align:left;">{{ $data->line_no }}</td>
				<td style="text-align:left;">{{ $data->order_date }}</td>
				<td style="text-align:left;">{{ $data->cs_cd }}</td>
				<td style="text-align:left;">{{ $data->cs_name }}</td>
				<td style="text-align:left;">{{ $data->order_number }}</td>
				<td style="text-align:left;">{{ $data->warehouse_cd }}</td>
				<td style="text-align:left;">{{ $data->warehouse_name }}</td>
            </tr>
        @endforeach
        <tr class="amount_row">
            <td class="grid_wrapper_left"></td>
            <td class="grid_wrapper_left"></td>
            <td class="grid_wrapper_left"></td>
            <td class="grid_wrapper_left">サイズ計</td>
            <td class="grid_wrapper_left"></td>
            <td class="grid_wrapper_left"></td>
            <td class="grid_wrapper_left"></td>
            <td class="grid_wrapper_right">{{ sprintf('%.1f', $orderAmountSize) }}</td>
            <td class="grid_wrapper_right">{{ $receiveAmountSize }}</td>
            <td class="grid_wrapper_right"></td>
            <td class="grid_wrapper_right"></td>
            <td class="grid_wrapper_left"></td>
            <td class="grid_wrapper_left"></td>
            <td class="grid_wrapper_left"></td>
            <td class="grid_wrapper_left"></td>
            <td class="grid_wrapper_left"></td>
            <td class="grid_wrapper_left"></td>
            <td class="grid_wrapper_left"></td>
        </tr>
        <tr class="amount_row">
            <td class="grid_wrapper_left"></td>
            <td class="grid_wrapper_left"></td>
            <td class="grid_wrapper_left"></td>
            <td class="grid_wrapper_left">カラー計</td>
            <td class="grid_wrapper_left"></td>
            <td class="grid_wrapper_left"></td>
            <td class="grid_wrapper_left"></td>
            <td class="grid_wrapper_right">{{ sprintf('%.1f', $orderAmountColor); }}</td>
            <td class="grid_wrapper_right">{{ $receiveAmountColor }}</td>
            <td class="grid_wrapper_right"></td>
            <td class="grid_wrapper_right"></td>
            <td class="grid_wrapper_left"></td>
            <td class="grid_wrapper_left"></td>
            <td class="grid_wrapper_left"></td>
            <td class="grid_wrapper_left"></td>
            <td class="grid_wrapper_left"></td>
            <td class="grid_wrapper_left"></td>
            <td class="grid_wrapper_left"></td>
        </tr>
        <tr class="amount_row">
            <td class="grid_wrapper_left"></td>
            <td class="grid_wrapper_left"></td>
            <td class="grid_wrapper_left"></td>
            <td class="grid_wrapper_left">商品計</td>
            <td class="grid_wrapper_left"></td>
            <td class="grid_wrapper_left"></td>
            <td class="grid_wrapper_left"></td>
            <td class="grid_wrapper_right">{{ sprintf('%.1f', $orderAmountItem) }}</td>
            <td class="grid_wrapper_right">{{ $receiveAmountItem }}</td>
            <td class="grid_wrapper_right"></td>
            <td class="grid_wrapper_right"></td>
            <td class="grid_wrapper_left"></td>
            <td class="grid_wrapper_left"></td>
            <td class="grid_wrapper_left"></td>
            <td class="grid_wrapper_left"></td>
            <td class="grid_wrapper_left"></td>
            <td class="grid_wrapper_left"></td>
            <td class="grid_wrapper_left"></td>
        </tr>
    </tbody>
</table>

@endsection
