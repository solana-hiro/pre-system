@extends('layouts.admin.file')
@section('page_title', '一覧表')
@section('title', '一覧表')
@section('content')

<table>
    <thead>
        <tr>
            <th style="text-align:left;">サイズパターンコード範囲：</th>
            <th style="text-align:left;">{{ $params['startCode'] }}</th>
            <th style="text-align:left;">～</th>
            <th style="text-align:left;">{{ $params['endCode'] }}</th>
        </tr>
        <tr>
            <th style="text-align:left;">処理日：</th>
            <th style="text-align:left;">{{ $params['currentDate'] }}</th>
        </tr>
        <tr></tr>
        <tr>
			<th style="text-align:left;">サイズパターンコード</th>
			<th style="text-align:left;">サイズコード1</th>
			<th style="text-align:left;">サイズ名1</th>
			<th style="text-align:left;">サイズコード2</th>
			<th style="text-align:left;">サイズ名2</th>
			<th style="text-align:left;">サイズコード3</th>
			<th style="text-align:left;">サイズ名3</th>
			<th style="text-align:left;">サイズコード4</th>
			<th style="text-align:left;">サイズ名4</th>
			<th style="text-align:left;">サイズコード5</th>
			<th style="text-align:left;">サイズ名5</th>
			<th style="text-align:left;">サイズコード6</th>
			<th style="text-align:left;">サイズ名6</th>
			<th style="text-align:left;">サイズコード7</th>
			<th style="text-align:left;">サイズ名7</th>
			<th style="text-align:left;">サイズコード8</th>
			<th style="text-align:left;">サイズ名8</th>
			<th style="text-align:left;">サイズコード9</th>
			<th style="text-align:left;">サイズ名9</th>
			<th style="text-align:left;">サイズコード10</th>
			<th style="text-align:left;">サイズ名10</th>
        </tr>
    </thead>
    <tbody>
        @foreach($params['datas'] as $data)
            <tr>
				<td style="text-align:left;">{{ $data->size_pattern_cd }}</td>
				<td style="text-align:left;">{{ $data->size_cd_1 }}</td>
				<td style="text-align:left;">{{ $data->size_name_1 }}</td>
				<td style="text-align:left;">{{ $data->size_cd_2 }}</td>
				<td style="text-align:left;">{{ $data->size_name_2 }}</td>
				<td style="text-align:left;">{{ $data->size_cd_3}}</td>
				<td style="text-align:left;">{{ $data->size_name_3 }}</td>
				<td style="text-align:left;">{{ $data->size_cd_4 }}</td>
				<td style="text-align:left;">{{ $data->size_name_4 }}</td>
				<td style="text-align:left;">{{ $data->size_cd_5 }}</td>
				<td style="text-align:left;">{{ $data->size_name_5 }}</td>
				<td style="text-align:left;">{{ $data->size_cd_6 }}</td>
				<td style="text-align:left;">{{ $data->size_name_6 }}</td>
				<td style="text-align:left;">{{ $data->size_cd_7 }}</td>
				<td style="text-align:left;">{{ $data->size_name_7 }}</td>
				<td style="text-align:left;">{{ $data->size_cd_8 }}</td>
				<td style="text-align:left;">{{ $data->size_name_8 }}</td>
				<td style="text-align:left;">{{ $data->size_cd_9 }}</td>
				<td style="text-align:left;">{{ $data->size_name_9 }}</td>
				<td style="text-align:left;">{{ $data->size_cd_10 }}</td>
				<td style="text-align:left;">{{ $data->size_name_10 }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
@endsection