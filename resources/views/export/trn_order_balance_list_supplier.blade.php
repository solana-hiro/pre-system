@extends('layouts.admin.file')
@section('page_title', '一覧表')
@section('title', '一覧表')
@section('content')

<table>
    <thead>
        <tr>
            <th style="text-align:left;">仕入先コード範囲：</th>
            <th style="text-align:left;">{{ $params['colorStartCode'] }}</th>
            <th style="text-align:left;">～</th>
            <th style="text-align:left;">{{ $params['colorEndCode'] }}</th>
        </tr>
        <tr>
            <th style="text-align:left;">対象納期日付：</th>
            <th style="text-align:left;">{{ $params['sizeStartCode'] }}</th>
            <th style="text-align:left;">～</th>
            <th style="text-align:left;">{{ $params['sizeEndCode'] }}</th>
        </tr>
        <tr>
            <th style="text-align:left;">処理日：</th>
            <th style="text-align:left;">{{ $params['currentDate'] }}</th>
        </tr>
        <tr></tr>
        <tr>
			<th style="text-align:left;">仕入先コード</th>
			<th style="text-align:left;">仕入先名</th>
			<th style="text-align:left;">指定納期</th>
			<th style="text-align:left;">発注NO</th>
			<th style="text-align:left;">発注日付</th>
			<th style="text-align:left;">納品先コード</th>
			<th style="text-align:left;">納品先名</th>
			<th style="text-align:left;">相手先NO</th>
			<th style="text-align:left;">行NO</th>
			<th style="text-align:left;">商品コード</th>
			<th style="text-align:left;">商品名</th>
			<th style="text-align:left;">発注数量</th>
			<th style="text-align:left;">単位名</th>
			<th style="text-align:left;">発注単価</th>
			<th style="text-align:left;">発注金額</th>
			<th style="text-align:left;">仕入数量</th>
			<th style="text-align:left;">発注残数量</th>
			<th style="text-align:left;">発注残金額</th>
			<th style="text-align:left;">カラーコード</th>
			<th style="text-align:left;">カラー名</th>
			<th style="text-align:left;">サイズコード1</th>
			<th style="text-align:left;">サイズ名1</th>
			<th style="text-align:left;">サイズコード2</th>
			<th style="text-align:left;">サイズ名2</th>
			<th style="text-align:left;">サイズコード3</th>
			<th style="text-align:left;">サイズ名3</th>
			<th style="text-align:left;">サイズコード4</th>
			<th style="text-align:left;">サイズ名4</th>
			<th style="text-align:left;">サイズコード5</th>
			<th style="text-align:left;">サイズ名5</th>
			<th style="text-align:left;">サイズコード6</th>
			<th style="text-align:left;">サイズ名6</th>
			<th style="text-align:left;">サイズコード7</th>
			<th style="text-align:left;">サイズ名7</th>
			<th style="text-align:left;">サイズコード8</th>
			<th style="text-align:left;">サイズ名8</th>
			<th style="text-align:left;">サイズコード9</th>
			<th style="text-align:left;">サイズ名9</th>
			<th style="text-align:left;">サイズコード10</th>
			<th style="text-align:left;">サイズ名10</th>
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