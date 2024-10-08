@extends('layouts.admin.file')
@section('page_title', '一覧表')
@section('title', '一覧表')
@section('content')

<table>
    <thead>
        <tr>
            <th style="text-align:left;">対象商品分類：</th>
            <th style="text-align:left;">{{ $params['itemClassId'] }}</th>
        </tr>
        <tr>
            <th style="text-align:left;">{{ $params['itemClassName'] }}コード範囲：</th>
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
			<th style="text-align:left;">{{ $params['itemClassName'] }}コード</th>
			<th style="text-align:left;">{{ $params['itemClassName'] }}名</th>
			<th style="text-align:left;">EC表示</th>
        </tr>
    </thead>
    <tbody>
        @foreach($params['datas'] as $data)
            <tr>
				<td style="text-align:left;">{{ $data->item_class_cd }}</td>
				<td style="text-align:left;">{{ $data->item_class_name }}</td>
				<td style="text-align:left;">{{ $data->ec_display_flg === 0 ? "非表示" : "表示" }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
@endsection