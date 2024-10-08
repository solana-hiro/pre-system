@extends('layouts.admin.file')
@section('page_title', 'プレビュー')
@section('title', 'プレビュー')

@section('content')

	<table>
	    <thead>
	        <tr>
	            <th>サイズパターンコード範囲：</th>
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
				<th>サイズパターンコード</th>
				<th>サイズコード1</th>
				<th>サイズ名1</th>
				<th>サイズコード2</th>
				<th>サイズ名2</th>
				<th>サイズコード3</th>
				<th>サイズ名3</th>
				<th>サイズコード4</th>
				<th>サイズ名4</th>
				<th>サイズコード5</th>
				<th>サイズ名5</th>
				<th>サイズコード6</th>
				<th>サイズ名6</th>
				<th>サイズコード7</th>
				<th>サイズ名7</th>
				<th>サイズコード8</th>
				<th>サイズ名8</th>
				<th>サイズコード9</th>
				<th>サイズ名9</th>
				<th>サイズコード10</th>
				<th>サイズ名10</th>
	        </tr>
	    </thead>
	    <tbody>
	        @foreach($params['datas'] as $data)
	            <tr>
					<td>{{ $data->size_pattern_cd }}</td>
					<td>{{ $data->size_cd_1 }}</td>
					<td>{{ $data->size_name_1 }}</td>
					<td>{{ $data->size_cd_2 }}</td>
					<td>{{ $data->size_name_2 }}</td>
					<td>{{ $data->size_cd_3}}</td>
					<td>{{ $data->size_name_3 }}</td>
					<td>{{ $data->size_cd_4 }}</td>
					<td>{{ $data->size_name_4 }}</td>
					<td>{{ $data->size_cd_5 }}</td>
					<td>{{ $data->size_name_5 }}</td>
					<td>{{ $data->size_cd_6 }}</td>
					<td>{{ $data->size_name_6 }}</td>
					<td>{{ $data->size_cd_7 }}</td>
					<td>{{ $data->size_name_7 }}</td>
					<td>{{ $data->size_cd_8 }}</td>
					<td>{{ $data->size_name_8 }}</td>
					<td>{{ $data->size_cd_9 }}</td>
					<td>{{ $data->size_name_9 }}</td>
					<td>{{ $data->size_cd_10 }}</td>
					<td>{{ $data->size_name_10 }}</td>
	            </tr>
	        @endforeach
	    </tbody>
	</table>

@endsection
