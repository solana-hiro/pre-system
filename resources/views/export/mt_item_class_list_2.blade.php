@extends('layouts.admin.file')
@section('page_title', '一覧表')
@section('title', '一覧表')
@section('content')

<table>
    <thead>
        <tr>
            <th style="text-align:left;">対象商品分類：</th>
            <th style="text-align:left;">{{ $params['item_class_thing_id'] }}</th>
        </tr>
        <tr>
            <th style="text-align:left;">競技・カテゴリコード範囲：</th>
            <th style="text-align:left;">{{ $params['itemClassCodeStartCode'] }}</th>
            <th style="text-align:left;">～</th>
            <th style="text-align:left;">{{ $params['itemClassCodeEndCode'] }}</th>
        </tr>
        <tr>
            <th style="text-align:left;">商品コード範囲：</th>
            <th style="text-align:left;">{{ $params['itemCodeStartCode'] }}</th>
            <th style="text-align:left;">～</th>
            <th style="text-align:left;">{{ $params['itemCodeEndCode'] }}</th>
        </tr>
        <tr>
            <th style="text-align:left;">処理日：</th>
            <th style="text-align:left;">{{ $params['currentDate'] }}</th>
        </tr>
        <tr></tr>
        <tr>
			<th style="text-align:left;">競技・カテゴリコード</th>
			<th style="text-align:left;">競技・カテゴリ名</th>
			<th style="text-align:left;">商品コード</th>
			<th style="text-align:left;">商品名</th>
			<th style="text-align:left;">単位</th>
			<th style="text-align:left;">上代単価：税抜</th>
			<th style="text-align:left;">上代単価：税込</th>
			<th style="text-align:left;">仕入単価：税抜</th>
			<th style="text-align:left;">仕入単価：税込</th>
			<th style="text-align:left;">原価単価</th>
        </tr>
    </thead>
    <tbody>
        @foreach($params['datas'] as $data)
            <tr>
				<td style="text-align:left;">{{ $data->item_class_cd }}</td>
				<td style="text-align:left;">{{ $data->item_class_name }}</td>
				<td style="text-align:left;">{{ $data->item_cd }}</td>
				<td style="text-align:left;">{{ $data->item_name }}</td>
				<td style="text-align:left;">{{ $data->unit }}</td>
				<td style="text-align:left;">{{ $data->retail_price_tax_out }}</td>
				<td style="text-align:left;">{{ $data->retail_price_tax_in }}</td>
				<td style="text-align:left;">{{ $data->purchase_price_tax_out }}</td>
				<td style="text-align:left;">{{ $data->purchase_price_tax_in }}</td>
				<td style="text-align:left;">{{ $data->cost_price }}</td>
            </tr>
        @endforeach
    </tbody>
</table>

@endsection