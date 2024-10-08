@extends('layouts.admin.file')
@section('page_title', 'プレビュー')
@section('title', 'プレビュー')

@section('content')
	<table>
	    <thead>
	        <tr>
	            <th>運送会社コード範囲：</th>
	            <th>{{ $params['startCode'] }}</th>
	            <th>～</th>
	            <th>{{ $params['endCode'] }}</th>
	        </tr>
	        <tr>
	            <th>処理日：</th>
	            <th>{{ $params['currentDate'] }}</th>
	        </tr>
	        <tr></tr>
	        <tr>
				<th>運送会社コード</th>
				<th>運送会社名</th>
				<th>送り状種別</th>
				<th>荷札種別</th>
			</tr>
	    </thead>
	    <tbody>
	        @foreach($params['datas'] as $data)
	            <tr>
					<td>{{ $data->shipping_company_cd }}</td>
					<td>{{ $data->shipping_company_name }}</td>
					<td>{{ $data->slip_kind_7_cd }}</td>
					<td>{{ $data->slip_kind_17_cd }}</td>
	            </tr>
	        @endforeach
	    </tbody>
	</table>
@endsection
