@extends('layouts.admin.file')
@section('page_title', 'プレビュー')
@section('title', 'プレビュー')

@section('content')
<table>
    <thead>
        <tr>
            <th>得意先コード範囲：</th>
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
			<th>得意先コード</th>
			<th>得意先名</th>
			<th>名カナ</th>
			<th>請求先コード</th>
			<th>請求先名</th>
			<th>付箋(特記事項)</th>
			<th>入金区分</th>
			<th>担当者コード</th>
			<th>担当名</th>
			<th>敬称区分</th>
			<th>郵便番号</th>
			<th>住所</th>
			<th>TEL</th>
			<th>FAX</th>
			<th>代表者名</th>
			<th>代表者E-Mail</th>
			<th>得意先担当者コード</th>
			<th>得意先担当者名</th>
			<th>得意先担当者E-Mail</th>
			<th>ECログインID</th>
			<th>単価掛率</th>
			<th>与信限度額</th>
			<th>与信限度額チェック</th>
			<th>販売ﾊﾟﾀｰﾝ 1コード</th>
			<th>販売ﾊﾟﾀｰﾝ 1名</th>
			<th>業種・特徴 2コード</th>
			<th>業種・特徴 2名</th>
			<th>ランク 3コード</th>
			<th>ランク 3名</th>
			<th>地区分類コード</th>
			<th>地区分類名</th>
			<th>開拓年分類コード</th>
			<th>開拓年分類名</th>
			<th>随時区分</th>
			<th>締日1</th>
			<th>回収月1</th>
			<th>回収日1</th>
			<th>締日2</th>
			<th>回収月2</th>
			<th>回収日2</th>
			<th>締日3</th>
			<th>回収月3</th>
			<th>回収日3</th>
			<th>請求書通知用E-Mail1</th>
			<th>請求書通知用E-Mail2</th>
			<th>入金案内用E-Mail</th>
			<th>入金案内送信要不要</th>
			<th>得意先URL</th>
			<th>名称入力区分</th>
			<th>削除区分</th>
			<th>単価端数処理</th>
			<th>金額端数処理</th>
			<th>消費税区分</th>
			<th>運賃掛率適用</th>
			<th>消費税算出基準</th>
			<th>消費税端数桁数区分</th>
			<th>消費税端数処理</th>
			<th>館内配送料</th>
			<th>受注倉庫コード</th>
			<th>受注倉庫名</th>
			<th>ルートコード</th>
			<th>ルートコード名</th>
			<th>運送会社コード</th>
			<th>運送会社名</th>
			<th>得意先着日コード</th>
			<th>得意先着日名</th>
			<th>売上伝票種別コード</th>
			<th>売上伝票種別名</th>
			<th>請求書種別コード</th>
			<th>請求書種別名</th>
			<th>直送納品書郵送要不要</th>
			<th>請求書郵送要不要</th>
			<th>売上確定時印刷用紙</th>
			<th>得意先備考1</th>
			<th>得意先備考2</th>
			<th>得意先備考3</th>
			<th>得意先拡張1</th>
			<th>得意先拡張2</th>
			<th>得意先拡張3</th>
			<th>得意先拡張4</th>
			<th>得意先拡張5</th>
        </tr>
    </thead>
    <tbody>
        @foreach($params['datas'] as $data)
            <tr>
                <td>{{ $data->customer_cd }}</td>
                <td>{{ $data->customer_name }}</td>
                <td>{{ $data->customer_name_kana }}</td>
                <td>{{ $data->billing_address_cd }}</td>
                <td>{{ $data->customer_name2 }}</td>
                <td>{{ $data->sticky_note_name }}</td>
                <td>{{ $data->payment_kbn }}</td>
                <td>{{ $data->user_cd }}</td>
                <td>{{ $data->user_name }}</td>
                <td>{{ $data->honorific_kbn }}</td>
                <td>{{ $data->post_number }}</td>
                <td>{{ $data->address }}</td>
                <td>{{ $data->tel }}</td>
                <td>{{ $data->fax }}</td>
                <td>{{ $data->representative_name }}</td>
                <td>{{ $data->representative_mail }}</td>
                <td>{{ $data->manager_cd }}</td>
                <td>{{ $data->manager_name }}</td>
                <td>{{ $data->manager_mail }}</td>
                <td>{{ $data->ec_login_id }}</td>
                <td>{{ $data->price_rate }}</td>
                <td>{{ $data->credit_limit_amount }}</td>
                <td>{{ $data->credit_limit_amount_check_flg }}</td>
                <td>{{ $data->customer_class_cd1 }}</td>
                <td>{{ $data->customer_class_name1 }}</td>
                <td>{{ $data->customer_class_cd2 }}</td>
                <td>{{ $data->customer_class_name2 }}</td>
                <td>{{ $data->customer_class_cd3 }}</td>
                <td>{{ $data->customer_class_name3 }}</td>
                <td>{{ $data->district_class_cd }}</td>
                <td>{{ $data->district_class_name }}</td>
                <td>{{ $data->pioneer_year_cd }}</td>
                <td>{{ $data->pioneer_year_name }}</td>
                <td>{{ $data->sequentially_kbn }}</td>
                <td>{{ $data->closing_date_1 }}</td>
                <td>{{ $data->collect_month_1 }}</td>
                <td>{{ $data->collect_date_1 }}</td>
                <td>{{ $data->closing_date_2 }}</td>
                <td>{{ $data->collect_month_2 }}</td>
                <td>{{ $data->collect_date_2 }}</td>
                <td>{{ $data->closing_date_3 }}</td>
                <td>{{ $data->collect_month_3 }}</td>
                <td>{{ $data->collect_date_3 }}</td>
                <td>{{ $data->invoice_notification_mail_1 }}</td>
                <td>{{ $data->invoice_notification_mail_2 }}</td>
                <td>{{ $data->payment_guidance_mail }}</td>
                <td>{{ $data->payment_guidance_send_flg }}</td>
                <td>{{ $data->customer_url }}</td>
                <td>{{ $data->name_input_kbn }}</td>
                <td>{{ $data->del_kbn }}</td>
                <td>{{ $data->price_fraction_process }}</td>
                <td>{{ $data->all_amount_fraction_process }}</td>
                <td>{{ $data->tax_kbn }}</td>
                <td>{{ $data->tax_fare_rate_application }}</td>
                <td>{{ $data->tax_calculation_standard }}</td>
                <td>{{ $data->tax_fraction_process_yen }}</td>
                <td>{{ $data->tax_fraction_process }}</td>
                <td>{{ $data->delivery_price }}</td>
                <td>{{ $data->warehouse_cd }}</td>
                <td>{{ $data->warehouse_name }}</td>
                <td>{{ $data->root_cd }}</td>
                <td>{{ $data->root_name }}</td>
                <td>{{ $data->item_class_cd }}</td>
                <td>{{ $data->item_class_name }}</td>
                <td>{{ $data->arrival_date_cd }}</td>
                <td>{{ $data->arrival_date_name }}</td>
                <td>{{ $data->slip_kind_cd }}</td>
                <td>{{ $data->slip_kind_name }}</td>
                <td>{{ $data->invoice_kind_flg }}</td>
                <td>{{ $data->invoice_kind_flg === 1 ? '明細あり' : '明細なし' }}</td>
                <td>{{ $data->direct_delivery_slip_mailing_flg }}</td>
                <td>{{ $data->invoice_mailing_flg }}</td>
                <td>{{ $data->sale_decision_print_paper_flg }}</td>
                <td>{{ $data->customer_memo_1 }}</td>
                <td>{{ $data->customer_memo_2 }}</td>
                <td>{{ $data->customer_memo_3 }}</td>
                <td>{{ $data->customer_expansion_1 }}</td>
                <td>{{ $data->customer_expansion_2 }}</td>
                <td>{{ $data->customer_expansion_3 }}</td>
                <td>{{ $data->customer_expansion_4 }}</td>
                <td>{{ $data->customer_expansion_5 }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
@endsection
