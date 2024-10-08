@extends('layouts.admin.file')
@section('page_title', '一覧表')
@section('title', '一覧表')
@section('content')

<table>
    <thead>
        <tr>
            <th>銀行コード範囲：</th>
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
			<th>銀行コード</th>
			<th>銀行名</th>
        </tr>
    </thead>
    <tbody>
        @foreach($params['datas'] as $data)
            <tr>
				<td>{{ $data->bank_cd }}</td>
				<td>{{ $data->bank_name }}</td>
            </tr>
        @endforeach
    </tbody>
</table>

@endsection