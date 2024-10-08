@extends('layouts.admin.file')
@section('page_title', '一覧表')
@section('title', '一覧表')
@section('content')

<table>
    <thead>
        <tr>
            <th style="text-align:left;">商品コード範囲：</th>
            <th style="text-align:left;">{{ $params['startItemCode'] }}</th>
            <th style="text-align:left;">～</th>
            <th style="text-align:left;">{{ $params['endItemCode'] }}</th>
        </tr>
        <tr>
            <th style="text-align:left;">変更日付範囲：</th>
            <th style="text-align:left;">{{ $params['startDate'] }}</th>
            <th style="text-align:left;">～</th>
            <th style="text-align:left;">{{ $params['endDate'] }}</th>
        </tr>
        <tr>
            <th style="text-align:left;">変更者ID範囲：</th>
            <th style="text-align:left;">{{ $params['startUserCode'] }}</th>
            <th style="text-align:left;">～</th>
            <th style="text-align:left;">{{ $params['endUserCode'] }}</th>
        </tr>
        <tr>
            <th style="text-align:left;">変更項目名(部分)：</th>
            <th style="text-align:left;">{{ $params['updateDetail'] }}</th>
        </tr>
        <tr>
            <th style="text-align:left;">処理日：</th>
            <th style="text-align:left;">{{ $params['currentDate'] }}</th>
        </tr>
        <tr></tr>
        <tr>
			<th style="text-align:left;">商品コード</th>
			<th style="text-align:left;">商品名</th>
			<th style="text-align:left;">変更日</th>
			<th style="text-align:left;">変更者ID</th>
			<th style="text-align:left;">項目名</th>
			<th style="text-align:left;">変更前</th>
			<th style="text-align:left;">変更後</th>
        </tr>
    </thead>
    <tbody>
        @foreach($params['datas'] as $data)
            <tr>
				<td style="text-align:left;">{{ $data->item_cd }}</td>
				<td style="text-align:left;">{{ $data->item_name }}</td>
				<td style="text-align:left;">{{ $data->change_datetime }}</td>
				<td style="text-align:left;">{{ $data->user_cd }}</td>
				<td style="text-align:left;">{{ $data->thing_name }}</td>
				<td style="text-align:left;">{{ $data->change_before }}</td>
				<td style="text-align:left;">{{ $data->change_after }}</td>
            </tr>
        @endforeach
    </tbody>
</table>

@endsection