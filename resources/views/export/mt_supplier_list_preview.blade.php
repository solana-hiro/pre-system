@extends('layouts.admin.file')
@section('page_title', 'プレビュー')
@section('title', 'プレビュー')

@section('content')

    <table>
        <thead>
            <tr>
                <th>仕入先コード範囲：</th>
                <th>{{ str_pad($params['startDate'], 6, 0, STR_PAD_LEFT) }}</th>
                <th>～</th>
                <th>{{ str_pad($params['endDate'], 6, 0, STR_PAD_LEFT) }}</th>
            </tr>
            <tr>
                <th>処理日：</th>
                <th>{{ $params['currentDate'] }}</th>
            </tr>
            <tr></tr>
            <tr>
                <th style="text-align:left;">仕入先コード</th>
                <th style="text-align:left;">仕入先名</th>
                <th style="text-align:left;">名カナ</th>
                <th style="text-align:left;">支払先コード</th>
                <th style="text-align:left;">支払先名</th>
                <th style="text-align:left;">担当者コード</th>
                <th style="text-align:left;">担当名</th>
                <th style="text-align:left;">敬称区分</th>
                <th style="text-align:left;">郵便番号</th>
                <th style="text-align:left;">住所</th>
                <th style="text-align:left;">TEL</th>
                <th style="text-align:left;">FAX</th>
                <th style="text-align:left;">代表者名</th>
                <th style="text-align:left;">代表者E-Mail</th>
                <th style="text-align:left;">仕入先担当者名</th>
                <th style="text-align:left;">仕入先担当者E-Mail</th>
                <th style="text-align:left;">仕入先分類1コード</th>
                <th style="text-align:left;">仕入先分類1名</th>
                <th style="text-align:left;">仕入先分類2コード</th>
                <th style="text-align:left;">仕入先分類2名</th>
                <th style="text-align:left;">仕入先分類3コード</th>
                <th style="text-align:left;">仕入先分類3名</th>
                <th style="text-align:left;">随時区分</th>
                <th style="text-align:left;">締日</th>
                <th style="text-align:left;">締月</th>
                <th style="text-align:left;">支払日</th>
                <th style="text-align:left;">仕入先ＵＲＬ</th>
                <th style="text-align:left;">名称入力区分</th>
                <th style="text-align:left;">削除区分</th>
                <th style="text-align:left;">単価端数処理</th>
                <th style="text-align:left;">金額端数処理</th>
                <th style="text-align:left;">消費税区分</th>
                <th style="text-align:left;">消費税算出基準</th>
                <th style="text-align:left;">消費税端数処理桁数区分</th>
                <th style="text-align:left;">消費税端数処理区分</th>
                <th style="text-align:left;">発注伝票種別コード</th>
                <th style="text-align:left;">発注伝票種別名</th>
                <th style="text-align:left;">仕入先備考1</th>
                <th style="text-align:left;">仕入先備考2</th>
                <th style="text-align:left;">仕入先備考3</th>
                <th style="text-align:left;">仕入先拡張1</th>
                <th style="text-align:left;">仕入先拡張2</th>
                <th style="text-align:left;">仕入先拡張3</th>
                <th style="text-align:left;">仕入先拡張4</th>
                <th style="text-align:left;">仕入先拡張5</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($params['datas'] as $data)
                <tr>
                    <td>{{ $data->supplier_cd }}</td>
                    <td>{{ $data->supplier_name }}</td>
                    <td>{{ $data->supplier_name_kana }}</td>
                    <td>{{ $data->pay_destination_cd }}</td>
                    <td>{{ $data->supplier_name }}</td>
                    <td>{{ $data->user_cd }}</td>
                    <td>{{ $data->user_name }}</td>
                    <td>{{ $data->honorific_kbn }}</td>
                    <td>{{ $data->post_number }}</td>
                    <td>{{ $data->address }}</td>
                    <td>{{ $data->tel }}</td>
                    <td>{{ $data->fax }}</td>
                    <td>{{ $data->representative_name }}</td>
                    <td>{{ $data->representative_mail }}</td>
                    <td>{{ $data->supplier_manager_name }}</td>
                    <td>{{ $data->supplier_manager_mail }}</td>
                    <td>{{ $data->supplier_class_cd1 }}</td>
                    <td>{{ $data->supplier_class_name1 }}</td>
                    <td>{{ $data->supplier_class_cd2 }}</td>
                    <td>{{ $data->supplier_class_name2 }}</td>
                    <td>{{ $data->supplier_class_cd3 }}</td>
                    <td>{{ $data->supplier_class_name3 }}</td>
                    <td>{{ $data->sequentially_kbn }}</td>
                    <td>{{ $data->closing_date }}</td>
                    <td>{{ $data->closing_month }}</td>
                    <td>{{ $data->pay_date }}</td>
                    <td>{{ $data->supplier_url }}</td>
                    <td>{{ $data->name_input_kbn }}</td>
                    <td>{{ $data->del_kbn }}</td>
                    <td>{{ $data->price_fraction_process }}</td>
                    <td>{{ $data->all_amount_fraction_process }}</td>
                    <td>{{ $data->tax_kbn }}</td>
                    <td>{{ $data->tax_calculation_standard }}</td>
                    <td>{{ $data->tax_fraction_process_1 }}</td>
                    <td>{{ $data->tax_fraction_process_2 }}</td>
                    <td>{{ $data->slip_kind_cd }}</td>
                    <td>{{ $data->slip_kind_name }}</td>
                    <td>{{ $data->supplier_memo_1 }}</td>
                    <td>{{ $data->supplier_memo_2 }}</td>
                    <td>{{ $data->supplier_memo_3 }}</td>
                    <td>{{ $data->supplier_expansion_1 }}</td>
                    <td>{{ $data->supplier_expansion_2 }}</td>
                    <td>{{ $data->supplier_expansion_3 }}</td>
                    <td>{{ $data->supplier_expansion_4 }}</td>
                    <td>{{ $data->supplier_expansion_5 }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

@endsection
