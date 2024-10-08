@extends('layouts.admin.file')
@section('page_title', '一覧表')
@section('title', '一覧表')
@section('content')

<table>
    <thead>
        <tr>
			<th style="text-align:left;"><span class="vertical-writing">JANコード</span></th>
			<th style="text-align:left;"><span class="vertical-writing">商品コード</span></th>
			<th style="text-align:left;"><span class="vertical-writing">他品番</span></th>
			<th style="text-align:left;"><span class="vertical-writing">商品名</span></th>
			<th style="text-align:left;"><span class="vertical-writing">名カナ</span></th>
			<th style="text-align:left;"><span class="vertical-writing">単位名</span></th>
			<th style="text-align:left;"><span class="vertical-writing">カラーコード</span></th>
			<th style="text-align:left;"><span class="vertical-writing">カラー名</span></th>
			<th style="text-align:left;"><span class="vertical-writing">サイズコード</span></th>
			<th style="text-align:left;"><span class="vertical-writing">サイズ名</span></th>
			<th style="text-align:left;"><span class="vertical-writing">非表示フラグ</span></th>
			<th style="text-align:left;"><span class="vertical-writing">仕入先コード</span></th>
			<th style="text-align:left;"><span class="vertical-writing">ブランド1コード</span></th>
			<th style="text-align:left;"><span class="vertical-writing">競技・カテゴリコード</span></th>
			<th style="text-align:left;"><span class="vertical-writing">ジャンルコード</span></th>
			<th style="text-align:left;"><span class="vertical-writing">販売開始年コード</span></th>
			<th style="text-align:left;"><span class="vertical-writing">工場分類5コード</span></th>
			<th style="text-align:left;"><span class="vertical-writing">製品/工賃6コード</span></th>
			<th style="text-align:left;"><span class="vertical-writing">資産在庫JAコード</span></th>
			<th style="text-align:left;"><span class="vertical-writing">商品区分</span></th>
			<th style="text-align:left;"><span class="vertical-writing">在庫管理区分</span></th>
			<th style="text-align:left;"><span class="vertical-writing">非課税区分</span></th>
			<th style="text-align:left;"><span class="vertical-writing">税率区分</span></th>
			<th style="text-align:left;"><span class="vertical-writing">税抜上代単価</span></th>
			<th style="text-align:left;"><span class="vertical-writing">税込上代単価</span></th>
			<th style="text-align:left;"><span class="vertical-writing">税抜参考上代単価</span></th>
			<th style="text-align:left;"><span class="vertical-writing">税込参考上代単価</span></th>
			<th style="text-align:left;"><span class="vertical-writing">税抜仕入単価</span></th>
			<th style="text-align:left;"><span class="vertical-writing">税込仕入単価</span></th>
			<th style="text-align:left;"><span class="vertical-writing">原価単価</span></th>
			<th style="text-align:left;"><span class="vertical-writing">粗利算出用原価単価</span></th>
			<th style="text-align:left;"><span class="vertical-writing">名称入力区分</span></th>
			<th style="text-align:left;"><span class="vertical-writing">削除区分</span></th>
			<th style="text-align:left;"><span class="vertical-writing">メンバーサイト連携区分</span></th>
			<th style="text-align:left;"><span class="vertical-writing">メンバーサイト商品コード</span></th>
			<th style="text-align:left;"><span class="vertical-writing">メンバーサイト商品名</span></th>
			<th style="text-align:left;"><span class="vertical-writing">商品備考1</span></th>
			<th style="text-align:left;"><span class="vertical-writing">商品備考2</span></th>
			<th style="text-align:left;"><span class="vertical-writing">商品備考3</span></th>
			<th style="text-align:left;"><span class="vertical-writing">商品備考4</span></th>
			<th style="text-align:left;"><span class="vertical-writing">商品備考5</span></th>
        </tr>
    </thead>
    <tbody>
        @foreach($params['datas']['mtItem'] as $data)
            <tr>
				<td style="text-align:left;">{{ $data->jan_cd }}</td>
				<td style="text-align:left;">{{ $data->item_cd }}</td>
                <td style="text-align:left;">{{ $data->other_part_number }}</td>
				<td style="text-align:left;">{{ $data->item_name }}</td>
                <td style="text-align:left;">{{ $data->item_name_kana }}</td>
                <td style="text-align:left;">{{ $data->unit }}</td>
                <td style="text-align:left;">{{ $data->color_cd }}</td>
                <td style="text-align:left;">{{ $data->color_name }}</td>
                <td style="text-align:left;">{{ $data->size_cd }}</td>
                <td style="text-align:left;">{{ $data->size_name }}</td>
                <td style="text-align:left;">{{ $data->hidden_flg }}</td>
                <td style="text-align:left;">{{ $data->supplier_cd }}</td>
                <td style="text-align:left;">{{ $data->item_class_cd_1 }}</td>
                <td style="text-align:left;">{{ $data->item_class_cd_2 }}</td>
                <td style="text-align:left;">{{ $data->item_class_cd_3 }}</td>
                <td style="text-align:left;">{{ $data->item_class_cd_4 }}</td>
                <td style="text-align:left;">{{ $data->item_class_cd_5 }}</td>
                <td style="text-align:left;">{{ $data->item_class_cd_6 }}</td>
                <td style="text-align:left;">{{ $data->item_class_cd_7 }}</td>
                <td style="text-align:left;">{{ $data->item_kbn }}</td>
                <td style="text-align:left;">{{ $data->stock_management_kbn }}</td>
                <td style="text-align:left;">{{ $data->non_tax_kbn }}</td>
                <td style="text-align:left;">{{ $data->tax_rate_kbn_cd }}</td>
                <td style="text-align:left;">{{ $data->retail_price_tax_out }}</td>
                <td style="text-align:left;">{{ $data->retail_price_tax_in }}</td>
                <td style="text-align:left;">{{ $data->reference_retail_tax_out }}</td>
                <td style="text-align:left;">{{ $data->reference_retail_tax_in }}</td>
                <td style="text-align:left;">{{ $data->purchase_price_tax_out }}</td>
                <td style="text-align:left;">{{ $data->purchase_price_tax_in }}</td>
                <td style="text-align:left;">{{ $data->cost_price }}</td>
                <td style="text-align:left;">{{ $data->profit_calculation_cost_price }}</td>
                <td style="text-align:left;">{{ $data->name_input_kbn }}</td>
                <td style="text-align:left;">{{ $data->del_kbn }}</td>
                <td style="text-align:left;">{{ $data->ec_alignment_kbn }}</td>
                <td style="text-align:left;">{{ $data->ec_item_cd }}</td>
                <td style="text-align:left;">{{ $data->ec_item_name }}</td>
                <td style="text-align:left;">{{ $data->item_memo_1 }}</td>
                <td style="text-align:left;">{{ $data->item_memo_2 }}</td>
                <td style="text-align:left;">{{ $data->item_memo_3 }}</td>
                <td style="text-align:left;">{{ $data->item_memo_4 }}</td>
                <td style="text-align:left;">{{ $data->item_memo_5 }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
@endsection