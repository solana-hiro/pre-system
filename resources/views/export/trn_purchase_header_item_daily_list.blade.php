@extends('layouts.admin.file')
@section('page_title', '一覧表')
@section('title', '一覧表')
@section('content')

<table>
    <thead>
        <tr>
            <th style="text-align:left;">対象伝票日付：</th>
            <th style="text-align:left;">{{ $params['sizeStartCode'] }}</th>
            <th style="text-align:left;">～</th>
            <th style="text-align:left;">{{ $params['sizeEndCode'] }}</th>
        </tr>
        <tr>
            <th style="text-align:left;">商品コード範囲：</th>
            <th style="text-align:left;">{{ $params['colorStartCode'] }}</th>
            <th style="text-align:left;">～</th>
            <th style="text-align:left;">{{ $params['colorEndCode'] }}</th>
        </tr>
        <tr>
            <th style="text-align:left;">処理日：</th>
            <th style="text-align:left;">{{ $params['currentDate'] }}</th>
        </tr>
        <tr></tr>
        <tr>
			<th style="text-align:left;">商品コード</th>
			<th style="text-align:left;">商品名</th>
			<th style="text-align:left;">仕入数量</th>
			<th style="text-align:left;">仕入金額</th>
			<th style="text-align:left;">掛仕入数量</th>
			<th style="text-align:left;">掛仕入金額</th>
			<th style="text-align:left;">掛返品数量</th>
			<th style="text-align:left;">掛返品金額</th>
			<th style="text-align:left;">掛値引数量</th>
			<th style="text-align:left;">掛値引金額</th>
			<th style="text-align:left;">現金仕入数量</th>
			<th style="text-align:left;">現金仕入金額</th>
			<th style="text-align:left;">現金返品数量</th>
			<th style="text-align:left;">現金返品金額</th>
			<th style="text-align:left;">現金値引数量</th>
			<th style="text-align:left;">現金値引金額</th>
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