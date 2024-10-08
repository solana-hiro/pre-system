@extends('layouts.admin.file')
@section('page_title', '一覧表')
@section('title', '一覧表')
@section('content')

<table>
    <thead>
        <tr>
            <th style="text-align:left;">運送会社コード範囲：</th>
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
			<th style="text-align:left;">運送会社コード</th>
			<th style="text-align:left;">運送会社名</th>
			<th style="text-align:left;">送り状種別</th>
			<th style="text-align:left;">荷札種別</th>
		</tr>
    </thead>
    <tbody>
        @foreach($params['datas'] as $data)
            <tr>
				<td style="text-align:left;">{{ $data->shipping_company_cd }}</td>
				<td style="text-align:left;">{{ $data->shipping_company_name }}</td>
				<td style="text-align:left;">{{ $data->slip_kind_7_cd }}</td>
				<td style="text-align:left;">{{ $data->slip_kind_17_cd }}</td>
            </tr>
        @endforeach
    </tbody>
</table>

@endsection