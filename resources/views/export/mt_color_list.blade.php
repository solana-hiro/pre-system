@extends('layouts.admin.file')
@section('page_title', '一覧表')
@section('title', '一覧表')
@section('content')
<table>
    <thead>
        <tr>
            <th style="text-align:left;">カラーコード範囲：</th>
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
			<th style="text-align:left;">カラーコード</th>
			<th style="text-align:left;">カラー名</th>
			<th style="text-align:left;">HTMLカラーコード</th>
			<th style="text-align:left;">ソート順</th>
        </tr>
    </thead>
    <tbody>
        @foreach($params['datas'] as $data)
            <tr>
				<td style="text-align:left;">{{ $data->color_cd }}</td>
				<td style="text-align:left;">{{ $data->color_name }}</td>
				<td style="text-align:left;">{{ $data->html_color_cd }}</td>
				<td style="text-align:left;">{{ $data->sort_order }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
@endsection
