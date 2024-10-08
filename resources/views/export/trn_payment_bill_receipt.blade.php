@extends('layouts.admin.file')
@section('page_title', '受取手形一覧表')
@section('title', '受取手形一覧表')
@section('content')

<table>
    <thead>
        <tr>
            <th style="text-align:left;">対象年月</th>
            <th style="text-align:left;">{{ $params['targetDate'] }}</th>
        </tr>
        <tr>
            <th style="text-align:left;">処理日：</th>
            <th style="text-align:left;">{{ $params['currentDate'] }}</th>
        </tr>
        <tr></tr>
        <tr>
			<th style="text-align:left;">手形期日</th>
			<th style="text-align:left;">手形番号</th>
			<th style="text-align:left;">手形金額</th>
			<th style="text-align:left;">銀行コード</th>
			<th style="text-align:left;">銀行名</th>
			<th style="text-align:left;">得意先コード</th>
			<th style="text-align:left;">得意先名</th>
			<th style="text-align:left;">入金伝票NO</th>
			<th style="text-align:left;">受取手形日付</th>
			<th style="text-align:left;">備考1</th>
			<th style="text-align:left;">備考2</th>
		</tr>
    </thead>
    <tbody>
        @foreach($params['datas'] as $data)
            <tr>
				<td style="text-align:left;">{{ $data->bill_deadline }}</td>
				<td style="text-align:left;">{{ $data->bill_number }}</td>
				<td style="text-align:left;">{{ $data->amount }}</td>
				<td style="text-align:left;">{{ $data->bank_cd }}</td>
				<td style="text-align:left;">{{ $data->bank_name }}</td>
				<td style="text-align:left;">{{ $data->customer_cd }}</td>
				<td style="text-align:left;">{{ $data->customer_name }}</td>
				<td style="text-align:left;">{{ $data->payment_number }}</td>
				<td style="text-align:left;">{{ $data->payment_date }}</td>
				<td style="text-align:left;">{{ $data->memo1 }}</td>
				<td style="text-align:left;">{{ $data->memo2 }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
@endsection
