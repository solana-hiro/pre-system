@extends('layouts.admin.file')
@section('page_title', '一覧表')
@section('title', '一覧表')
@section('content')

<table>
    <thead>
        <tr>
            <th style="text-align:left;">ブランド1コード範囲：</th>
            <th style="text-align:left;">{{ $params['itemClass1Start'] }}</th>
            <th style="text-align:left;">～</th>
            <th style="text-align:left;">{{ $params['itemClass1End'] }}</th>
        </tr>
        <tr>
            <th style="text-align:left;">競技・カテゴリコード範囲：</th>
            <th style="text-align:left;">{{ $params['itemClass2Start'] }}</th>
            <th style="text-align:left;">～</th>
            <th style="text-align:left;">{{ $params['itemClass2End'] }}</th>
        </tr>
        <tr>
            <th style="text-align:left;">ジャンルコード範囲：</th>
            <th style="text-align:left;">{{ $params['itemClass3Start'] }}</th>
            <th style="text-align:left;">～</th>
            <th style="text-align:left;">{{ $params['itemClass3End'] }}</th>
        </tr>
        <tr>
            <th style="text-align:left;">販売開始年コード範囲：</th>
            <th style="text-align:left;">{{ $params['itemClass4Start'] }}</th>
            <th style="text-align:left;">～</th>
            <th style="text-align:left;">{{ $params['itemClass4End'] }}</th>
        </tr>
        <tr>
            <th style="text-align:left;">工場分類5コード範囲：</th>
            <th style="text-align:left;">{{ $params['itemClass5Start'] }}</th>
            <th style="text-align:left;">～</th>
            <th style="text-align:left;">{{ $params['itemClass5End'] }}</th>
        </tr>
        <tr>
            <th style="text-align:left;">製品/工賃6コード範囲：</th>
            <th style="text-align:left;">{{ $params['itemClass6Start'] }}</th>
            <th style="text-align:left;">～</th>
            <th style="text-align:left;">{{ $params['itemClass6End'] }}</th>
        </tr>
        <tr>
            <th style="text-align:left;">資産在庫JAコード範囲：</th>
            <th style="text-align:left;">{{ $params['itemClass7Start'] }}</th>
            <th style="text-align:left;">～</th>
            <th style="text-align:left;">{{ $params['itemClass7End'] }}</th>
        </tr>
        <tr>
            <th style="text-align:left;">商品コード範囲：</th>
            <th style="text-align:left;">{{ $params['itemCodeStart'] }}</th>
            <th style="text-align:left;">～</th>
            <th style="text-align:left;">{{ $params['itemCodeEnd'] }}</th>
        </tr>
        <tr>
            <th style="text-align:left;">他品番範囲：</th>
            <th style="text-align:left;">{{ $params['otherPartNumberStart'] }}</th>
            <th style="text-align:left;">～</th>
            <th style="text-align:left;">{{ $params['otherPartNumberEnd'] }}</th>
        </tr>
        <tr>
            <th style="text-align:left;">処理日：</th>
            <th style="text-align:left;">{{ $params['currentDate'] }}</th>
        </tr>
        <tr></tr>
        <tr>
			<th style="text-align:left;">商品コード</th>
			<th style="text-align:left;">商品名</th>
			<th style="text-align:left;">名カナ</th>
			<th style="text-align:left;">単位名</th>
			<th style="text-align:left;">仕入先コード</th>
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
			<th style="text-align:left;">商品区分</th>
			<th style="text-align:left;">在庫管理区分</th>
			<th style="text-align:left;">非課税区分</th>
			<th style="text-align:left;">税率区分コード</th>
			<th style="text-align:left;">税率区分名</th>
			<th style="text-align:left;">税抜上代単価</th>
			<th style="text-align:left;">税込上代単価</th>
			<th style="text-align:left;">税抜参考上代単価</th>
			<th style="text-align:left;">税込参考上代単価</th>
			<th style="text-align:left;">税抜仕入単価</th>
			<th style="text-align:left;">税込仕入単価</th>
			<th style="text-align:left;">原価単価</th>
			<th style="text-align:left;">粗利算出用原価単価</th>
			<th style="text-align:left;">名称入力区分</th>
			<th style="text-align:left;">削除区分</th>
			<th style="text-align:left;">他品番</th>
			<th style="text-align:left;">メンバーサイト連携区分</th>
			<th style="text-align:left;">メンバーサイト商品コード</th>
			<th style="text-align:left;">メンバーサイト商品名</th>
			<th style="text-align:left;">日本郵政連携済区分</th>
			<th style="text-align:left;">商品備考1</th>
			<th style="text-align:left;">商品備考2</th>
			<th style="text-align:left;">商品備考3</th>
			<th style="text-align:left;">商品備考4</th>
			<th style="text-align:left;">商品備考5</th>
			<th style="text-align:left;">カラーコード</th>
			<th style="text-align:left;">カラー名</th>
			<th style="text-align:left;">サイズコード1</th>
			<th style="text-align:left;">サイズ名1</th>
			<th style="text-align:left;">JANコード1</th>
			<th style="text-align:left;">サイズコード2</th>
			<th style="text-align:left;">サイズ名2</th>
			<th style="text-align:left;">JANコード2</th>
			<th style="text-align:left;">サイズコード3</th>
			<th style="text-align:left;">サイズ名3</th>
			<th style="text-align:left;">JANコード3</th>
			<th style="text-align:left;">サイズコード4</th>
			<th style="text-align:left;">サイズ名4</th>
			<th style="text-align:left;">JANコード4</th>
			<th style="text-align:left;">サイズコード5</th>
			<th style="text-align:left;">サイズ名5</th>
			<th style="text-align:left;">JANコード5</th>
			<th style="text-align:left;">サイズコード6</th>
			<th style="text-align:left;">サイズ名6</th>
			<th style="text-align:left;">JANコード6</th>
			<th style="text-align:left;">サイズコード7</th>
			<th style="text-align:left;">サイズ名7</th>
			<th style="text-align:left;">JANコード7</th>
			<th style="text-align:left;">サイズコード8</th>
			<th style="text-align:left;">サイズ名8</th>
			<th style="text-align:left;">JANコード8</th>
			<th style="text-align:left;">サイズコード9</th>
			<th style="text-align:left;">サイズ名9</th>
			<th style="text-align:left;">JANコード9</th>
			<th style="text-align:left;">サイズコード10</th>
			<th style="text-align:left;">サイズ名10</th>
			<th style="text-align:left;">JANコード10</th>
        </tr>
    </thead>
    <tbody>
        @foreach($params['datas']['mtItem'] as $datas)
            @foreach($datas['colors'] as $data)
                <tr>
                    <td style="text-align:left;">{{ $datas->item_cd }}</td>
                    <td style="text-align:left;">{{ $datas->item_name }}</td>
                    <td style="text-align:left;">{{ $datas->item_name_kana }}</td>
                    <td style="text-align:left;">{{ $datas->unit }}</td>
                    <td style="text-align:left;">{{ $datas->supplier_cd }}</td>
                    <td style="text-align:left;">{{ $datas->item_class_cd_1 }}</td>
                    <td style="text-align:left;">{{ $datas->item_class_name_1 }}</td>
                    <td style="text-align:left;">{{ $datas->item_class_cd_2 }}</td>
                    <td style="text-align:left;">{{ $datas->item_class_name_2 }}</td>
                    <td style="text-align:left;">{{ $datas->item_class_cd_3 }}</td>
                    <td style="text-align:left;">{{ $datas->item_class_name_3 }}</td>
                    <td style="text-align:left;">{{ $datas->item_class_cd_4 }}</td>
                    <td style="text-align:left;">{{ $datas->item_class_name_4 }}</td>
                    <td style="text-align:left;">{{ $datas->item_class_cd_5 }}</td>
                    <td style="text-align:left;">{{ $datas->item_class_name_5 }}</td>
                    <td style="text-align:left;">{{ $datas->item_class_cd_6 }}</td>
                    <td style="text-align:left;">{{ $datas->item_class_name_6 }}</td>
                    <td style="text-align:left;">{{ $datas->item_class_cd_7 }}</td>
                    <td style="text-align:left;">{{ $datas->item_class_name_7 }}</td>
                    <td style="text-align:left;">{{ $datas->item_kbn }}</td>
                    <td style="text-align:left;">{{ $datas->stock_management_kbn }}</td>
                    <td style="text-align:left;">{{ $datas->non_tax_kbn }}</td>
                    <td style="text-align:left;">{{ $datas->tax_rate_kbn_cd }}</td>
                    <td style="text-align:left;">{{ $params['datas']['defTaxRateKbn']->where('id', $datas->def_tax_rate_kbns_id)->first()['tax_rate_kbn_name'] }}</td>
                    <td style="text-align:left;">{{ $datas->retail_price_tax_out }}</td>
                    <td style="text-align:left;">{{ $datas->retail_price_tax_in }}</td>
                    <td style="text-align:left;">{{ $datas->reference_retail_tax_out }}</td>
                    <td style="text-align:left;">{{ $datas->reference_retail_tax_in }}</td>
                    <td style="text-align:left;">{{ $datas->purchase_price_tax_out }}</td>
                    <td style="text-align:left;">{{ $datas->purchase_price_tax_in }}</td>
                    <td style="text-align:left;">{{ $datas->cost_price }}</td>
                    <td style="text-align:left;">{{ $datas->profit_calculation_cost_price }}</td>
                    <td style="text-align:left;">{{ $datas->name_input_kbn }}</td>
                    <td style="text-align:left;">{{ $datas->del_kbn }}</td>
                    <td style="text-align:left;">{{ $datas->other_part_number }}</td>
                    <td style="text-align:left;">{{ $datas->ec_alignment_kbn }}</td>
                    <td style="text-align:left;">{{ $datas->ec_item_cd }}</td>
                    <td style="text-align:left;">{{ $datas->ec_item_name }}</td>
                    <td style="text-align:left;">{{ $datas->japan_post_office }}</td>
                    <td style="text-align:left;">{{ $datas->item_memo_1 }}</td>
                    <td style="text-align:left;">{{ $datas->item_memo_2 }}</td>
                    <td style="text-align:left;">{{ $datas->item_memo_3 }}</td>
                    <td style="text-align:left;">{{ $datas->item_memo_4 }}</td>
                    <td style="text-align:left;">{{ $datas->item_memo_5 }}</td>
                    <td style="text-align:left;">{{ isset($data['mt_color_id']) ? $params['datas']['mtColor']->where('id', $data['mt_color_id'])->first()['color_cd'] : '' }}</td>
                    <td style="text-align:left;">{{ isset($data['mt_color_id']) ? $params['datas']['mtColor']->where('id', $data['mt_color_id'])->first()['color_name'] : '' }}</td>
                    <td style="text-align:left;">{{ isset($data['size'][0]->mt_size_id) ? $params['datas']['mtSize']->where('id', $data['size'][0]->mt_size_id)->first()['size_cd'] : ''}}</td>
                    <td style="text-align:left;">{{ isset($data['size'][0]->mt_size_id) ? $params['datas']['mtSize']->where('id', $data['size'][0]->mt_size_id)->first()['size_name'] : ''}}</td>
                    <td style="text-align:left;">{{ isset($data['size'][0]['jan_cd']) ? $data['size'][0]['jan_cd'] : ''}}</td>
                    <td style="text-align:left;">{{ isset($data['size'][1]->mt_size_id) ? $params['datas']['mtSize']->where('id', $data['size'][1]->mt_size_id)->first()['size_cd'] : ''}}</td>
                    <td style="text-align:left;">{{ isset($data['size'][1]->mt_size_id) ? $params['datas']['mtSize']->where('id', $data['size'][1]->mt_size_id)->first()['size_name'] : ''}}</td>
                    <td style="text-align:left;">{{ isset($data['size'][1]['jan_cd']) ? $data['size'][1]['jan_cd'] : ''}}</td>
                    <td style="text-align:left;">{{ isset($data['size'][2]->mt_size_id) ? $params['datas']['mtSize']->where('id', $data['size'][2]->mt_size_id)->first()['size_cd'] : ''}}</td>
                    <td style="text-align:left;">{{ isset($data['size'][2]->mt_size_id) ? $params['datas']['mtSize']->where('id', $data['size'][2]->mt_size_id)->first()['size_name'] : ''}}</td>
                    <td style="text-align:left;">{{ isset($data['size'][2]['jan_cd']) ? $data['size'][2]['jan_cd'] : ''}}</td>
                    <td style="text-align:left;">{{ isset($data['size'][3]->mt_size_id) ? $params['datas']['mtSize']->where('id', $data['size'][3]->mt_size_id)->first()['size_cd'] : ''}}</td>
                    <td style="text-align:left;">{{ isset($data['size'][3]->mt_size_id) ? $params['datas']['mtSize']->where('id', $data['size'][3]->mt_size_id)->first()['size_name'] : ''}}</td>
                    <td style="text-align:left;">{{ isset($data['size'][3]['jan_cd']) ? $data['size'][3]['jan_cd'] : ''}}</td>
                    <td style="text-align:left;">{{ isset($data['size'][4]->mt_size_id) ? $params['datas']['mtSize']->where('id', $data['size'][4]->mt_size_id)->first()['size_cd'] : ''}}</td>
                    <td style="text-align:left;">{{ isset($data['size'][4]->mt_size_id) ? $params['datas']['mtSize']->where('id', $data['size'][4]->mt_size_id)->first()['size_name'] : ''}}</td>
                    <td style="text-align:left;">{{ isset($data['size'][4]['jan_cd']) ? $data['size'][4]['jan_cd'] : ''}}</td>
                    <td style="text-align:left;">{{ isset($data['size'][5]->mt_size_id) ? $params['datas']['mtSize']->where('id', $data['size'][5]->mt_size_id)->first()['size_cd'] : ''}}</td>
                    <td style="text-align:left;">{{ isset($data['size'][5]->mt_size_id) ? $params['datas']['mtSize']->where('id', $data['size'][5]->mt_size_id)->first()['size_name'] : ''}}</td>
                    <td style="text-align:left;">{{ isset($data['size'][5]['jan_cd']) ? $data['size'][5]['jan_cd'] : ''}}</td>
                    <td style="text-align:left;">{{ isset($data['size'][6]->mt_size_id) ? $params['datas']['mtSize']->where('id', $data['size'][6]->mt_size_id)->first()['size_cd'] : ''}}</td>
                    <td style="text-align:left;">{{ isset($data['size'][6]->mt_size_id) ? $params['datas']['mtSize']->where('id', $data['size'][6]->mt_size_id)->first()['size_name'] : ''}}</td>
                    <td style="text-align:left;">{{ isset($data['size'][6]['jan_cd']) ? $data['size'][6]['jan_cd'] : ''}}</td>
                    <td style="text-align:left;">{{ isset($data['size'][7]->mt_size_id) ? $params['datas']['mtSize']->where('id', $data['size'][7]->mt_size_id)->first()['size_cd'] : ''}}</td>
                    <td style="text-align:left;">{{ isset($data['size'][7]->mt_size_id) ? $params['datas']['mtSize']->where('id', $data['size'][7]->mt_size_id)->first()['size_name'] : ''}}</td>
                    <td style="text-align:left;">{{ isset($data['size'][7]['jan_cd']) ? $data['size'][7]['jan_cd'] : ''}}</td>
                    <td style="text-align:left;">{{ isset($data['size'][8]->mt_size_id) ? $params['datas']['mtSize']->where('id', $data['size'][8]->mt_size_id)->first()['size_cd'] : ''}}</td>
                    <td style="text-align:left;">{{ isset($data['size'][8]->mt_size_id) ? $params['datas']['mtSize']->where('id', $data['size'][8]->mt_size_id)->first()['size_name'] : ''}}</td>
                    <td style="text-align:left;">{{ isset($data['size'][8]['jan_cd']) ? $data['size'][8]['jan_cd'] : ''}}</td>
                    <td style="text-align:left;">{{ isset($data['size'][9]->mt_size_id) ? $params['datas']['mtSize']->where('id', $data['size'][9]->mt_size_id)->first()['size_cd'] : ''}}</td>
                    <td style="text-align:left;">{{ isset($data['size'][9]->mt_size_id) ? $params['datas']['mtSize']->where('id', $data['size'][9]->mt_size_id)->first()['size_name'] : ''}}</td>
                    <td style="text-align:left;">{{ isset($data['size'][9]['jan_cd']) ? $data['size'][9]['jan_cd'] : ''}}</td>
                </tr>
            @endforeach
        @endforeach
    </tbody>
</table>
@endsection