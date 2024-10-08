@extends('layouts.admin.file')
@section('page_title', '一覧表')
@section('title', '一覧表')
@section('content')

<table>
    <thead>
        <tr>
            <th style="text-align:left;">銀行コード範囲：</th>
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
			<th style="text-align:left;">銀行コード</th>
			<th style="text-align:left;">銀行名</th>
        </tr>
    </thead>
    <tbody>
        @foreach($params['datas'] as $data)
            <tr>
				<td style="text-align:left;">{{ $data->bank_cd }}</td>
				<td style="text-align:left;">{{ $data->bank_name }}</td>
            </tr>
        @endforeach
    </tbody>
</table>

@endsection
