@extends('layouts.admin.file')
@section('page_title', '未回収残一覧表')
@section('title', '未回収残一覧表')
@section('content')

<table>
    <thead>
        <tr>
            <th style="text-align:left;">対象年月</th>
            <th style="text-align:left;">{{ $params['targetDate'] }}</th>
        </tr>
        <tr>
            <th style="text-align:left;">担当者コード範囲</th>
            <th style="text-align:left;">{{ $params['managerCodeStart'] }}</th>
            <th style="text-align:left;">～</th>
            <th style="text-align:left;">{{ $params['managerCodeEnd'] }}</th>
        </tr>
        <tr>
            <th style="text-align:left;">請求先コード範囲</th>
            <th style="text-align:left;">{{ $params['billingAddressCodeStart'] }}</th>
            <th style="text-align:left;">～</th>
            <th style="text-align:left;">{{ $params['billingAddressCodeEnd'] }}</th>
        </tr>
        <tr>
            <th style="text-align:left;">処理日：</th>
            <th style="text-align:left;">{{ $params['currentDate'] }}</th>
        </tr>
        <tr></tr>
        <tr>
			<th style="text-align:left;">対象年月</th>
			<th style="text-align:left;">担当者コード</th>
			<th style="text-align:left;">担当者名称</th>
			<th style="text-align:left;">得意先コード</th>
			<th style="text-align:left;">得意先名</th>
			<th style="text-align:left;">三ヶ月前</th>
			<th style="text-align:left;">二ヶ月前</th>
			<th style="text-align:left;">一ヶ月前</th>
			<th style="text-align:left;">当月未回収</th>
			<th style="text-align:left;">未回収残高</th>
		</tr>
    </thead>
    <tbody>
        @foreach($params['datas'] as $data)
            <tr>
				<td style="text-align:left;">{{ $params['targetDate'] }}</td>
				<td style="text-align:left;">{{ $data['user_cd'] }}</td>
				<td style="text-align:left;">{{ $data['user_name'] }}</td>
				<td style="text-align:left;">{{ $data['customer_cd'] }}</td>
				<td style="text-align:left;">{{ $data['customer_name'] }}</td>
				<td style="text-align:left;">{{ $data['col1'] }}</td>
				<td style="text-align:left;">{{ $data['col2'] }}</td>
				<td style="text-align:left;">{{ $data['col3'] }}</td>
				<td style="text-align:left;">{{ $data['col4'] }}</td>
                <td style="text-align:left;">{{ $data['col5'] }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
@endsection
