@extends('layouts.admin.file')
@section('page_title', '得意先元帳')
@section('title', '得意先元帳')
@section('content')

<table>
    <thead>
        <tr>
            <th style="text-align:left;">対象伝票日付</th>
            <th style="text-align:left;">{{ $params['startDate'] }}</th>
            <th style="text-align:left;">～</th>
            <th style="text-align:left;">{{ $params['endDate'] }}</th>
        </tr>
        <tr>
            <th style="text-align:left;">請求先コード範囲</th>
            <th style="text-align:left;">{{ $params['startCode'] }}</th>
            <th style="text-align:left;">～</th>
            <th style="text-align:left;">{{ $params['endCode'] }}</th>
        </tr>
        <tr>
            <th style="text-align:left;">出力条件</th>
            <th style="text-align:left;">{{ $params['outputKbn'] }}</th>
        </tr>
        <tr>
            <th style="text-align:left;">処理日：</th>
            <th style="text-align:left;">{{ $params['currentDate'] }}</th>
        </tr>
        <tr></tr>
        <tr>
			<th style="text-align:left;">請求先コード</th>
			<th style="text-align:left;">請求先名</th>
			<th style="text-align:left;">得意先コード</th>
			<th style="text-align:left;">得意先名</th>
			<th style="text-align:left;">販売日付</th>
			<th style="text-align:left;">今回経理締日付</th>
			<th style="text-align:left;">伝票区分</th>
			<th style="text-align:left;">販売NO</th>
			<th style="text-align:left;">現金区分</th>
			<th style="text-align:left;">取引区分名</th>
			<th style="text-align:left;">商品コード</th>
            <th style="text-align:left;">商品名</th>
            <th style="text-align:left;">売上数量</th>
            <th style="text-align:left;">単位名</th>
            <th style="text-align:left;">売上単価</th>
            <th style="text-align:left;">売上金額</th>
            <th style="text-align:left;">売上消費税額</th>
            <th style="text-align:left;">入金金額</th>
            <th style="text-align:left;">銀行名</th>
            <th style="text-align:left;">手形期日</th>
            <th style="text-align:left;">非課税区分</th>
            <th style="text-align:left;">明細備考1</th>
            <th style="text-align:left;">明細備考2</th>
            <th style="text-align:left;">相手先NO</th>
            <th style="text-align:left;">行NO</th>
            <th style="text-align:left;">税率</th>
		</tr>
    </thead>
    <tbody>
        @foreach($params['datas'] as $data)
            <tr>
				<td style="text-align:left;"></td>
				<td style="text-align:left;"></td>
				<td style="text-align:left;"></td>
				<td style="text-align:left;"></td>
				<td style="text-align:left;"></td>
				<td style="text-align:left;"></td>
				<td style="text-align:left;"></td>
				<td style="text-align:left;"></td>
				<td style="text-align:left;"></td>
				<td style="text-align:left;"></td>
				<td style="text-align:left;"></td>
                <td style="text-align:left;"></td>
				<td style="text-align:left;"></td>
				<td style="text-align:left;"></td>
				<td style="text-align:left;"></td>
				<td style="text-align:left;"></td>
            </tr>
        @endforeach
    </tbody>
</table>
@endsection
