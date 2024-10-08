@extends('layouts.admin.file')
@section('page_title', 'プレビュー')
@section('title', 'プレビュー')

@section('content')
	<table>
	    <thead>
	        <tr>
	            <th>対象商品分類：</th>
	            <th>{{ $params['item_class_cd'] }}</th>
	        </tr>
	        <tr>
	            <th>{{ $params['item_class_name'] }}コード範囲：</th>
	            <th>{{ $params['startCode'] }}</th>
	            <th>～</th>
	            <th>{{ $params['endCode'] }}</th>
	        </tr>
	        <tr>
	            <th>商品コード範囲：</th>
	            <th>{{ $params['startItemCode'] }}</th>
	            <th>～</th>
	            <th>{{ $params['endItemCode'] }}</th>
	        </tr>
	        <tr>
	            <th>カラーコード範囲：</th>
	            <th>{{ $params['startColorCode'] }}</th>
	            <th>～</th>
	            <th>{{ $params['endColorCode'] }}</th>
	        </tr>
	        <tr>
	            <th>サイズコード範囲：</th>
	            <th>{{ $params['startSizeCode'] }}</th>
	            <th>～</th>
	            <th>{{ $params['endSizeCode'] }}</th>
	        </tr>
	        <tr>
	            <th>出力区分：</th>
	            <th>{{ $params['outputKbn'] }}</th>
	        </tr>
	        <tr>
	            <th>JANコード範囲：</th>
	            <th>{{ $params['startJanCode'] }}</th>
	            <th>～</th>
	            <th>{{ $params['endJanCode'] }}</th>
	        </tr>
	        <tr>
	            <th>処理日：</th>
	            <th>{{ $params['currentDate'] }}</th>
	        </tr>
	        <tr></tr>
	        <tr>
				<th>{{ $params['item_class_name'] }}コード</th>
				<th>{{ $params['item_class_name'] }}名</th>
				<th>商品コード</th>
				<th>商品名</th>
				<th>カラーコード</th>
				<th>カラー名</th>
				<th>サイズコード</th>
				<th>サイズ名</th>
				<th>JANコード</th>
				<th>税抜上代単価</th>
				<th>税込上代単価</th>
				<th>非表示フラグ</th>
	        </tr>
	    </thead>
	    <tbody>
	        @foreach($params['datas'] as $data)
	            <tr>
	                @if($params['item_class_cd'] === '1')
					    <td>{{ $data->item_class1_cd }}</td>
	                    <td>{{ $data->item_class1_name }}</td>
	                @elseif($params['item_class_cd'] === '2')
					    <td>{{ $data->item_class2_cd }}</td>
	                    <td>{{ $data->item_class2_name }}</td>
	                @elseif($params['item_class_cd'] === '3')
					    <td>{{ $data->item_class3_cd }}</td>
	                    <td>{{ $data->item_class3_name }}</td>
	                @elseif($params['item_class_cd'] === '4')
					    <td>{{ $data->item_class4_cd }}</td>
	                    <td>{{ $data->item_class4_name }}</td>
	                @elseif($params['item_class_cd'] === '5')
					    <td>{{ $data->item_class5_cd }}</td>
	                    <td>{{ $data->item_class5_name }}</td>
	                @elseif($params['item_class_cd'] === '6')
					    <td>{{ $data->item_class6_cd }}</td>
	                    <td>{{ $data->item_class6_name }}</td>
	                @elseif($params['item_class_cd'] === '7')
					    <td>{{ $data->item_class7_cd }}</td>
	                    <td>{{ $data->item_class7_name }}</td>
	                @endif
					<td>{{ $data->item_cd }}</td>
					<td>{{ $data->item_name }}</td>
					<td>{{ $data->color_cd }}</td>
	                <td>{{ $data->color_name }}</td>
	                <td>{{ $data->size_cd }}</td>
	                <td>{{ $data->size_name }}</td>
					<td>{{ $data->jan_cd }}</td>
					<td>{{ $data->retail_price_tax_out }}</td>
					<td>{{ $data->retail_price_tax_in }}</td>
					<td>{{ $data->hidden_flg }}</td>
	            </tr>
	        @endforeach
	    </tbody>
	</table>
@endsection
