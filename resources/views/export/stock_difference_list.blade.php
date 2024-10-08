@extends('layouts.admin.file')
@section('page_title', '一覧表')
@section('title', '一覧表')
@section('content')

<table>
    <thead>
        <tr>
        <tr>
            <th style="text-align:left;">対象年月日：</th>
            <th style="text-align:left;">{{ $params['currentDate'] }}</th>
        </tr>
        <tr>
            <th style="text-align:left;">倉庫コード範囲：</th>
            <th style="text-align:left;">{{ $params['itemClassCodeStartCode'] }}</th>
            <th style="text-align:left;">～</th>
            <th style="text-align:left;">{{ $params['itemClassCodeEndCode'] }}</th>
        </tr>
        <tr>
            <th style="text-align:left;">対象商品分類：</th>
            <th style="text-align:left;">{{ $params['item_class_thing_id'] }}</th>
        </tr>
        <tr>
            <th style="text-align:left;">ブランド1コード範囲：</th>
            <th style="text-align:left;">{{ $params['itemClassCodeStartCode'] }}</th>
            <th style="text-align:left;">～</th>
            <th style="text-align:left;">{{ $params['itemClassCodeEndCode'] }}</th>
        </tr>
        <tr>
            <th style="text-align:left;">商品コード範囲：</th>
            <th style="text-align:left;">{{ $params['itemCodeStartCode'] }}</th>
            <th style="text-align:left;">～</th>
            <th style="text-align:left;">{{ $params['itemCodeEndCode'] }}</th>
        </tr>
        <tr>
            <th style="text-align:left;">処理日：</th>
            <th style="text-align:left;">{{ $params['currentDate'] }}</th>
        </tr>
        <tr></tr>
        <tr>
			<th style="text-align:left;">倉庫コード</th>
			<th style="text-align:left;">倉庫名</th>
			<th style="text-align:left;">ブランド1コード</th>
			<th style="text-align:left;">ブランド1名</th>
			<th style="text-align:left;">商品コード</th>
			<th style="text-align:left;">商品名</th>
			<th style="text-align:left;">カラーコード</th>
			<th style="text-align:left;">カラー名</th>
			<th style="text-align:left;">サイズコード</th>
			<th style="text-align:left;">サイズ名</th>
			<th style="text-align:left;">上代単価</th>
			<th style="text-align:left;">上代金額</th>
			<th style="text-align:left;">在庫単価</th>
			<th style="text-align:left;">帳簿在庫数量</th>
			<th style="text-align:left;">帳簿在庫金額</th>
			<th style="text-align:left;">実施棚卸単価</th>
			<th style="text-align:left;">実施棚卸</th>
			<th style="text-align:left;">実施棚卸金</th>
			<th style="text-align:left;">棚卸差異</th>
			<th style="text-align:left;">棚卸差異金</th>
			<th style="text-align:left;">棚卸後数量</th>
			<th style="text-align:left;">棚卸後金額</th>
		</tr>
    </thead>
    <tbody>
        @foreach($params['datas'] as $data)
            <tr>
				<td style="text-align:left;">{{ $data->supplier_cd }}</td>
				<td style="text-align:left;">{{ $data->supplier_name }}</td>
				<td style="text-align:left;">{{ $data->supplier_name_kana }}</td>
				<td style="text-align:left;">{{ $data->pay_destination_cd }}</td>
				<td style="text-align:left;">{{ $data->supplier_name }}</td>
				<td style="text-align:left;">{{ $data->user_cd }}</td>
				<td style="text-align:left;">{{ $data->user_name }}</td>
				<td style="text-align:left;">{{ $data->honorific_kbn }}</td>
				<td style="text-align:left;">{{ $data->post_number }}</td>
				<td style="text-align:left;">{{ $data->address }}</td>
				<td style="text-align:left;">{{ $data->tel }}</td>
				<td style="text-align:left;">{{ $data->fax }}</td>
				<td style="text-align:left;">{{ $data->representative_name }}</td>
				<td style="text-align:left;">{{ $data->representative_mail }}</td>
				<td style="text-align:left;">{{ $data->supplier_manager_name }}</td>
				<td style="text-align:left;">{{ $data->supplier_manager_mail }}</td>
				<td style="text-align:left;">{{ $data->supplier_class_cd }}</td>
				<td style="text-align:left;">{{ $data->supplier_class_name }}</td>
				<td style="text-align:left;">{{ $data->supplier_class_cd }}</td>
				<td style="text-align:left;">{{ $data->supplier_class_name }}</td>
				<td style="text-align:left;">{{ $data->supplier_class_cd }}</td>
				<td style="text-align:left;">{{ $data->supplier_class_name }}</td>
				<td style="text-align:left;">{{ $data->sequentially_kbn }}</td>
				<td style="text-align:left;">{{ $data->closing_date }}</td>
				<td style="text-align:left;">{{ $data->closing_month }}</td>
				<td style="text-align:left;">{{ $data->pay_date }}</td>
				<td style="text-align:left;">{{ $data->supplier_url }}</td>
				<td style="text-align:left;">{{ $data->name_input_kbn }}</td>
				<td style="text-align:left;">{{ $data->del_kbn }}</td>
				<td style="text-align:left;">{{ $data->price_fraction_process }}</td>
				<td style="text-align:left;">{{ $data->all_amount_fraction_process }}</td>
				<td style="text-align:left;">{{ $data->tax_kbn }}</td>
				<td style="text-align:left;">{{ $data->tax_calculation_standard }}</td>
				<td style="text-align:left;">{{ $data->tax_fraction_process_1 }}</td>
				<td style="text-align:left;">{{ $data->tax_fraction_process_2 }}</td>
				<td style="text-align:left;">{{ $data->slip_kind_cd }}</td>
				<td style="text-align:left;">{{ $data->slip_kind_name }}</td>
				<td style="text-align:left;">{{ $data->supplier_memo_1 }}</td>
				<td style="text-align:left;">{{ $data->supplier_memo_2 }}</td>
				<td style="text-align:left;">{{ $data->supplier_memo_3 }}</td>
				<td style="text-align:left;">{{ $data->supplier_expansion_1 }}</td>
				<td style="text-align:left;">{{ $data->supplier_expansion_2 }}</td>
				<td style="text-align:left;">{{ $data->supplier_expansion_3 }}</td>
				<td style="text-align:left;">{{ $data->supplier_expansion_4 }}</td>
				<td style="text-align:left;">{{ $data->supplier_expansion_5 }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
@endsection