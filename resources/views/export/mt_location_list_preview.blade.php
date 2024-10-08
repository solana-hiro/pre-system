@extends('layouts.admin.file')
@section('page_title', 'プレビュー')
@section('title', 'プレビュー')

@section('content')
	<table>
	    <thead>
	        <tr>
	            <th>倉庫：</th>
	            <th>{{ $params['warehouseCode'] }}</th>
	        </tr>
	        <tr>
	            <th>商品コード範囲：</th>
	            <th>{{ $params['itemStartCode'] }}</th>
	            <th>～</th>
	            <th>{{ $params['itemEndCode'] }}</th>
	        </tr>
	        <tr>
	            <th>カラーコード範囲：</th>
	            <th>{{ $params['colorStartCode'] }}</th>
	            <th>～</th>
	            <th>{{ $params['colorEndCode'] }}</th>
	        </tr>
	        <tr>
	            <th>サイズコード範囲：</th>
	            <th>{{ $params['sizeStartCode'] }}</th>
	            <th>～</th>
	            <th>{{ $params['sizeEndCode'] }}</th>
	        </tr>
	        <tr>
	            <th>棚番1範囲：</th>
	            <th>{{ $params['shelfNumberCode1Start'] }}</th>
	            <th>～</th>
	            <th>{{ $params['shelfNumberCode1End'] }}</th>
	        </tr>
	        <tr>
	            <th>棚番2範囲：</th>
	            <th>{{ $params['shelfNumberCode2Start'] }}</th>
	            <th>～</th>
	            <th>{{ $params['shelfNumberCode2End'] }}</th>
	        </tr>
	        <tr>
	            <th>処理日：</th>
	            <th>{{ $params['currentDate'] }}</th>
	        </tr>
	        <tr></tr>
	        <tr>
				<th>倉庫コード</th>
				<th>倉庫名</th>
				<th>ＪＡＮコード</th>
				<th>商品コード</th>
				<th>商品名</th>
				<th>カラーコード</th>
				<th>カラー名</th>
				<th>サイズコード</th>
				<th>サイズ名</th>
				<th>棚番１</th>
				<th>棚番２</th>
				<th>ランク</th>
			</tr>
	    </thead>
	    <tbody>
	        @foreach($params['datas'] as $data)
	            <tr>
					<td>{{ $data->warehouse_cd }}</td>
					<td>{{ $data->warehouse_name }}</td>
					<td>{{ $data->jan_cd }}</td>
					<td>{{ $data->item_cd }}</td>
					<td>{{ $data->item_name }}</td>
					<td>{{ $data->color_cd }}</td>
					<td>{{ $data->color_name }}</td>
					<td>{{ $data->size_cd }}</td>
					<td>{{ $data->size_name }}</td>
					<td>{{ $data->shelf_number_1 }}</td>
					<td>{{ $data->shelf_number_2 }}</td>
					<td>{{ $data->rank }}</td>
	            </tr>
	        @endforeach
	    </tbody>
	</table>
@endsection
