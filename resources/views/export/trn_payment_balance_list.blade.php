@extends('layouts.admin.file')
@section('page_title', '売掛残高一覧表')
@section('title', '売掛残高一覧表')
@section('content')

<table>
    <thead>
        <tr>
            <th style="text-align:left;">対象年月</th>
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
            <th style="text-align:left;">処理日：</th>
            <th style="text-align:left;">{{ $params['currentDate'] }}</th>
        </tr>
        <tr></tr>
        <tr>
    		<th style="text-align:left;">請求先コード</th>
			<th style="text-align:left;">請求先名</th>
			<th style="text-align:left;">前月残高</th>
			<th style="text-align:left;">総売上額</th>
            <th style="text-align:left;">返品額</th>
			<th style="text-align:left;">値引額</th>
			<th style="text-align:left;">純売上額</th>
            <th style="text-align:left;">消費税</th>
			<th style="text-align:left;">現金振込額</th>
			<th style="text-align:left;">手形額</th>
			<th style="text-align:left;">相殺値引額</th>
			<th style="text-align:left;">手数料他</th>
			<th style="text-align:left;">入金額</th>
            <th style="text-align:left;">当月残高</th>
            <th style="text-align:left;">消費税区分</th>
		</tr>
    </thead>
    <tbody>
        @foreach($params['datas'] as $data)
            <tr>
				<td style="text-align:left;">{{ $data->billing_address_cd }}</td>
				<td style="text-align:left;">{{ $data->customer_name }}</td>
				<td style="text-align:left;">{{ $data->col1 }}</td>
				<td style="text-align:left;">{{ $data->col2 }}</td>
				<td style="text-align:left;">{{ $data->col3 }}</td>
				<td style="text-align:left;">{{ $data->col4 }}</td>
				<td style="text-align:left;">{{ $data->col5 }}</td>
				<td style="text-align:left;">{{ $data->col6 }}</td>
				<td style="text-align:left;">{{ $data->col7 }}</td>
				<td style="text-align:left;">{{ $data->col8 }}</td>
				<td style="text-align:left;">{{ $data->col9 }}</td>
                <td style="text-align:left;">{{ $data->cpl10 }}</td>
                <td style="text-align:left;">{{ $data->col11 }}</td>
                <td style="text-align:left;">{{ $data->col12 }}</td>
                <td style="text-align:left;">{{ $data->tax_kbn }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
@endsection
