@extends('layouts.admin.file')
@section('page_title', '一覧表')
@section('title', '一覧表')
@section('content')

<table>
    <thead>
        <tr>
            <th style="text-align:left;">納品先コード範囲：</th>
            <th style="text-align:left;">{{ $params['startDate'] }}</th>
            <th style="text-align:left;">～</th>
            <th style="text-align:left;">{{ $params['endDate'] }}</th>
        </tr>
        <tr>
            <th style="text-align:left;">処理日：</th>
            <th style="text-align:left;">{{ $params['currentDate'] }}</th>
        </tr>
        <tr></tr>
        <tr>
			<th style="text-align:left;">納品先コード</th>
			<th style="text-align:left;">納品先名</th>
			<th style="text-align:left;">名カナ</th>
			<th style="text-align:left;">得意先コード</th>
			<th style="text-align:left;">得意先名</th>
			<th style="text-align:left;">敬称区分</th>
			<th style="text-align:left;">郵便番号</th>
			<th style="text-align:left;">住所</th>
			<th style="text-align:left;">TEL</th>
			<th style="text-align:left;">FAX</th>
			<th style="text-align:left;">代表者名</th>
			<th style="text-align:left;">代表者名E-Mail</th>
			<th style="text-align:left;">納品先担当者名</th>
			<th style="text-align:left;">納品先担当者名E-Mail</th>
			<th style="text-align:left;">納品先URL</th>
			<th style="text-align:left;">名称入力区分</th>
			<th style="text-align:left;">削除区分(得意先)</th>
			<th style="text-align:left;">削除区分(納品先)</th>
			<th style="text-align:left;">館内配送料</th>
			<th style="text-align:left;">ルートコード</th>
			<th style="text-align:left;">ルートコード名</th>
			<th style="text-align:left;">運送会社コード</th>
			<th style="text-align:left;">運送会社名</th>
			<th style="text-align:left;">納品先着日コード</th>
			<th style="text-align:left;">納品先着日名</th>
			<th style="text-align:left;">直送手数料請求</th>
			<th style="text-align:left;">売上確定時印刷用紙</th>
			<th style="text-align:left;">納品先備考1</th>
			<th style="text-align:left;">納品先備考2</th>
			<th style="text-align:left;">納品先備考3</th>
			<th style="text-align:left;">登録種別</th>
		</tr>
    </thead>
    <tbody>
        @foreach($params['datas'] as $data)
            <tr>
                <td style="text-align:left;">{{ $data->delivery_destination_id }}</td>
                <td style="text-align:left;">{{ $data->delivery_destination_name }}</td>
                <td style="text-align:left;">{{ $data->delivery_destination_name_kana }}</td>
                <td style="text-align:left;">{{ $data->customer_cd }}</td>
                <td style="text-align:left;">{{ $data->customer_name }}</td>
                <td style="text-align:left;">{{ $data->honorific_kbn }}</td>
                <td style="text-align:left;">{{ $data->post_number }}</td>
                <td style="text-align:left;">{{ $data->address }}</td>
                <td style="text-align:left;">{{ $data->tel }}</td>
                <td style="text-align:left;">{{ $data->fax }}</td>
                <td style="text-align:left;">{{ $data->representative_name }}</td>
                <td style="text-align:left;">{{ $data->representative_mail }}</td>
                <td style="text-align:left;">{{ $data->delivery_destination_manager_name }}</td>
                <td style="text-align:left;">{{ $data->delivery_destination_manager_mail }}</td>
                <td style="text-align:left;">{{ $data->delivery_destination_url }}</td>
                <td style="text-align:left;">{{ $data->name_input_kbn }}</td>
                <td style="text-align:left;">{{ $data->del_kbn_customer }}</td>
                <td style="text-align:left;">{{ $data->del_kbn_delivery_destination }}</td>
                <td style="text-align:left;">{{ $data->delivery_price }}</td>
                <td style="text-align:left;">{{ $data->root_cd }}</td>
                <td style="text-align:left;">{{ $data->root_name }}</td>
                <td style="text-align:left;">{{ $data->item_class_cd }}</td>
                <td style="text-align:left;">{{ $data->item_class_name }}</td>
                <td style="text-align:left;">{{ $data->arrival_date_code }}</td>
                <td style="text-align:left;">{{ $data->arrival_date_name }}</td>
                <td style="text-align:left;">{{ $data->direct_delivery_commission_demand_flg }}</td>
                <td style="text-align:left;">{{ $data->sale_decision_print_paper_flg }}</td>
                <td style="text-align:left;">{{ $data->delivery_destination_memo_1 }}</td>
                <td style="text-align:left;">{{ $data->delivery_destination_memo_2 }}</td>
                <td style="text-align:left;">{{ $data->delivery_destination_memo_3 }}</td>
                <td style="text-align:left;">{{ $data->register_kind_flg }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
@endsection