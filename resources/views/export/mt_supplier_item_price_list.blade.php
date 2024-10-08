@extends('layouts.admin.file')
@section('page_title', '一覧表')
@section('title', '一覧表')
@section('content')

<table>
    <thead>
        <tr>
            <th style="text-align:left;">仕入先コード範囲：</th>
            <th style="text-align:left;">{{ $params['supplierStartCode'] }}</th>
            <th style="text-align:left;">～</th>
            <th style="text-align:left;">{{ $params['supplierEndCode'] }}</th>
        </tr>
        <tr>
            <th style="text-align:left;">商品コード範囲：</th>
            <th style="text-align:left;">{{ $params['itemStartCode'] }}</th>
            <th style="text-align:left;">～</th>
            <th style="text-align:left;">{{ $params['itemEndCode'] }}</th>
        </tr>
        <tr>
            <th style="text-align:left;">処理日：</th>
            <th style="text-align:left;">{{ $params['currentDate'] }}</th>
        </tr>
        <tr></tr>
        <tr>
			<th style="text-align:left;">仕入先コード</th>
			<th style="text-align:left;">仕入先名</th>
			<th style="text-align:left;">商品コード</th>
			<th style="text-align:left;">商品名</th>
			<th style="text-align:left;">仕入単価設定日</th>
			<th style="text-align:left;">税抜仕入単価</th>
            <th style="text-align:left;">税込仕入単価</th>
        </tr>
    </thead>
    <tbody>
        @foreach($params['datas'] as $data)
            <tr>
				<td style="text-align:left;">{{ $data->supplier_cd }}</td>
				<td style="text-align:left;">{{ $data->supplier_name }}</td>
				<td style="text-align:left;">{{ $data->item_cd }}</td>
				<td style="text-align:left;">{{ $data->item_name }}</td>
				<td style="text-align:left;">{{ $data->set_date }}</td>
				<td style="text-align:left;">{{ $data->tax_kbn === 1 ? $data->price : 0 }}</td>
				<td style="text-align:left;">{{ $data->tax_kbn === 1 ? 0 : $data->price }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
@endsection
