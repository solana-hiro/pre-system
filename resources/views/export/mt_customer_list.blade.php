@extends('layouts.admin.file')
@section('page_title', '一覧表')
@section('title', '一覧表')
@section('content')

<table>
    <thead>
        <tr>
            <th style="text-align:left;">得意先コード範囲：</th>
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
			<th style="text-align:left;">得意先コード</th>
			<th style="text-align:left;">得意先名</th>
			<th style="text-align:left;">名カナ</th>
			<th style="text-align:left;">請求先コード</th>
			<th style="text-align:left;">請求先名</th>
			<th style="text-align:left;">付箋(特記事項)</th>
			<th style="text-align:left;">入金区分</th>
			<th style="text-align:left;">担当者コード</th>
			<th style="text-align:left;">担当名</th>
			<th style="text-align:left;">敬称区分</th>
			<th style="text-align:left;">郵便番号</th>
			<th style="text-align:left;">住所</th>
			<th style="text-align:left;">TEL</th>
			<th style="text-align:left;">FAX</th>
			<th style="text-align:left;">代表者名</th>
			<th style="text-align:left;">代表者E-Mail</th>
			<th style="text-align:left;">得意先担当者コード</th>
			<th style="text-align:left;">得意先担当者名</th>
			<th style="text-align:left;">得意先担当者E-Mail</th>
			<th style="text-align:left;">ECログインID</th>
			<th style="text-align:left;">単価掛率</th>
			<th style="text-align:left;">与信限度額</th>
			<th style="text-align:left;">与信限度額チェック</th>
			<th style="text-align:left;">販売ﾊﾟﾀｰﾝ 1コード</th>
			<th style="text-align:left;">販売ﾊﾟﾀｰﾝ 1名</th>
			<th style="text-align:left;">業種・特徴 2コード</th>
			<th style="text-align:left;">業種・特徴 2名</th>
			<th style="text-align:left;">ランク 3コード</th>
			<th style="text-align:left;">ランク 3名</th>
			<th style="text-align:left;">地区分類コード</th>
			<th style="text-align:left;">地区分類名</th>
			<th style="text-align:left;">開拓年分類コード</th>
			<th style="text-align:left;">開拓年分類名</th>
			<th style="text-align:left;">随時区分</th>
			<th style="text-align:left;">締日1</th>
			<th style="text-align:left;">回収月1</th>
			<th style="text-align:left;">回収日1</th>
			<th style="text-align:left;">締日2</th>
			<th style="text-align:left;">回収月2</th>
			<th style="text-align:left;">回収日2</th>
			<th style="text-align:left;">締日3</th>
			<th style="text-align:left;">回収月3</th>
			<th style="text-align:left;">回収日3</th>
			<th style="text-align:left;">請求書通知用E-Mail1</th>
			<th style="text-align:left;">請求書通知用E-Mail2</th>
			<th style="text-align:left;">入金案内用E-Mail</th>
			<th style="text-align:left;">入金案内送信要不要</th>
			<th style="text-align:left;">得意先URL</th>
			<th style="text-align:left;">名称入力区分</th>
			<th style="text-align:left;">削除区分</th>
			<th style="text-align:left;">単価端数処理</th>
			<th style="text-align:left;">金額端数処理</th>
			<th style="text-align:left;">消費税区分</th>
			<th style="text-align:left;">運賃掛率適用</th>
			<th style="text-align:left;">消費税算出基準</th>
			<th style="text-align:left;">消費税端数桁数区分</th>
			<th style="text-align:left;">消費税端数処理</th>
			<th style="text-align:left;">館内配送料</th>
			<th style="text-align:left;">受注倉庫コード</th>
			<th style="text-align:left;">受注倉庫名</th>
			<th style="text-align:left;">ルートコード</th>
			<th style="text-align:left;">ルートコード名</th>
			<th style="text-align:left;">運送会社コード</th>
			<th style="text-align:left;">運送会社名</th>
			<th style="text-align:left;">得意先着日コード</th>
			<th style="text-align:left;">得意先着日名</th>
			<th style="text-align:left;">売上伝票種別コード</th>
			<th style="text-align:left;">売上伝票種別名</th>
			<th style="text-align:left;">請求書種別コード</th>
			<th style="text-align:left;">請求書種別名</th>
			<th style="text-align:left;">直送納品書郵送要不要</th>
			<th style="text-align:left;">請求書郵送要不要</th>
			<th style="text-align:left;">売上確定時印刷用紙</th>
			<th style="text-align:left;">得意先備考1</th>
			<th style="text-align:left;">得意先備考2</th>
			<th style="text-align:left;">得意先備考3</th>
			<th style="text-align:left;">得意先拡張1</th>
			<th style="text-align:left;">得意先拡張2</th>
			<th style="text-align:left;">得意先拡張3</th>
			<th style="text-align:left;">得意先拡張4</th>
			<th style="text-align:left;">得意先拡張5</th>
        </tr>
    </thead>
    <tbody>
        @foreach($params['datas'] as $data)
            <tr>
                <td style="text-align:left;">{{ $data->customer_cd }}</td>
                <td style="text-align:left;">{{ $data->customer_name }}</td>
                <td style="text-align:left;">{{ $data->customer_name_kana }}</td>
                <td style="text-align:left;">{{ $data->billing_address_cd }}</td>
                <td style="text-align:left;">{{ $data->customer_name2 }}</td>
                <td style="text-align:left;">{{ $data->sticky_note_name }}</td>
                <td style="text-align:left;">{{ $data->payment_kbn }}</td>
                <td style="text-align:left;">{{ $data->user_cd }}</td>
                <td style="text-align:left;">{{ $data->user_name }}</td>
                <td style="text-align:left;">{{ $data->honorific_kbn }}</td>
                <td style="text-align:left;">{{ $data->post_number }}</td>
                <td style="text-align:left;">{{ $data->address }}</td>
                <td style="text-align:left;">{{ $data->tel }}</td>
                <td style="text-align:left;">{{ $data->fax }}</td>
                <td style="text-align:left;">{{ $data->representative_name }}</td>
                <td style="text-align:left;">{{ $data->representative_mail }}</td>
                <td style="text-align:left;">{{ $data->manager_cd }}</td>
                <td style="text-align:left;">{{ $data->manager_name }}</td>
                <td style="text-align:left;">{{ $data->manager_mail }}</td>
                <td style="text-align:left;">{{ $data->ec_login_id }}</td>
                <td style="text-align:left;">{{ $data->price_rate }}</td>
                <td style="text-align:left;">{{ $data->credit_limit_amount }}</td>
                <td style="text-align:left;">{{ $data->credit_limit_amount_check_flg }}</td>
                <td style="text-align:left;">{{ $data->customer_class_cd1 }}</td>
                <td style="text-align:left;">{{ $data->customer_class_name1 }}</td>
                <td style="text-align:left;">{{ $data->customer_class_cd2 }}</td>
                <td style="text-align:left;">{{ $data->customer_class_name2 }}</td>
                <td style="text-align:left;">{{ $data->customer_class_cd3 }}</td>
                <td style="text-align:left;">{{ $data->customer_class_name3 }}</td>
                <td style="text-align:left;">{{ $data->district_class_cd }}</td>
                <td style="text-align:left;">{{ $data->district_class_name }}</td>
                <td style="text-align:left;">{{ $data->pioneer_year_cd }}</td>
                <td style="text-align:left;">{{ $data->pioneer_year_name }}</td>
                <td style="text-align:left;">{{ $data->sequentially_kbn }}</td>
                <td style="text-align:left;">{{ $data->closing_date_1 }}</td>
                <td style="text-align:left;">{{ $data->collect_month_1 }}</td>
                <td style="text-align:left;">{{ $data->collect_date_1 }}</td>
                <td style="text-align:left;">{{ $data->closing_date_2 }}</td>
                <td style="text-align:left;">{{ $data->collect_month_2 }}</td>
                <td style="text-align:left;">{{ $data->collect_date_2 }}</td>
                <td style="text-align:left;">{{ $data->closing_date_3 }}</td>
                <td style="text-align:left;">{{ $data->collect_month_3 }}</td>
                <td style="text-align:left;">{{ $data->collect_date_3 }}</td>
                <td style="text-align:left;">{{ $data->invoice_notification_mail_1 }}</td>
                <td style="text-align:left;">{{ $data->invoice_notification_mail_2 }}</td>
                <td style="text-align:left;">{{ $data->payment_guidance_mail }}</td>
                <td style="text-align:left;">{{ $data->payment_guidance_send_flg }}</td>
                <td style="text-align:left;">{{ $data->customer_url }}</td>
                <td style="text-align:left;">{{ $data->name_input_kbn }}</td>
                <td style="text-align:left;">{{ $data->del_kbn }}</td>
                <td style="text-align:left;">{{ $data->price_fraction_process }}</td>
                <td style="text-align:left;">{{ $data->all_amount_fraction_process }}</td>
                <td style="text-align:left;">{{ $data->tax_kbn }}</td>
                <td style="text-align:left;">{{ $data->tax_fare_rate_application }}</td>
                <td style="text-align:left;">{{ $data->tax_calculation_standard }}</td>
                <td style="text-align:left;">{{ $data->tax_fraction_process_yen }}</td>
                <td style="text-align:left;">{{ $data->tax_fraction_process }}</td>
                <td style="text-align:left;">{{ $data->delivery_price }}</td>
                <td style="text-align:left;">{{ $data->warehouse_cd }}</td>
                <td style="text-align:left;">{{ $data->warehouse_name }}</td>
                <td style="text-align:left;">{{ $data->root_cd }}</td>
                <td style="text-align:left;">{{ $data->root_name }}</td>
                <td style="text-align:left;">{{ $data->item_class_cd }}</td>
                <td style="text-align:left;">{{ $data->item_class_name }}</td>
                <td style="text-align:left;">{{ $data->arrival_date_cd }}</td>
                <td style="text-align:left;">{{ $data->arrival_date_name }}</td>
                <td style="text-align:left;">{{ $data->slip_kind_cd }}</td>
                <td style="text-align:left;">{{ $data->slip_kind_name }}</td>
                <td style="text-align:left;">{{ $data->invoice_kind_flg }}</td>
                <td style="text-align:left;">{{ $data->invoice_kind_flg === 1 ? '明細あり' : '明細なし' }}</td>
                <td style="text-align:left;">{{ $data->direct_delivery_slip_mailing_flg }}</td>
                <td style="text-align:left;">{{ $data->invoice_mailing_flg }}</td>
                <td style="text-align:left;">{{ $data->sale_decision_print_paper_flg }}</td>
                <td style="text-align:left;">{{ $data->customer_memo_1 }}</td>
                <td style="text-align:left;">{{ $data->customer_memo_2 }}</td>
                <td style="text-align:left;">{{ $data->customer_memo_3 }}</td>
                <td style="text-align:left;">{{ $data->customer_expansion_1 }}</td>
                <td style="text-align:left;">{{ $data->customer_expansion_2 }}</td>
                <td style="text-align:left;">{{ $data->customer_expansion_3 }}</td>
                <td style="text-align:left;">{{ $data->customer_expansion_4 }}</td>
                <td style="text-align:left;">{{ $data->customer_expansion_5 }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
@endsection
