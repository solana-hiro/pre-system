@extends('layouts.admin.file')
@section('page_title', 'プレビュー')
@section('title', 'プレビュー')

@section('content')
	<table>
	    <thead>
	        <tr>
	            <th>仕入先コード範囲：</th>
	            <th>{{ $params['supplierStartCode'] }}</th>
	            <th>～</th>
	            <th>{{ $params['supplierEndCode'] }}</th>
	        </tr>
	        <tr>
	            <th>商品コード範囲：</th>
	            <th>{{ $params['itemStartCode'] }}</th>
	            <th>～</th>
	            <th>{{ $params['itemEndCode'] }}</th>
	        </tr>
	        <tr>
	            <th>処理日：</th>
	            <th>{{ $params['currentDate'] }}</th>
	        </tr>
	        <tr></tr>
	        <tr>
				<th>仕入先コード</th>
				<th>仕入先名</th>
				<th>商品コード</th>
				<th>商品名</th>
				<th>仕入単価設定日</th>
				<th>税抜仕入単価</th>
	            <th>税込仕入単価</th>
	        </tr>
	    </thead>
	    <tbody>
	        @foreach($params['datas'] as $data)
	            <tr>
					<td>{{ $data->supplier_cd }}</td>
					<td>{{ $data->supplier_name }}</td>
					<td>{{ $data->item_cd }}</td>
					<td>{{ $data->item_name }}</td>
					<td>{{ $data->set_date }}</td>
					<td>{{ $data->tax_kbn === 1 ? $data->price : 0 }}</td>
					<td>{{ $data->tax_kbn === 1 ? 0 : $data->price }}</td>
	            </tr>
	        @endforeach
	    </tbody>
	</table>
@endsection
