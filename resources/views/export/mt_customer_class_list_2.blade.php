@extends('layouts.admin.file')
@section('page_title', '一覧表')
@section('title', '一覧表')
@section('content')

<table>
    <thead>
        <tr>
            <th style="text-align:left;">対象得意先分類：</th>
            <th style="text-align:left;">{{ $params['customer_class_thing_id'] }}</th>
        </tr>
        <tr>
            <th style="text-align:left;">業種・特徴2コード範囲：</th>
            <th style="text-align:left;">{{ $params['startDate'] }}</th>
            <th style="text-align:left;">～</th>
            <th style="text-align:left;">{{ $params['endDate'] }}</th>
        </tr>
        <tr>
            <th style="text-align:left;">処理日：</th>
            <th style="text-align:left;">{{ $params['currentDate'] }}</th>
        </tr>
        <tr></tr>
        <tr>
			<th style="text-align:left;">業種・特徴2コード</th>
			<th style="text-align:left;">業種・特徴2名</th>
        </tr>
    </thead>
    <tbody>
        @foreach($params['datas'] as $data)
            <tr>
                <td style="text-align:left;">{{ $data->customer_class_cd }}</td>
                <td style="text-align:left;">{{ $data->customer_class_name }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
@endsection
