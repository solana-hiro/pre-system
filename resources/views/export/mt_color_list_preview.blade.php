@extends('layouts.admin.file')
@section('page_title', 'プレビュー')
@section('title', 'プレビュー')

@section('content')
	<table>
	    <thead>
	        <tr>
	            <th>カラーコード範囲：</th>
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
				<th>カラーコード</th>
				<th>カラー名</th>
				<th>HTMLカラーコード</th>
				<th>ソート順</th>
	        </tr>
	    </thead>
	    <tbody>
	        @foreach($params['datas'] as $data)
	            <tr>
					<td>{{ $data->color_cd }}</td>
					<td>{{ $data->color_name }}</td>
					<td>{{ $data->html_color_cd }}</td>
					<td>{{ $data->sort_order }}</td>
	            </tr>
	        @endforeach
	    </tbody>
	</table>
@endsection
