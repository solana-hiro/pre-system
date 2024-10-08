@extends('layouts.admin.file')
@section('page_title', 'プレビュー')
@section('title', 'プレビュー')

@section('content')
	<table>
	    <thead>
	        <tr>
	            <th>納品先コード範囲：</th>
	            <th>{{ $params['startDate'] }}</th>
	            <th>～</th>
	            <th>{{ $params['endDate'] }}</th>
	        </tr>
	        <tr>
	            <th>処理日：</th>
	            <th>{{ $params['currentDate'] }}</th>
	        </tr>
	        <tr></tr>
	        <tr>
				<th>納品先コード</th>
				<th>納品先名</th>
				<th>名カナ</th>
				<th>得意先コード</th>
				<th>得意先名</th>
				<th>敬称区分</th>
				<th>郵便番号</th>
				<th>住所</th>
				<th>TEL</th>
				<th>FAX</th>
				<th>代表者名</th>
				<th>代表者名E-Mail</th>
				<th>納品先担当者名</th>
				<th>納品先担当者名E-Mail</th>
				<th>納品先URL</th>
				<th>名称入力区分</th>
				<th>削除区分(得意先)</th>
				<th>削除区分(納品先)</th>
				<th>館内配送料</th>
				<th>ルートコード</th>
				<th>ルートコード名</th>
				<th>運送会社コード</th>
				<th>運送会社名</th>
				<th>納品先着日コード</th>
				<th>納品先着日名</th>
				<th>直送手数料請求</th>
				<th>売上確定時印刷用紙</th>
				<th>納品先備考1</th>
				<th>納品先備考2</th>
				<th>納品先備考3</th>
				<th>登録種別</th>
			</tr>
	    </thead>
	    <tbody>
	        @foreach($params['datas'] as $data)
	            <tr>
	                <td>{{ $data->delivery_destination_id }}</td>
	                <td>{{ $data->delivery_destination_name }}</td>
	                <td>{{ $data->delivery_destination_name_kana }}</td>
	                <td>{{ $data->customer_cd }}</td>
	                <td>{{ $data->customer_name }}</td>
	                <td>{{ $data->honorific_kbn }}</td>
	                <td>{{ $data->post_number }}</td>
	                <td>{{ $data->address }}</td>
	                <td>{{ $data->tel }}</td>
	                <td>{{ $data->fax }}</td>
	                <td>{{ $data->representative_name }}</td>
	                <td>{{ $data->representative_mail }}</td>
	                <td>{{ $data->delivery_destination_manager_name }}</td>
	                <td>{{ $data->delivery_destination_manager_mail }}</td>
	                <td>{{ $data->delivery_destination_url }}</td>
	                <td>{{ $data->name_input_kbn }}</td>
	                <td>{{ $data->del_kbn_customer }}</td>
	                <td>{{ $data->del_kbn_delivery_destination }}</td>
	                <td>{{ $data->delivery_price }}</td>
	                <td>{{ $data->root_cd }}</td>
	                <td>{{ $data->root_name }}</td>
	                <td>{{ $data->item_class_cd }}</td>
	                <td>{{ $data->item_class_name }}</td>
	                <td>{{ $data->arrival_date_code }}</td>
	                <td>{{ $data->arrival_date_name }}</td>
	                <td>{{ $data->direct_delivery_commission_demand_flg }}</td>
	                <td>{{ $data->sale_decision_print_paper_flg }}</td>
	                <td>{{ $data->delivery_destination_memo_1 }}</td>
	                <td>{{ $data->delivery_destination_memo_2 }}</td>
	                <td>{{ $data->delivery_destination_memo_3 }}</td>
	                <td>{{ $data->register_kind_flg }}</td>
	            </tr>
	        @endforeach
	    </tbody>
	</table>
@endsection
