@extends('layouts.admin.file')
@section('page_title', 'プレビュー')
@section('title', 'プレビュー')

@section('content')
	<table>
	    <thead>
	        <tr>
	            <th>倉庫コード範囲：</th>
	            <th>{{ $params['startCode'] }}</th>
	            <th>～</th>
	            <th>{{ $params['endCode'] }}</th>
	        </tr>
	        <tr>
	            <th>処理日：</th>
	            <th>{{ $params['currentDate'] }}</th>
	        </tr>
	        <tr></tr>
	        <tr>
				<th>倉庫コード</th>
				<th>倉庫名</th>
				<th>倉庫名カナ</th>
				<th>倉庫種別</th>
				<th>分析用各倉庫区分</th>
				<th>資産在庫有効区分</th>
				<th>削除区分</th>
			</tr>
	    </thead>
	    <tbody>
	        @foreach($params['datas'] as $data)
	            <tr>
					<td>{{ $data->warehouse_cd }}</td>
					<td>{{ $data->warehouse_name }}</td>
					<td>{{ $data->warehouse_name_kana }}</td>
					<td>@if($data->warehouse_kind === 0) {{ "通常" }} @elseif($data->warehouse_kind === 1) {{ "委託" }} @elseif($data->warehouse_kind === 2) {{ "直営" }} @endif</td>
					<td>{{ $data->analysis_warehouse_kbn }}</td>
					<td>{{ $data->asset_stock_validity_kbn }}</td>
					<td>{{ $data->del_kbn }}</td>
	            </tr>
	        @endforeach
	    </tbody>
	</table>
@endsection