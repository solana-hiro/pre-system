@extends('layouts.admin.file')
@section('page_title', 'プレビュー')
@section('title', 'プレビュー')

@section('content')
	<table>
	    <thead>
	        <tr>
	            <th>PS区分コード：</th>
	            <th>{{ "0" }}</th>
	        </tr>
	        <tr>
	            <th>得意先コード範囲：</th>
	            <th>{{ $params['customerStartCode'] }}</th>
	            <th>～</th>
	            <th>{{ $params['customerEndCode'] }}</th>
	        </tr>
	        <tr>
	            <th>ブランド1コード範囲：</th>
	            <th>{{ $params['brandStartCode'] }}</th>
	            <th>～</th>
	            <th>{{ $params['brandEndCode'] }}</th>
	        </tr>
	        <tr>
	            <th>処理日：</th>
	            <th>{{ $params['currentDate'] }}</th>
	        </tr>
	        <tr></tr>
	        <tr>
				<th>PS区分コード</th>
				<th>PS区分名</th>
				<th>得意先コード</th>
				<th>得意先名</th>
				<th>商品分類コード</th>
				<th>商品分類名</th>
				<th>掛率</th>
				<th>開始日付</th>
				<th>終了日付</th>
				<th>旧掛率</th>
				<th>旧開始日付</th>
				<th>旧終了日付</th>
	        </tr>
	    </thead>
	    <tbody>
	        @foreach($params['datas'] as $data)
	            <tr>
					<td>{{ "0" }}</td>
					<td>{{ "プロパー" }}</td>
					<td>{{ $data->customer_cd }}</td>
					<td>{{ $data->customer_name }}</td>
					<td>{{ $data->item_class_cd }}</td>
					<td>{{ $data->item_class_name }}</td>
					<td>{{ $data->rate }}</td>
					<td>{{ $data->start_date }}</td>
					<td>{{ $data->end_date }}</td>
					<td>{{ $data->old_rate }}</td>
					<td>{{ $data->old_start_date }}</td>
					<td>{{ $data->old_end_date }}</td>
	            </tr>
	        @endforeach
	    </tbody>
	</table>
@endsection
