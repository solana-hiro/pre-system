@extends('layouts.admin.file')
@section('page_title', 'プレビュー')
@section('title', 'プレビュー')

@section('content')
	<table>
	    <thead>
	        <tr>
	            <th>商品コード範囲：</th>
	            <th>{{ $params['startItemCode'] }}</th>
	            <th>～</th>
	            <th>{{ $params['endItemCode'] }}</th>
	        </tr>
	        <tr>
	            <th>変更日付範囲：</th>
	            <th>{{ $params['startDate'] }}</th>
	            <th>～</th>
	            <th>{{ $params['endDate'] }}</th>
	        </tr>
	        <tr>
	            <th>変更者ID範囲：</th>
	            <th>{{ $params['startUserCode'] }}</th>
	            <th>～</th>
	            <th>{{ $params['endUserCode'] }}</th>
	        </tr>
	        <tr>
	            <th>変更項目名(部分)：</th>
	            <th>{{ $params['updateDetail'] }}</th>
	        </tr>
	        <tr>
	            <th>処理日：</th>
	            <th>{{ $params['currentDate'] }}</th>
	        </tr>
	        <tr></tr>
	        <tr>
				<th>商品コード</th>
				<th>商品名</th>
				<th>変更日</th>
				<th>変更者ID</th>
				<th>項目名</th>
				<th>変更前</th>
				<th>変更後</th>
	        </tr>
	    </thead>
	    <tbody>
	        @foreach($params['datas'] as $data)
	            <tr>
					<td>{{ $data->item_cd }}</td>
					<td>{{ $data->item_name }}</td>
					<td>{{ $data->change_datetime }}</td>
					<td>{{ $data->user_cd }}</td>
					<td>{{ $data->thing_name }}</td>
					<td>{{ $data->change_before }}</td>
					<td>{{ $data->change_after }}</td>
	            </tr>
	        @endforeach
	    </tbody>
	</table>
@endsection
