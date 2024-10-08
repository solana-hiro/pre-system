@extends('layouts.admin.file')
@section('page_title', '一覧表')
@section('title', '一覧表')
@section('content')

<table>
    <thead>
        <tr>
            <th style="text-align:left;">対象商品分類：</th>
            <th style="text-align:left;">{{ $params['item_class_cd'] }}</th>
        </tr>
        <tr>
            <th style="text-align:left;">{{ $params['item_class_name'] }}コード範囲：</th>
            <th style="text-align:left;">{{ $params['startCode'] }}</th>
            <th style="text-align:left;">～</th>
            <th style="text-align:left;">{{ $params['endCode'] }}</th>
        </tr>
        <tr>
            <th style="text-align:left;">商品コード範囲：</th>
            <th style="text-align:left;">{{ $params['startItemCode'] }}</th>
            <th style="text-align:left;">～</th>
            <th style="text-align:left;">{{ $params['endItemCode'] }}</th>
        </tr>
        <tr>
            <th style="text-align:left;">カラーコード範囲：</th>
            <th style="text-align:left;">{{ $params['startColorCode'] }}</th>
            <th style="text-align:left;">～</th>
            <th style="text-align:left;">{{ $params['endColorCode'] }}</th>
        </tr>
        <tr>
            <th style="text-align:left;">サイズコード範囲：</th>
            <th style="text-align:left;">{{ $params['startSizeCode'] }}</th>
            <th style="text-align:left;">～</th>
            <th style="text-align:left;">{{ $params['endSizeCode'] }}</th>
        </tr>
        <tr>
            <th style="text-align:left;">出力区分：</th>
            <th style="text-align:left;">{{ $params['outputKbn'] }}</th>
        </tr>
        <tr>
            <th style="text-align:left;">JANコード範囲：</th>
            <th style="text-align:left;">{{ $params['startJanCode'] }}</th>
            <th style="text-align:left;">～</th>
            <th style="text-align:left;">{{ $params['endJanCode'] }}</th>
        </tr>
        <tr>
            <th style="text-align:left;">処理日：</th>
            <th style="text-align:left;">{{ $params['currentDate'] }}</th>
        </tr>
        <tr></tr>
        <tr>
			<th style="text-align:left;">{{ $params['item_class_name'] }}コード</th>
			<th style="text-align:left;">{{ $params['item_class_name'] }}名</th>
			<th style="text-align:left;">商品コード</th>
			<th style="text-align:left;">商品名</th>
			<th style="text-align:left;">カラーコード</th>
			<th style="text-align:left;">カラー名</th>
			<th style="text-align:left;">サイズコード</th>
			<th style="text-align:left;">サイズ名</th>
			<th style="text-align:left;">JANコード</th>
			<th style="text-align:left;">税抜上代単価</th>
			<th style="text-align:left;">税込上代単価</th>
			<th style="text-align:left;">非表示フラグ</th>
        </tr>
    </thead>
    <tbody>
        @foreach($params['datas'] as $data)
            <tr>
                @if($params['item_class_cd'] === '1')
				    <td style="text-align:left;">{{ $data->item_class1_cd }}</td>
                    <td style="text-align:left;">{{ $data->item_class1_name }}</td>
                @elseif($params['item_class_cd'] === '2')
				    <td style="text-align:left;">{{ $data->item_class2_cd }}</td>
                    <td style="text-align:left;">{{ $data->item_class2_name }}</td>
                @elseif($params['item_class_cd'] === '3')
				    <td style="text-align:left;">{{ $data->item_class3_cd }}</td>
                    <td style="text-align:left;">{{ $data->item_class3_name }}</td>
                @elseif($params['item_class_cd'] === '4')
				    <td style="text-align:left;">{{ $data->item_class4_cd }}</td>
                    <td style="text-align:left;">{{ $data->item_class4_name }}</td>
                @elseif($params['item_class_cd'] === '5')
				    <td style="text-align:left;">{{ $data->item_class5_cd }}</td>
                    <td style="text-align:left;">{{ $data->item_class5_name }}</td>
                @elseif($params['item_class_cd'] === '6')
				    <td style="text-align:left;">{{ $data->item_class6_cd }}</td>
                    <td style="text-align:left;">{{ $data->item_class6_name }}</td>
                @elseif($params['item_class_cd'] === '7')
				    <td style="text-align:left;">{{ $data->item_class7_cd }}</td>
                    <td style="text-align:left;">{{ $data->item_class7_name }}</td>
                @endif
				<td style="text-align:left;">{{ $data->item_cd }}</td>
				<td style="text-align:left;">{{ $data->item_name }}</td>
				<td style="text-align:left;">{{ $data->color_cd }}</td>
                <td style="text-align:left;">{{ $data->color_name }}</td>
                <td style="text-align:left;">{{ $data->size_cd }}</td>
                <td style="text-align:left;">{{ $data->size_name }}</td>
				<td style="text-align:left;">{{ $data->jan_cd }}</td>
				<td style="text-align:left;">{{ $data->retail_price_tax_out }}</td>
				<td style="text-align:left;">{{ $data->retail_price_tax_in }}</td>
				<td style="text-align:left;">{{ $data->hidden_flg }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
@endsection