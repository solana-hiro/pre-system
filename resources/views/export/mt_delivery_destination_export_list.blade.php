@extends('layouts.admin.file')
@section('page_title', 'エラーリスト')
@section('title', 'エラーリスト')
@section('content')

<table>
    <thead>
        <tr>
			<th style="text-align:left;">得意先コード</th>
			<th style="text-align:left;">納品先コード</th>
			<th style="text-align:left;">納品先名</th>
			<th style="text-align:left;">名カナ</th>
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
			<th style="text-align:left;">運送会社コード</th>
			<th style="text-align:left;">納品先着日コード</th>
			<th style="text-align:left;">直送手数料請求</th>
			<th style="text-align:left;">売上確定時印刷用紙</th>
			<th style="text-align:left;">納品先備考1</th>
			<th style="text-align:left;">納品先備考2</th>
			<th style="text-align:left;">納品先備考3</th>
			<th style="text-align:left;">登録種別</th>
        </tr>
    </thead>
    <tbody>
    	@php $i = 1; @endphp
        @foreach($params['datas'] as $data)
            <tr>
				<td style="text-align:left; @if(in_array("得意先コード", $params['errorsList'][$i])) background-color: #FF0000; @endif" >{{ $data["得意先コード"] }}</td>
				<td style="text-align:left; @if(in_array("納品先コード", $params['errorsList'][$i])) background-color: #FF0000; @endif" >{{ $data["納品先コード"] }}</td>
				<td style="text-align:left; @if(in_array("納品先名", $params['errorsList'][$i])) background-color: #FF0000; @endif" >{{ $data["納品先名"] }}</td>
				<td style="text-align:left; @if(in_array("名カナ", $params['errorsList'][$i])) background-color: #FF0000; @endif" >{{ $data["名カナ"] }}</td>
				<td style="text-align:left; @if(in_array("敬称区分", $params['errorsList'][$i])) background-color: #FF0000; @endif" >{{ $data["敬称区分"] }}</td>
				<td style="text-align:left; @if(in_array("郵便番号", $params['errorsList'][$i])) background-color: #FF0000; @endif" >{{ $data["郵便番号"] }}</td>
				<td style="text-align:left; @if(in_array("住所", $params['errorsList'][$i])) background-color: #FF0000; @endif" >{{ $data["住所"] }}</td>
				<td style="text-align:left; @if(in_array("TEL", $params['errorsList'][$i])) background-color: #FF0000; @endif" >{{ $data["TEL"] }}</td>
				<td style="text-align:left; @if(in_array("FAX", $params['errorsList'][$i])) background-color: #FF0000; @endif" >{{ $data["FAX"] }}</td>
				<td style="text-align:left; @if(in_array("代表者名", $params['errorsList'][$i])) background-color: #FF0000; @endif" >{{ $data["代表者名"] }}</td>
				<td style="text-align:left; @if(in_array("代表者名E-Mail", $params['errorsList'][$i])) background-color: #FF0000; @endif" >{{ $data["代表者名E-Mail"] }}</td>
				<td style="text-align:left; @if(in_array("納品先担当者名", $params['errorsList'][$i])) background-color: #FF0000; @endif" >{{ $data["納品先担当者名"] }}</td>
				<td style="text-align:left; @if(in_array("納品先担当者名E-Mail", $params['errorsList'][$i])) background-color: #FF0000; @endif" >{{ $data["納品先担当者名E-Mail"] }}</td>
				<td style="text-align:left; @if(in_array("納品先URL", $params['errorsList'][$i])) background-color: #FF0000; @endif" >{{ $data["納品先URL"] }}</td>
				<td style="text-align:left; @if(in_array("名称入力区分", $params['errorsList'][$i])) background-color: #FF0000; @endif" >{{ $data["名称入力区分"] }}</td>
				<td style="text-align:left; @if(in_array("削除区分(得意先)", $params['errorsList'][$i])) background-color: #FF0000; @endif" >{{ $data["削除区分(得意先)"] }}</td>
				<td style="text-align:left; @if(in_array("削除区分(納品先)", $params['errorsList'][$i])) background-color: #FF0000; @endif" >{{ $data["削除区分(納品先)"] }}</td>
				<td style="text-align:left; @if(in_array("館内配送料", $params['errorsList'][$i])) background-color: #FF0000; @endif" >{{ $data["館内配送料"] }}</td>
				<td style="text-align:left; @if(in_array("ルートコード", $params['errorsList'][$i])) background-color: #FF0000; @endif" >{{ $data["ルートコード"] }}</td>
				<td style="text-align:left; @if(in_array("運送会社コード", $params['errorsList'][$i])) background-color: #FF0000; @endif" >{{ $data["運送会社コード"] }}</td>
				<td style="text-align:left; @if(in_array("納品先着日コード", $params['errorsList'][$i])) background-color: #FF0000; @endif" >{{ $data["納品先着日コード"] }}</td>
				<td style="text-align:left; @if(in_array("直送手数料請求", $params['errorsList'][$i])) background-color: #FF0000; @endif" >{{ $data["直送手数料請求"] }}</td>
				<td style="text-align:left; @if(in_array("売上確定時印刷用紙", $params['errorsList'][$i])) background-color: #FF0000; @endif" >{{ $data["売上確定時印刷用紙"] }}</td>
				<td style="text-align:left; @if(in_array("納品先備考1", $params['errorsList'][$i])) background-color: #FF0000; @endif" >{{ $data["納品先備考1"] }}</td>
				<td style="text-align:left; @if(in_array("納品先備考2", $params['errorsList'][$i])) background-color: #FF0000; @endif" >{{ $data["納品先備考2"] }}</td>
				<td style="text-align:left; @if(in_array("納品先備考3", $params['errorsList'][$i])) background-color: #FF0000; @endif" >{{ $data["納品先備考3"] }}</td>
				<td style="text-align:left; @if(in_array("登録種別", $params['errorsList'][$i])) background-color: #FF0000; @endif" >{{ $data["登録種別"] }}</td>
				<td style="text-align:left;" >{{ $data["エラー内容"] }}</td>
				@php $i++; @endphp
			</tr>
        @endforeach
    </tbody>
</table>
@endsection
