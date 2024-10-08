@extends('layouts.admin.file')
@section('page_title', 'エラーリスト')
@section('title', 'エラーリスト')
@section('content')

<table>
    <thead>
        <tr>
			<th style="text-align:left;">得意先コード</th>
			<th style="text-align:left;">得意先名</th>
			<th style="text-align:left;">名カナ</th>
			<th style="text-align:left;">請求先コード</th>
			<th style="text-align:left;">付箋(特記事項)</th>
			<th style="text-align:left;">入金区分</th>
			<th style="text-align:left;">担当者コード</th>
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
			<th style="text-align:left;">販売パターン1コード</th>
			<th style="text-align:left;">業種・特徴2コード</th>
			<th style="text-align:left;">ランク3コード</th>
			<th style="text-align:left;">地区分類コード</th>
			<th style="text-align:left;">開拓年分類コード</th>
			<th style="text-align:left;">請求書通知用E-Mail1</th>
			<th style="text-align:left;">請求書通知用E-Mail2</th>
			<th style="text-align:left;">入金案内用E-Mail</th>
			<th style="text-align:left;">入金案内送信要不要</th>
			<th style="text-align:left;">得意先URL</th>
			<th style="text-align:left;">名称入力区分</th>
			<th style="text-align:left;">削除区分</th>
			<th style="text-align:left;">消費税運賃掛率適用</th>
			<th style="text-align:left;">館内配送料</th>
			<th style="text-align:left;">受注倉庫コード</th>
			<th style="text-align:left;">ルートコード</th>
			<th style="text-align:left;">運送会社コード</th>
			<th style="text-align:left;">得意先着日コード</th>
			<th style="text-align:left;">売上伝票種別コード</th>
			<th style="text-align:left;">請求書種別</th>
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
			<th style="text-align:left;">エラー内容</th>
        </tr>
    </thead>
    <tbody>
    	@php $i = 1; @endphp
        @foreach($params['datas'] as $data)
            <tr>
				<td style="text-align:left; @if(in_array("得意先コード", $params['errorsList'][$i])) background-color: #FF0000; @endif" >{{ isset($data["得意先コード"]) ? $data["得意先コード"] : '' }}</td>
				<td style="text-align:left; @if(in_array("得意先名", $params['errorsList'][$i])) background-color: #ff0000; @endif" >{{ isset($data["得意先名"]) ? $data["得意先名"] : '' }}</td>
				<td style="text-align:left; @if(in_array("名カナ", $params['errorsList'][$i])) background-color: #ff0000; @endif" >{{ isset($data["名カナ"]) ? $data["名カナ"] : '' }}</td>
				<td style="text-align:left; @if(in_array("請求先コード", $params['errorsList'][$i])) background-color: #ff0000; @endif" >{{ isset($data["請求先コード"]) ? $data["請求先コード"] : '' }}</td>
				<td style="text-align:left; @if(in_array("付箋(特記事項)", $params['errorsList'][$i])) background-color: #ff0000; @endif" >{{ isset($data["付箋(特記事項)"]) ? $data["付箋(特記事項)"] : '' }}</td>
				<td style="text-align:left; @if(in_array("入金区分", $params['errorsList'][$i])) background-color: #ff0000; @endif" >{{ isset($data["入金区分"]) ? $data["入金区分"] : '' }}</td>
				<td style="text-align:left; @if(in_array("担当者コード", $params['errorsList'][$i])) background-color: #ff0000; @endif" >{{ isset($data["担当者コード"]) ? $data["担当者コード"] : '' }}</td>
				<td style="text-align:left; @if(in_array("敬称区分", $params['errorsList'][$i])) background-color: #ff0000; @endif" >{{ isset($data["敬称区分"]) ? $data["敬称区分"] : '' }}</td>
				<td style="text-align:left; @if(in_array("郵便番号", $params['errorsList'][$i])) background-color: #ff0000; @endif" >{{ isset($data["郵便番号"]) ? $data["郵便番号"] : '' }}</td>
				<td style="text-align:left; @if(in_array("住所", $params['errorsList'][$i])) background-color: #ff0000; @endif" >{{ isset($data["住所"]) ? $data["住所"] : '' }}</td>
				<td style="text-align:left; @if(in_array("TEL", $params['errorsList'][$i])) background-color: #ff0000; @endif" >{{ isset($data["TEL"]) ? $data["TEL"] : '' }}</td>
				<td style="text-align:left; @if(in_array("FAX", $params['errorsList'][$i])) background-color: #ff0000; @endif" >{{ isset($data["FAX"]) ? $data["FAX"] : '' }}</td>
				<td style="text-align:left; @if(in_array("代表者名", $params['errorsList'][$i])) background-color: #ff0000; @endif" >{{ isset($data["代表者名"]) ? $data["代表者名"] : '' }}</td>
				<td style="text-align:left; @if(in_array("代表者E-Mail", $params['errorsList'][$i])) background-color: #ff0000; @endif" >{{ isset($data["代表者E-Mail"]) ? $data["代表者E-Mail"] : '' }}</td>
				<td style="text-align:left; @if(in_array("得意先担当者コード", $params['errorsList'][$i])) background-color: #ff0000; @endif" >{{ isset($data["得意先担当者コード"]) ? $data["得意先担当者コード"] : '' }}</td>
				<td style="text-align:left; @if(in_array("得意先担当者名", $params['errorsList'][$i])) background-color: #ff0000; @endif" >{{ isset($data["得意先担当者名"]) ? $data["得意先担当者名"] : '' }}</td>
				<td style="text-align:left; @if(in_array("得意先担当者E-Mail", $params['errorsList'][$i])) background-color: #ff0000; @endif" >{{ isset($data["得意先担当者E-Mail"]) ? $data["得意先担当者E-Mail"] : '' }}</td>
				<td style="text-align:left; @if(in_array("ECログインID", $params['errorsList'][$i])) background-color: #ff0000; @endif" >{{ isset($data["ECログインID"]) ? $data["ECログインID"] : '' }}</td>
				<td style="text-align:left; @if(in_array("単価掛率", $params['errorsList'][$i])) background-color: #ff0000; @endif" >{{ isset($data["単価掛率"]) ? $data["単価掛率"] : '' }}</td>
				<td style="text-align:left; @if(in_array("与信限度額", $params['errorsList'][$i])) background-color: #ff0000; @endif" >{{ isset($data["与信限度額"]) ? $data["与信限度額"] : '' }}</td>
				<td style="text-align:left; @if(in_array("与信限度額チェック", $params['errorsList'][$i])) background-color: #ff0000; @endif" >{{ isset($data["与信限度額チェック"]) ? $data["与信限度額チェック"] : '' }}</td>
				<td style="text-align:left; @if(in_array("販売パターン1コード", $params['errorsList'][$i])) background-color: #ff0000; @endif" >{{ isset($data["販売パターン1コード"]) ? $data["販売パターン1コード"] : '' }}</td>
				<td style="text-align:left; @if(in_array("業種・特徴2コード", $params['errorsList'][$i])) background-color: #ff0000; @endif" >{{ isset($data["業種・特徴2コード"]) ? $data["業種・特徴2コード"] : '' }}</td>
				<td style="text-align:left; @if(in_array("ランク3コード", $params['errorsList'][$i])) background-color: #ff0000; @endif" >{{ isset($data["ランク3コード"]) ? $data["ランク3コード"] : '' }}</td>
				<td style="text-align:left; @if(in_array("地区分類コード", $params['errorsList'][$i])) background-color: #ff0000; @endif" >{{ isset($data["地区分類コード"]) ? $data["地区分類コード"] : '' }}</td>
				<td style="text-align:left; @if(in_array("開拓年分類コード", $params['errorsList'][$i])) background-color: #ff0000; @endif" >{{ isset($data["開拓年分類コード"]) ? $data["開拓年分類コード"] : '' }}</td>
				<td style="text-align:left; @if(in_array("請求書通知用E-Mail1", $params['errorsList'][$i])) background-color: #ff0000; @endif" >{{ isset($data["請求書通知用E-Mail1"]) ? $data["請求書通知用E-Mail1"] : '' }}</td>
				<td style="text-align:left; @if(in_array("請求書通知用E-Mail2", $params['errorsList'][$i])) background-color: #ff0000; @endif" >{{ isset($data["請求書通知用E-Mail2"]) ? $data["請求書通知用E-Mail2"] : '' }}</td>
				<td style="text-align:left; @if(in_array("入金案内用E-Mail", $params['errorsList'][$i])) background-color: #ff0000; @endif" >{{ isset($data["入金案内用E-Mail"]) ? $data["入金案内用E-Mail"] : '' }}</td>
				<td style="text-align:left; @if(in_array("入金案内送信要不要", $params['errorsList'][$i])) background-color: #ff0000; @endif" >{{ isset($data["入金案内送信要不要"]) ? $data["入金案内送信要不要"] : '' }}</td>
				<td style="text-align:left; @if(in_array("得意先URL", $params['errorsList'][$i])) background-color: #ff0000; @endif" >{{ isset($data["得意先URL"]) ? $data["得意先URL"] : '' }}</td>
				<td style="text-align:left; @if(in_array("名称入力区分", $params['errorsList'][$i])) background-color: #ff0000; @endif" >{{ isset($data["名称入力区分"]) ? $data["名称入力区分"] : '' }}</td>
				<td style="text-align:left; @if(in_array("削除区分", $params['errorsList'][$i])) background-color: #ff0000; @endif" >{{ isset($data["削除区分"]) ? $data["削除区分"] : '' }}</td>
				<td style="text-align:left; @if(in_array("消費税運賃掛率適用", $params['errorsList'][$i])) background-color: #ff0000; @endif" >{{ isset($data["消費税運賃掛率適用"]) ? $data["消費税運賃掛率適用"] : '' }}</td>
				<td style="text-align:left; @if(in_array("館内配送料", $params['errorsList'][$i])) background-color: #ff0000; @endif" >{{ isset($data["館内配送料"]) ? $data["館内配送料"] : '' }}</td>
				<td style="text-align:left; @if(in_array("受注倉庫コード", $params['errorsList'][$i])) background-color: #ff0000; @endif" >{{ isset($data["受注倉庫コード"]) ? $data["受注倉庫コード"] : '' }}</td>
				<td style="text-align:left; @if(in_array("ルートコード", $params['errorsList'][$i])) background-color: #ff0000; @endif" >{{ isset($data["ルートコード"]) ? $data["ルートコード"] : '' }}</td>
				<td style="text-align:left; @if(in_array("運送会社コード", $params['errorsList'][$i])) background-color: #ff0000; @endif" >{{ isset($data["運送会社コード"]) ? $data["運送会社コード"] : '' }}</td>
				<td style="text-align:left; @if(in_array("得意先着日コード", $params['errorsList'][$i])) background-color: #ff0000; @endif" >{{ isset($data["得意先着日コード"]) ? $data["得意先着日コード"] : '' }}</td>
				<td style="text-align:left; @if(in_array("売上伝票種別コード", $params['errorsList'][$i])) background-color: #ff0000; @endif" >{{ isset($data["売上伝票種別コード"]) ? $data["売上伝票種別コード"] : '' }}</td>
				<td style="text-align:left; @if(in_array("請求書種別", $params['errorsList'][$i])) background-color: #ff0000; @endif" >{{ isset($data["請求書種別"]) ? $data["請求書種別"] : '' }}</td>
				<td style="text-align:left; @if(in_array("直送納品書郵送要不要", $params['errorsList'][$i])) background-color: #ff0000; @endif" >{{ isset($data["直送納品書郵送要不要"]) ? $data["直送納品書郵送要不要"] : '' }}</td>
				<td style="text-align:left; @if(in_array("請求書郵送要不要", $params['errorsList'][$i])) background-color: #ff0000; @endif" >{{ isset($data["請求書郵送要不要"]) ? $data["請求書郵送要不要"] : '' }}</td>
				<td style="text-align:left; @if(in_array("売上確定時印刷用紙", $params['errorsList'][$i])) background-color: #ff0000; @endif" >{{ isset($data["売上確定時印刷用紙"]) ? $data["売上確定時印刷用紙"] : '' }}</td>
				<td style="text-align:left; @if(in_array("得意先備考1", $params['errorsList'][$i])) background-color: #ff0000; @endif" >{{ isset($data["得意先備考1"]) ? $data["得意先備考1"] : '' }}</td>
				<td style="text-align:left; @if(in_array("得意先備考2", $params['errorsList'][$i])) background-color: #ff0000; @endif" >{{ isset($data["得意先備考2"]) ? $data["得意先備考2"] : '' }}</td>
				<td style="text-align:left; @if(in_array("得意先備考3", $params['errorsList'][$i])) background-color: #ff0000; @endif" >{{ isset($data["得意先備考3"]) ? $data["得意先備考3"] : '' }}</td>
				<td style="text-align:left; @if(in_array("得意先拡張1", $params['errorsList'][$i])) background-color: #ff0000; @endif" >{{ isset($data["得意先拡張1"]) ? $data["得意先拡張1"] : '' }}</td>
				<td style="text-align:left; @if(in_array("得意先拡張2", $params['errorsList'][$i])) background-color: #ff0000; @endif" >{{ isset($data["得意先拡張2"]) ? $data["得意先拡張2"] : '' }}</td>
				<td style="text-align:left; @if(in_array("得意先拡張3", $params['errorsList'][$i])) background-color: #ff0000; @endif" >{{ isset($data["得意先拡張3"]) ? $data["得意先拡張3"] : '' }}</td>
				<td style="text-align:left; @if(in_array("得意先拡張4", $params['errorsList'][$i])) background-color: #ff0000; @endif" >{{ isset($data["得意先拡張4"]) ? $data["得意先拡張4"] : '' }}</td>
				<td style="text-align:left; @if(in_array("得意先拡張5", $params['errorsList'][$i])) background-color: #ff0000; @endif" >{{ isset($data["得意先拡張5"]) ? $data["得意先拡張5"] : '' }}</td>
				<td style="text-align:left;" >{{ isset($data["エラー内容"]) ? $data["エラー内容"] : '' }}</td>
				@php $i++; @endphp
			</tr>
        @endforeach
    </tbody>
</table>
@endsection
