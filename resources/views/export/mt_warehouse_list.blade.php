@extends('layouts.admin.file')
@section('page_title', '一覧表')
@section('title', '一覧表')
@section('content')

<table>
    <thead>
        <tr>
            <th style="text-align:left;">倉庫コード範囲：</th>
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
			<th style="text-align:left;">倉庫コード</th>
			<th style="text-align:left;">倉庫名</th>
			<th style="text-align:left;">倉庫名カナ</th>
			<th style="text-align:left;">倉庫種別</th>
			<th style="text-align:left;">分析用各倉庫区分</th>
			<th style="text-align:left;">資産在庫有効区分</th>
			<th style="text-align:left;">削除区分</th>
		</tr>
    </thead>
    <tbody>
        @foreach($params['datas'] as $data)
            <tr>
				<td style="text-align:left;">{{ $data->warehouse_cd }}</td>
				<td style="text-align:left;">{{ $data->warehouse_name }}</td>
				<td style="text-align:left;">{{ $data->warehouse_name_kana }}</td>
				<td style="text-align:left;">@if($data->warehouse_kind === 0) {{ "通常" }} @elseif($data->warehouse_kind === 1) {{ "委託" }} @elseif($data->warehouse_kind === 2) {{ "直営" }} @endif</td>
				<td style="text-align:left;">{{ $data->analysis_warehouse_kbn }}</td>
				<td style="text-align:left;">{{ $data->asset_stock_validity_kbn }}</td>
				<td style="text-align:left;">{{ $data->del_kbn }}</td>
            </tr>
        @endforeach
    </tbody>
</table>

@endsection