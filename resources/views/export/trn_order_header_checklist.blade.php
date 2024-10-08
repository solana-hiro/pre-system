@extends('layouts.admin.file')
@section('page_title', '一覧表')
@section('title', '一覧表')
@section('content')

<table>
    <thead>
        <tr>
            <th style="text-align:left;">帳票区分：</th>
            <th style="text-align:left;">{{ $params['warehouseCode'] }}</th>
        </tr>
        <tr>
            <th style="text-align:left;">出力順：</th>
            <th style="text-align:left;">{{ $params['warehouseCode'] }}</th>
        </tr>
        <tr>
            <th style="text-align:left;">対象日付：</th>
            <th style="text-align:left;">{{ $params['itemStartCode'] }}</th>
            <th style="text-align:left;">～</th>
            <th style="text-align:left;">{{ $params['itemEndCode'] }}</th>
        </tr>
        <tr>
            <th style="text-align:left;">処理区分：</th>
            <th style="text-align:left;">{{ $params['warehouseCode'] }}</th>
        </tr>
        <tr>
            <th style="text-align:left;">入力者コード範囲：</th>
            <th style="text-align:left;">{{ $params['colorStartCode'] }}</th>
            <th style="text-align:left;">～</th>
            <th style="text-align:left;">{{ $params['colorEndCode'] }}</th>
        </tr>
        <tr>
            <th style="text-align:left;">仕入先コード範囲：</th>
            <th style="text-align:left;">{{ $params['sizeStartCode'] }}</th>
            <th style="text-align:left;">～</th>
            <th style="text-align:left;">{{ $params['sizeEndCode'] }}</th>
        </tr>
        <tr>
            <th style="text-align:left;">担当者コード範囲：</th>
            <th style="text-align:left;">{{ $params['shelfNumberCode1Start'] }}</th>
            <th style="text-align:left;">～</th>
            <th style="text-align:left;">{{ $params['shelfNumberCode1End'] }}</th>
        </tr>
        <tr>
            <th style="text-align:left;">発注伝票No範囲：</th>
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
			<th style="text-align:left;">更新日付</th>
			<th style="text-align:left;">処理区分</th>
			<th style="text-align:left;">発注見出NO</th>
			<th style="text-align:left;">相手先NO</th>
			<th style="text-align:left;">発注年</th>
			<th style="text-align:left;">発注月</th>
			<th style="text-align:left;">発注日</th>
			<th style="text-align:left;">仕入先分類1コード</th>
			<th style="text-align:left;">仕入先分類1名</th>
			<th style="text-align:left;">仕入先分類2コード</th>
			<th style="text-align:left;">仕入先分類2名</th>
			<th style="text-align:left;">仕入先分類3コード</th>
			<th style="text-align:left;">仕入先分類3名</th>
			<th style="text-align:left;">仕入先コード</th>
			<th style="text-align:left;">仕入先略称</th>
			<th style="text-align:left;">納品先コード</th>
			<th style="text-align:left;">納品先略称</th>
			<th style="text-align:left;">担当者コード</th>
			<th style="text-align:left;">担当者名</th>
			<th style="text-align:left;">部門コード</th>
			<th style="text-align:left;">部門名</th>
			<th style="text-align:left;">入庫倉庫名</th>
			<th style="text-align:left;">入力者コード</th>
			<th style="text-align:left;">入力者名</th>
			<th style="text-align:left;">行NO</th>
			<th style="text-align:left;">ブランド1コード</th>
			<th style="text-align:left;">ブランド1名</th>
			<th style="text-align:left;">競技・カテゴリコード</th>
			<th style="text-align:left;">競技・カテゴリ名</th>
			<th style="text-align:left;">ジャンルコード</th>
			<th style="text-align:left;">ジャンル名</th>
			<th style="text-align:left;">販売開始年コード</th>
			<th style="text-align:left;">販売開始年名</th>
			<th style="text-align:left;">工場分類5コード</th>
			<th style="text-align:left;">工場分類5名</th>
			<th style="text-align:left;">製品/工賃6コード</th>
			<th style="text-align:left;">製品/工賃6名</th>
			<th style="text-align:left;">資産在庫JAコード</th>
			<th style="text-align:left;">資産在庫JA名</th>
			<th style="text-align:left;">商品コード</th>
			<th style="text-align:left;">商品名1</th>
			<th style="text-align:left;">発注数量</th>
			<th style="text-align:left;">単位名</th>
			<th style="text-align:left;">発注単価</th>
			<th style="text-align:left;">発注金額</th>
			<th style="text-align:left;">指定納期</th>
			<th style="text-align:left;">明細備考</th>
			<th style="text-align:left;">完了区分</th>
			<th style="text-align:left;">伝票備考</th>
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