@extends('layouts.admin.file')
@section('page_title', '一覧表')
@section('title', '一覧表')
@section('content')

<table>
    <thead>
        <tr>
            <th style="text-align:left;">PS区分コード：</th>
            <th style="text-align:left;">0</th>
        </tr>
        <tr>
            <th style="text-align:left;">得意先コード範囲：</th>
            <th style="text-align:left;">{{ $params['customerStartCode'] }}</th>
            <th style="text-align:left;">～</th>
            <th style="text-align:left;">{{ $params['customerEndCode'] }}</th>
        </tr>
        <tr>
            <th style="text-align:left;">商品コード範囲：</th>
            <th style="text-align:left;">{{ $params['itemStartCode'] }}</th>
            <th style="text-align:left;">～</th>
            <th style="text-align:left;">{{ $params['itemEndCode'] }}</th>
        </tr>
        <tr>
            <th style="text-align:left;">処理日：</th>
            <th style="text-align:left;">{{ $params['currentDate'] }}</th>
        </tr>
        <tr></tr>
        <tr>
			<th style="text-align:left;">PS区分コード</th>
			<th style="text-align:left;">PS区分名</th>
			<th style="text-align:left;">得意先コード</th>
			<th style="text-align:left;">得意先名</th>
			<th style="text-align:left;">商品コード</th>
			<th style="text-align:left;">商品名</th>
			<th style="text-align:left;">掛率</th>
			<th style="text-align:left;">開始日付</th>
			<th style="text-align:left;">終了日付</th>
			<th style="text-align:left;">旧掛率</th>
			<th style="text-align:left;">旧開始日付</th>
			<th style="text-align:left;">旧終了日付</th>
        </tr>
    </thead>
    <tbody>
        @foreach($params['datas'] as $data)
            <tr>
				<td style="text-align:left;">{{ '0' }}</td>
				<td style="text-align:left;">{{ 'プロパー' }}</td>
				<td style="text-align:left;">{{ $data->customer_cd }}</td>
				<td style="text-align:left;">{{ $data->customer_name }}</td>
				<td style="text-align:left;">{{ $data->item_cd }}</td>
				<td style="text-align:left;">{{ $data->item_name }}</td>
				<td style="text-align:left;">{{ $data->rate }}</td>
				<td style="text-align:left;">{{ $data->start_date }}</td>
				<td style="text-align:left;">{{ $data->end_date }}</td>
				<td style="text-align:left;">{{ $data->old_rate }}</td>
				<td style="text-align:left;">{{ $data->old_start_date }}</td>
				<td style="text-align:left;">{{ $data->old_end_date }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
@endsection