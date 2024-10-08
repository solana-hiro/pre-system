@extends('layouts.admin.file')
@section('page_title', 'プレビュー')
@section('title', 'プレビュー')

@section('content')

	<table>
	    <thead>
	        <tr>
	            <th>ブランド1コード範囲：</th>
	            <th>{{ $params['itemClass1Start'] }}</th>
	            <th>～</th>
	            <th>{{ $params['itemClass1End'] }}</th>
	        </tr>
	        <tr>
	            <th>競技・カテゴリコード範囲：</th>
	            <th>{{ $params['itemClass2Start'] }}</th>
	            <th>～</th>
	            <th>{{ $params['itemClass2End'] }}</th>
	        </tr>
	        <tr>
	            <th>ジャンルコード範囲：</th>
	            <th>{{ $params['itemClass3Start'] }}</th>
	            <th>～</th>
	            <th>{{ $params['itemClass3End'] }}</th>
	        </tr>
	        <tr>
	            <th>販売開始年コード範囲：</th>
	            <th>{{ $params['itemClass4Start'] }}</th>
	            <th>～</th>
	            <th>{{ $params['itemClass4End'] }}</th>
	        </tr>
	        <tr>
	            <th>工場分類5コード範囲：</th>
	            <th>{{ $params['itemClass5Start'] }}</th>
	            <th>～</th>
	            <th>{{ $params['itemClass5End'] }}</th>
	        </tr>
	        <tr>
	            <th>製品/工賃6コード範囲：</th>
	            <th>{{ $params['itemClass6Start'] }}</th>
	            <th>～</th>
	            <th>{{ $params['itemClass6End'] }}</th>
	        </tr>
	        <tr>
	            <th>資産在庫JAコード範囲：</th>
	            <th>{{ $params['itemClass7Start'] }}</th>
	            <th>～</th>
	            <th>{{ $params['itemClass7End'] }}</th>
	        </tr>
	        <tr>
	            <th>商品コード範囲：</th>
	            <th>{{ $params['itemCodeStart'] }}</th>
	            <th>～</th>
	            <th>{{ $params['itemCodeEnd'] }}</th>
	        </tr>
	        <tr>
	            <th>他品番範囲：</th>
	            <th>{{ $params['otherPartNumberStart'] }}</th>
	            <th>～</th>
	            <th>{{ $params['otherPartNumberEnd'] }}</th>
	        </tr>
	        <tr>
	            <th>処理日：</th>
	            <th>{{ $params['currentDate'] }}</th>
	        </tr>
	        <tr></tr>
	        <tr>
				<th>商品コード</th>
				<th>商品名</th>
				<th>名カナ</th>
				<th>単位名</th>
				<th>仕入先コード</th>
				<th>ブランド1コード</th>
				<th>ブランド1名</th>
				<th>競技・カテゴリコード</th>
				<th>競技・カテゴリ名</th>
				<th>ジャンルコード</th>
				<th>ジャンル名</th>
				<th>販売開始年コード</th>
				<th>販売開始年名</th>
				<th>工場分類5コード</th>
				<th>工場分類5名</th>
				<th>製品/工賃6コード</th>
				<th>製品/工賃6名</th>
				<th>資産在庫JAコード</th>
				<th>資産在庫JA名</th>
				<th>商品区分</th>
				<th>在庫管理区分</th>
				<th>非課税区分</th>
				<th>税率区分コード</th>
				<th>税率区分名</th>
				<th>税抜上代単価</th>
				<th>税込上代単価</th>
				<th>税抜参考上代単価</th>
				<th>税込参考上代単価</th>
				<th>税抜仕入単価</th>
				<th>税込仕入単価</th>
				<th>原価単価</th>
				<th>粗利算出用原価単価</th>
				<th>名称入力区分</th>
				<th>削除区分</th>
				<th>他品番</th>
				<th>メンバーサイト連携区分</th>
				<th>メンバーサイト商品コード</th>
				<th>メンバーサイト商品名</th>
				<th>日本郵政連携済区分</th>
				<th>商品備考1</th>
				<th>商品備考2</th>
				<th>商品備考3</th>
				<th>商品備考4</th>
				<th>商品備考5</th>
				<th>カラーコード</th>
				<th>カラー名</th>
				<th>サイズコード1</th>
				<th>サイズ名1</th>
				<th>JANコード1</th>
				<th>サイズコード2</th>
				<th>サイズ名2</th>
				<th>JANコード2</th>
				<th>サイズコード3</th>
				<th>サイズ名3</th>
				<th>JANコード3</th>
				<th>サイズコード4</th>
				<th>サイズ名4</th>
				<th>JANコード4</th>
				<th>サイズコード5</th>
				<th>サイズ名5</th>
				<th>JANコード5</th>
				<th>サイズコード6</th>
				<th>サイズ名6</th>
				<th>JANコード6</th>
				<th>サイズコード7</th>
				<th>サイズ名7</th>
				<th>JANコード7</th>
				<th>サイズコード8</th>
				<th>サイズ名8</th>
				<th>JANコード8</th>
				<th>サイズコード9</th>
				<th>サイズ名9</th>
				<th>JANコード9</th>
				<th>サイズコード10</th>
				<th>サイズ名10</th>
				<th>JANコード10</th>
	        </tr>
	    </thead>
	    <tbody>
	        @foreach($params['datas']['mtItem'] as $datas)
	            @foreach($datas['colors'] as $data)
	                <tr>
	                    <td>{{ $datas->item_cd }}</td>
	                    <td>{{ $datas->item_name }}</td>
	                    <td>{{ $datas->item_name_kana }}</td>
	                    <td>{{ $datas->unit }}</td>
	                    <td>{{ $datas->supplier_cd }}</td>
	                    <td>{{ $datas->item_class_cd_1 }}</td>
	                    <td>{{ $datas->item_class_name_1 }}</td>
	                    <td>{{ $datas->item_class_cd_2 }}</td>
	                    <td>{{ $datas->item_class_name_2 }}</td>
	                    <td>{{ $datas->item_class_cd_3 }}</td>
	                    <td>{{ $datas->item_class_name_3 }}</td>
	                    <td>{{ $datas->item_class_cd_4 }}</td>
	                    <td>{{ $datas->item_class_name_4 }}</td>
	                    <td>{{ $datas->item_class_cd_5 }}</td>
	                    <td>{{ $datas->item_class_name_5 }}</td>
	                    <td>{{ $datas->item_class_cd_6 }}</td>
	                    <td>{{ $datas->item_class_name_6 }}</td>
	                    <td>{{ $datas->item_class_cd_7 }}</td>
	                    <td>{{ $datas->item_class_name_7 }}</td>
	                    <td>{{ $datas->item_kbn }}</td>
	                    <td>{{ $datas->stock_management_kbn }}</td>
	                    <td>{{ $datas->non_tax_kbn }}</td>
	                    <td>{{ $datas->tax_rate_kbn_cd }}</td>
	                    <td>{{ $params['datas']['defTaxRateKbn']->where('id', $datas->def_tax_rate_kbns_id)->first()['tax_rate_kbn_name'] }}</td>
	                    <td>{{ $datas->retail_price_tax_out }}</td>
	                    <td>{{ $datas->retail_price_tax_in }}</td>
	                    <td>{{ $datas->reference_retail_tax_out }}</td>
	                    <td>{{ $datas->reference_retail_tax_in }}</td>
	                    <td>{{ $datas->purchase_price_tax_out }}</td>
	                    <td>{{ $datas->purchase_price_tax_in }}</td>
	                    <td>{{ $datas->cost_price }}</td>
	                    <td>{{ $datas->profit_calculation_cost_price }}</td>
	                    <td>{{ $datas->name_input_kbn }}</td>
	                    <td>{{ $datas->del_kbn }}</td>
	                    <td>{{ $datas->other_part_number }}</td>
	                    <td>{{ $datas->ec_alignment_kbn }}</td>
	                    <td>{{ $datas->ec_item_cd }}</td>
	                    <td>{{ $datas->ec_item_name }}</td>
	                    <td>{{ $datas->japan_post_office }}</td>
	                    <td>{{ $datas->item_memo_1 }}</td>
	                    <td>{{ $datas->item_memo_2 }}</td>
	                    <td>{{ $datas->item_memo_3 }}</td>
	                    <td>{{ $datas->item_memo_4 }}</td>
	                    <td>{{ $datas->item_memo_5 }}</td>
	                    <td>{{ isset($data['mt_color_id']) ? $params['datas']['mtColor']->where('id', $data['mt_color_id'])->first()['color_cd'] : '' }}</td>
	                    <td>{{ isset($data['mt_color_id']) ? $params['datas']['mtColor']->where('id', $data['mt_color_id'])->first()['color_name'] : '' }}</td>
	                    <td>{{ isset($data['size'][0]->mt_size_id) ? $params['datas']['mtSize']->where('id', $data['size'][0]->mt_size_id)->first()['size_cd'] : ''}}</td>
	                    <td>{{ isset($data['size'][0]->mt_size_id) ? $params['datas']['mtSize']->where('id', $data['size'][0]->mt_size_id)->first()['size_name'] : ''}}</td>
	                    <td>{{ isset($data['size'][0]['jan_cd']) ? $data['size'][0]['jan_cd'] : ''}}</td>
	                    <td>{{ isset($data['size'][1]->mt_size_id) ? $params['datas']['mtSize']->where('id', $data['size'][1]->mt_size_id)->first()['size_cd'] : ''}}</td>
	                    <td>{{ isset($data['size'][1]->mt_size_id) ? $params['datas']['mtSize']->where('id', $data['size'][1]->mt_size_id)->first()['size_name'] : ''}}</td>
	                    <td>{{ isset($data['size'][1]['jan_cd']) ? $data['size'][1]['jan_cd'] : ''}}</td>
	                    <td>{{ isset($data['size'][2]->mt_size_id) ? $params['datas']['mtSize']->where('id', $data['size'][2]->mt_size_id)->first()['size_cd'] : ''}}</td>
	                    <td>{{ isset($data['size'][2]->mt_size_id) ? $params['datas']['mtSize']->where('id', $data['size'][2]->mt_size_id)->first()['size_name'] : ''}}</td>
	                    <td>{{ isset($data['size'][2]['jan_cd']) ? $data['size'][2]['jan_cd'] : ''}}</td>
	                    <td>{{ isset($data['size'][3]->mt_size_id) ? $params['datas']['mtSize']->where('id', $data['size'][3]->mt_size_id)->first()['size_cd'] : ''}}</td>
	                    <td>{{ isset($data['size'][3]->mt_size_id) ? $params['datas']['mtSize']->where('id', $data['size'][3]->mt_size_id)->first()['size_name'] : ''}}</td>
	                    <td>{{ isset($data['size'][3]['jan_cd']) ? $data['size'][3]['jan_cd'] : ''}}</td>
	                    <td>{{ isset($data['size'][4]->mt_size_id) ? $params['datas']['mtSize']->where('id', $data['size'][4]->mt_size_id)->first()['size_cd'] : ''}}</td>
	                    <td>{{ isset($data['size'][4]->mt_size_id) ? $params['datas']['mtSize']->where('id', $data['size'][4]->mt_size_id)->first()['size_name'] : ''}}</td>
	                    <td>{{ isset($data['size'][4]['jan_cd']) ? $data['size'][4]['jan_cd'] : ''}}</td>
	                    <td>{{ isset($data['size'][5]->mt_size_id) ? $params['datas']['mtSize']->where('id', $data['size'][5]->mt_size_id)->first()['size_cd'] : ''}}</td>
	                    <td>{{ isset($data['size'][5]->mt_size_id) ? $params['datas']['mtSize']->where('id', $data['size'][5]->mt_size_id)->first()['size_name'] : ''}}</td>
	                    <td>{{ isset($data['size'][5]['jan_cd']) ? $data['size'][5]['jan_cd'] : ''}}</td>
	                    <td>{{ isset($data['size'][6]->mt_size_id) ? $params['datas']['mtSize']->where('id', $data['size'][6]->mt_size_id)->first()['size_cd'] : ''}}</td>
	                    <td>{{ isset($data['size'][6]->mt_size_id) ? $params['datas']['mtSize']->where('id', $data['size'][6]->mt_size_id)->first()['size_name'] : ''}}</td>
	                    <td>{{ isset($data['size'][6]['jan_cd']) ? $data['size'][6]['jan_cd'] : ''}}</td>
	                    <td>{{ isset($data['size'][7]->mt_size_id) ? $params['datas']['mtSize']->where('id', $data['size'][7]->mt_size_id)->first()['size_cd'] : ''}}</td>
	                    <td>{{ isset($data['size'][7]->mt_size_id) ? $params['datas']['mtSize']->where('id', $data['size'][7]->mt_size_id)->first()['size_name'] : ''}}</td>
	                    <td>{{ isset($data['size'][7]['jan_cd']) ? $data['size'][7]['jan_cd'] : ''}}</td>
	                    <td>{{ isset($data['size'][8]->mt_size_id) ? $params['datas']['mtSize']->where('id', $data['size'][8]->mt_size_id)->first()['size_cd'] : ''}}</td>
	                    <td>{{ isset($data['size'][8]->mt_size_id) ? $params['datas']['mtSize']->where('id', $data['size'][8]->mt_size_id)->first()['size_name'] : ''}}</td>
	                    <td>{{ isset($data['size'][8]['jan_cd']) ? $data['size'][8]['jan_cd'] : ''}}</td>
	                    <td>{{ isset($data['size'][9]->mt_size_id) ? $params['datas']['mtSize']->where('id', $data['size'][9]->mt_size_id)->first()['size_cd'] : ''}}</td>
	                    <td>{{ isset($data['size'][9]->mt_size_id) ? $params['datas']['mtSize']->where('id', $data['size'][9]->mt_size_id)->first()['size_name'] : ''}}</td>
	                    <td>{{ isset($data['size'][9]['jan_cd']) ? $data['size'][9]['jan_cd'] : ''}}</td>
	                </tr>
	            @endforeach
	        @endforeach
	    </tbody>
	</table>
@endsection

