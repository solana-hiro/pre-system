@extends('layouts.admin.file')
@section('page_title', 'プレビュー')
@section('title', 'プレビュー')

@section('content')
	<table>
	    <thead>
	        <tr>
	            <th>対象仕入先分類：</th>
	            <th>{{ $params['supplier_class_thing_id'] }}</th>
	        </tr>
	        <tr>
	            <th>仕入先分類2コード範囲：</th>
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
				<th>仕入先分類2コード</th>
				<th>仕入先分類2名</th>
	        </tr>
	    </thead>
	    <tbody>
	        @foreach($params['datas'] as $data)
	            <tr>
	                <td>{{ $data->supplier_class_cd }}</td>
	                <td>{{ $data->supplier_class_name }}</td>
	            </tr>
	        @endforeach
	    </tbody>
	</table>
@endsection
