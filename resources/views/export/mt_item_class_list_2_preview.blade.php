@extends('layouts.admin.file')
@section('page_title', 'プレビュー')
@section('title', 'プレビュー')

@section('content')

	<table>
	    <thead>
	        <tr>
	            <th>対象商品分類：</th>
	            <th>{{ $params['item_class_thing_id'] }}</th>
	        </tr>
	        <tr>
	            <th>競技・カテゴリコード範囲：</th>
	            <th>{{ $params['itemClassCodeStartCode'] }}</th>
	            <th>～</th>
	            <th>{{ $params['itemClassCodeEndCode'] }}</th>
	        </tr>
	        <tr>
	            <th>商品コード範囲：</th>
	            <th>{{ $params['itemCodeStartCode'] }}</th>
	            <th>～</th>
	            <th>{{ $params['itemCodeEndCode'] }}</th>
	        </tr>
	        <tr>
	            <th>処理日：</th>
	            <th>{{ $params['currentDate'] }}</th>
	        </tr>
	        <tr></tr>
	        <tr>
				<th>競技・カテゴリコード</th>
				<th>競技・カテゴリ名</th>
				<th>商品コード</th>
				<th>商品名</th>
				<th>単位</th>
				<th>上代単価：税抜</th>
				<th>上代単価：税込</th>
				<th>仕入単価：税抜</th>
				<th>仕入単価：税込</th>
				<th>原価単価</th>
	        </tr>
	    </thead>
	    <tbody>
	        @foreach($params['datas'] as $data)
	            <tr>
					<td>{{ $data->item_class_cd }}</td>
					<td>{{ $data->item_class_name }}</td>
					<td>{{ $data->item_cd }}</td>
					<td>{{ $data->item_name }}</td>
					<td>{{ $data->unit }}</td>
					<td>{{ $data->retail_price_tax_out }}</td>
					<td>{{ $data->retail_price_tax_in }}</td>
					<td>{{ $data->purchase_price_tax_out }}</td>
					<td>{{ $data->purchase_price_tax_in }}</td>
					<td>{{ $data->cost_price }}</td>
	            </tr>
	        @endforeach
	    </tbody>
	</table>
@endsection
