@extends('layouts.admin.file')
@section('page_title', '一覧表')
@section('title', '一覧表')
@section('content')

<table>
    <thead>
        <tr>
            <th style="text-align:left;">倉庫：</th>
            <th style="text-align:left;">{{ $params['warehouseCode'] }}</th>
        </tr>
        <tr>
            <th style="text-align:left;">商品コード範囲：</th>
            <th style="text-align:left;">{{ $params['itemStartCode'] }}</th>
            <th style="text-align:left;">～</th>
            <th style="text-align:left;">{{ $params['itemEndCode'] }}</th>
        </tr>
        <tr>
            <th style="text-align:left;">カラーコード範囲：</th>
            <th style="text-align:left;">{{ $params['colorStartCode'] }}</th>
            <th style="text-align:left;">～</th>
            <th style="text-align:left;">{{ $params['colorEndCode'] }}</th>
        </tr>
        <tr>
            <th style="text-align:left;">サイズコード範囲：</th>
            <th style="text-align:left;">{{ $params['sizeStartCode'] }}</th>
            <th style="text-align:left;">～</th>
            <th style="text-align:left;">{{ $params['sizeEndCode'] }}</th>
        </tr>
        <tr>
            <th style="text-align:left;">棚番1範囲：</th>
            <th style="text-align:left;">{{ $params['shelfNumberCode1Start'] }}</th>
            <th style="text-align:left;">～</th>
            <th style="text-align:left;">{{ $params['shelfNumberCode1End'] }}</th>
        </tr>
        <tr>
            <th style="text-align:left;">棚番2範囲：</th>
            <th style="text-align:left;">{{ $params['shelfNumberCode2Start'] }}</th>
            <th style="text-align:left;">～</th>
            <th style="text-align:left;">{{ $params['shelfNumberCode2End'] }}</th>
        </tr>
        <tr>
            <th style="text-align:left;">処理日：</th>
            <th style="text-align:left;">{{ $params['currentDate'] }}</th>
        </tr>
        <tr></tr>
        <tr>
			<th style="text-align:left;">倉庫コード</th>
			<th style="text-align:left;">倉庫名</th>
			<th style="text-align:left;">ＪＡＮコード</th>
			<th style="text-align:left;">商品コード</th>
			<th style="text-align:left;">商品名</th>
			<th style="text-align:left;">カラーコード</th>
			<th style="text-align:left;">カラー名</th>
			<th style="text-align:left;">サイズコード</th>
			<th style="text-align:left;">サイズ名</th>
			<th style="text-align:left;">棚番１</th>
			<th style="text-align:left;">棚番２</th>
			<th style="text-align:left;">ランク</th>
		</tr>
    </thead>
    <tbody>
        @foreach($params['datas'] as $data)
            <tr>
				<td style="text-align:left;">{{ $data->warehouse_cd }}</td>
				<td style="text-align:left;">{{ $data->warehouse_name }}</td>
				<td style="text-align:left;">{{ $data->jan_cd }}</td>
				<td style="text-align:left;">{{ $data->item_cd }}</td>
				<td style="text-align:left;">{{ $data->item_name }}</td>
				<td style="text-align:left;">{{ $data->color_cd }}</td>
				<td style="text-align:left;">{{ $data->color_name }}</td>
				<td style="text-align:left;">{{ $data->size_cd }}</td>
				<td style="text-align:left;">{{ $data->size_name }}</td>
				<td style="text-align:left;">{{ $data->shelf_number_1 }}</td>
				<td style="text-align:left;">{{ $data->shelf_number_2 }}</td>
				<td style="text-align:left;">{{ $data->rank }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
@endsection