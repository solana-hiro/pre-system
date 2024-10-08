@extends('layouts.admin.file')
@section('page_title', 'プレビュー')
@section('title', 'プレビュー')

@section('content')
	<table>
	    <thead>
	        <tr>
	            <th>対象得意先分類：</th>
	            <th>{{ $params['customer_class_thing_id'] }}</th>
	        </tr>
	        <tr>
	            <th>販売パターン1コード範囲：</th>
	            <th>{{ $params['startDate'] }}</th>
	            <th>～</th>
	            <th>{{ $params['endDate'] }}</th>
	        </tr>
	        <tr>
	            <th>処理日：</th>
	            <th>{{ $params['currentDate'] }}</th>
	        </tr>
	        <tr></tr>
	        <tr>
				<th>販売パターン1コード</th>
				<th>販売パターン1名</th>
	        </tr>
	    </thead>
	    <tbody>
	        @foreach($params['datas'] as $data)
	            <tr>
	                <td>{{ $data->customer_class_cd }}</td>
	                <td>{{ $data->customer_class_name }}</td>
	            </tr>
	        @endforeach
	    </tbody>
	</table>
@endsection
