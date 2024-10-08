@extends('layouts.admin.file')
@section('page_title', 'プレビュー')
@section('title', 'プレビュー')

@section('content')

	<table>
	    <thead>
	        <tr>
	            <th>サイズコード範囲：</th>
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
				<th>サイズコード</th>
				<th>サイズ名</th>
				<th>ソート順</th>
	        </tr>
	    </thead>
	    <tbody>
	        @foreach($params['datas'] as $data)
	            <tr>
					<td>{{ $data->size_cd }}</td>
					<td>{{ $data->size_name }}</td>
					<td>{{ $data->sort_order }}</td>
	            </tr>
	        @endforeach
	    </tbody>
	</table>

@endsection
