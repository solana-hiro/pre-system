@extends('layouts.admin.file')
@section('page_title', 'プレビュー')
@section('title', 'プレビュー')

@section('content')
	<table>
	    <thead>
	        <tr>
	            <th>対象商品分類：</th>
	            <th>{{ $params['itemClassId'] }}</th>
	        </tr>
	        <tr>
	            <th>{{ $params['itemClassName'] }}コード範囲：</th>
	            <th>{{ $params['startCode'] }}</th>
	            <th>～</th>
	            <th>{{ $params['endCode'] }}</th>
	        </tr>
	        <tr>
	            <th>処理日：</th>
	            <th>{{ $params['currentDate'] }}</th>
	        </tr>
	        <tr></tr>
	        <tr>
				<th>{{ $params['itemClassName'] }}コード</th>
				<th>{{ $params['itemClassName'] }}名</th>
				<th>EC表示</th>
	        </tr>
	    </thead>
	    <tbody>
	        @foreach($params['datas'] as $data)
	            <tr>
					<td>{{ $data->item_class_cd }}</td>
					<td>{{ $data->item_class_name }}</td>
					<td>{{ $data->ec_display_flg === 0 ? "非表示" : "表示" }}</td>
	            </tr>
	        @endforeach
	    </tbody>
	</table>
@endsection
