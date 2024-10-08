@extends('layouts.admin.file')
@section('page_title', '一覧表')
@section('title', '一覧表')
@section('content')

<table>
    <thead>
        <tr>
            <th style="text-align:left;">対象仕入先分類：</th>
            <th style="text-align:left;">{{ $params['supplier_class_thing_id'] }}</th>
        </tr>
        <tr>
            <th style="text-align:left;">仕入先分類3コード範囲：</th>
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
			<th style="text-align:left;">仕入先分類3コード</th>
			<th style="text-align:left;">仕入先分類3名</th>
        </tr>
    </thead>
    <tbody>
        @foreach($params['datas'] as $data)
            <tr>
                <td style="text-align:left;">{{ $data->supplier_class_cd }}</td>
                <td style="text-align:left;">{{ $data->supplier_class_name }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
@endsection