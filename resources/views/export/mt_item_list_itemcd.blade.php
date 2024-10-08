@extends('layouts.admin.file')
@section('page_title', '一覧表')
@section('title', '一覧表')
@section('content')

<table>
    <thead>
        <tr>
			<th style="text-align:left;"><span class="vertical-writing">商品コード</span></th>
			<th style="text-align:left;"><span class="vertical-writing">他品番</span></th>
			<th style="text-align:left;"><span class="vertical-writing">商品名</span></th>
			<th style="text-align:left;"><span class="vertical-writing">名カナ</span></th>
			<th style="text-align:left;"><span class="vertical-writing">単位名</span></th>
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
            <th style="text-align:left;"><span class="vertical-writing">カラーコード1</span></th>
            <th style="text-align:left;"><span class="vertical-writing">カラーコード2</span></th>
            <th style="text-align:left;"><span class="vertical-writing">カラーコード3</span></th>
            <th style="text-align:left;"><span class="vertical-writing">カラーコード4</span></th>
            <th style="text-align:left;"><span class="vertical-writing">カラーコード5</span></th>
            <th style="text-align:left;"><span class="vertical-writing">カラーコード6</span></th>
            <th style="text-align:left;"><span class="vertical-writing">カラーコード7</span></th>
            <th style="text-align:left;"><span class="vertical-writing">カラーコード8</span></th>
            <th style="text-align:left;"><span class="vertical-writing">カラーコード9</span></th>
            <th style="text-align:left;"><span class="vertical-writing">カラーコード10</span></th>
            <th style="text-align:left;"><span class="vertical-writing">カラーコード11</span></th>
            <th style="text-align:left;"><span class="vertical-writing">カラーコード12</span></th>
            <th style="text-align:left;"><span class="vertical-writing">カラーコード13</span></th>
            <th style="text-align:left;"><span class="vertical-writing">カラーコード14</span></th>
            <th style="text-align:left;"><span class="vertical-writing">カラーコード15</span></th>
            <th style="text-align:left;"><span class="vertical-writing">カラーコード16</span></th>
            <th style="text-align:left;"><span class="vertical-writing">カラーコード17</span></th>
            <th style="text-align:left;"><span class="vertical-writing">カラーコード18</span></th>
            <th style="text-align:left;"><span class="vertical-writing">カラーコード19</span></th>
            <th style="text-align:left;"><span class="vertical-writing">カラーコード20</span></th>
            <th style="text-align:left;"><span class="vertical-writing">サイズコード1</span></th>
            <th style="text-align:left;"><span class="vertical-writing">サイズコード2</span></th>
            <th style="text-align:left;"><span class="vertical-writing">サイズコード3</span></th>
            <th style="text-align:left;"><span class="vertical-writing">サイズコード4</span></th>
            <th style="text-align:left;"><span class="vertical-writing">サイズコード5</span></th>
            <th style="text-align:left;"><span class="vertical-writing">サイズコード6</span></th>
            <th style="text-align:left;"><span class="vertical-writing">サイズコード7</span></th>
            <th style="text-align:left;"><span class="vertical-writing">サイズコード8</span></th>
            <th style="text-align:left;"><span class="vertical-writing">サイズコード9</span></th>
            <th style="text-align:left;"><span class="vertical-writing">サイズコード10</span></th>
        </tr>
    </thead>
    <tbody>
        @foreach($params['datas']['mtItem'] as $data)
            <tr>
				<td style="text-align:left;">{{ $data->item_cd }}</td>
                <td style="text-align:left;">{{ $data->other_part_number }}</td>
                <td style="text-align:left;">{{ $data->item_name }}</td>
                <td style="text-align:left;">{{ $data->item_name_kana }}</td>
                <td style="text-align:left;">{{ $data->unit }}</td>
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
                <td style="text-align:left;">{{ isset($data['colors'][0]) ? $params['datas']['mtColor']->where('id', $data['colors'][0])->first()['color_cd'] : '' }}</td>
                <td style="text-align:left;">{{ isset($data['colors'][1]) ? $params['datas']['mtColor']->where('id', $data['colors'][1])->first()['color_cd'] : '' }}</td>
                <td style="text-align:left;">{{ isset($data['colors'][2]) ? $params['datas']['mtColor']->where('id', $data['colors'][2])->first()['color_cd'] : '' }}</td>
                <td style="text-align:left;">{{ isset($data['colors'][3]) ? $params['datas']['mtColor']->where('id', $data['colors'][3])->first()['color_cd'] : '' }}</td>
                <td style="text-align:left;">{{ isset($data['colors'][4]) ? $params['datas']['mtColor']->where('id', $data['colors'][4])->first()['color_cd'] : '' }}</td>
                <td style="text-align:left;">{{ isset($data['colors'][5]) ? $params['datas']['mtColor']->where('id', $data['colors'][5])->first()['color_cd'] : '' }}</td>
                <td style="text-align:left;">{{ isset($data['colors'][6]) ? $params['datas']['mtColor']->where('id', $data['colors'][6])->first()['color_cd'] : '' }}</td>
                <td style="text-align:left;">{{ isset($data['colors'][7]) ? $params['datas']['mtColor']->where('id', $data['colors'][7])->first()['color_cd'] : '' }}</td>
                <td style="text-align:left;">{{ isset($data['colors'][8]) ? $params['datas']['mtColor']->where('id', $data['colors'][8])->first()['color_cd'] : '' }}</td>
                <td style="text-align:left;">{{ isset($data['colors'][9]) ? $params['datas']['mtColor']->where('id', $data['colors'][9])->first()['color_cd'] : '' }}</td>
                <td style="text-align:left;">{{ isset($data['colors'][10]) ? $params['datas']['mtColor']->where('id', $data['colors'][10])->first()['color_cd'] : '' }}</td>
                <td style="text-align:left;">{{ isset($data['colors'][11]) ? $params['datas']['mtColor']->where('id', $data['colors'][11])->first()['color_cd'] : '' }}</td>
                <td style="text-align:left;">{{ isset($data['colors'][12]) ? $params['datas']['mtColor']->where('id', $data['colors'][12])->first()['color_cd'] : '' }}</td>
                <td style="text-align:left;">{{ isset($data['colors'][13]) ? $params['datas']['mtColor']->where('id', $data['colors'][13])->first()['color_cd'] : '' }}</td>
                <td style="text-align:left;">{{ isset($data['colors'][14]) ? $params['datas']['mtColor']->where('id', $data['colors'][14])->first()['color_cd'] : '' }}</td>
                <td style="text-align:left;">{{ isset($data['colors'][15]) ? $params['datas']['mtColor']->where('id', $data['colors'][15])->first()['color_cd'] : '' }}</td>
                <td style="text-align:left;">{{ isset($data['colors'][16]) ? $params['datas']['mtColor']->where('id', $data['colors'][16])->first()['color_cd'] : '' }}</td>
                <td style="text-align:left;">{{ isset($data['colors'][17]) ? $params['datas']['mtColor']->where('id', $data['colors'][17])->first()['color_cd'] : '' }}</td>
                <td style="text-align:left;">{{ isset($data['colors'][18]) ? $params['datas']['mtColor']->where('id', $data['colors'][18])->first()['color_cd'] : '' }}</td>
                <td style="text-align:left;">{{ isset($data['colors'][19]) ? $params['datas']['mtColor']->where('id', $data['colors'][19])->first()['color_cd'] : '' }}</td>
                <td style="text-align:left;">{{ isset($data['sizes'][0]) ? $params['datas']['mtSize']->where('id', $data['sizes'][0])->first()['size_cd'] : '' }}</td>
                <td style="text-align:left;">{{ isset($data['sizes'][1]) ? $params['datas']['mtSize']->where('id', $data['sizes'][1])->first()['size_cd'] : '' }}</td>
                <td style="text-align:left;">{{ isset($data['sizes'][2]) ? $params['datas']['mtSize']->where('id', $data['sizes'][2])->first()['size_cd'] : '' }}</td>
                <td style="text-align:left;">{{ isset($data['sizes'][3]) ? $params['datas']['mtSize']->where('id', $data['sizes'][3])->first()['size_cd'] : '' }}</td>
                <td style="text-align:left;">{{ isset($data['sizes'][4]) ? $params['datas']['mtSize']->where('id', $data['sizes'][4])->first()['size_cd'] : '' }}</td>
                <td style="text-align:left;">{{ isset($data['sizes'][5]) ? $params['datas']['mtSize']->where('id', $data['sizes'][5])->first()['size_cd'] : '' }}</td>
                <td style="text-align:left;">{{ isset($data['sizes'][6]) ? $params['datas']['mtSize']->where('id', $data['sizes'][6])->first()['size_cd'] : '' }}</td>
                <td style="text-align:left;">{{ isset($data['sizes'][7]) ? $params['datas']['mtSize']->where('id', $data['sizes'][7])->first()['size_cd'] : '' }}</td>
                <td style="text-align:left;">{{ isset($data['sizes'][8]) ? $params['datas']['mtSize']->where('id', $data['sizes'][8])->first()['size_cd'] : '' }}</td>
                <td style="text-align:left;">{{ isset($data['sizes'][9]) ? $params['datas']['mtSize']->where('id', $data['sizes'][9])->first()['size_cd'] : '' }}</td>
            </tr>
        @endforeach
    </tbody>
</table>

@endsection