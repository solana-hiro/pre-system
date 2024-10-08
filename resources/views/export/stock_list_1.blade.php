@extends('layouts.admin.file')
@section('page_title', '一覧表')
@section('title', '一覧表')
@section('content')

<table>
    <thead>
        <tr>
			<th style="text-align:left;">ブランド1コード</th>
			<th style="text-align:left;">ブランド1名</th>
			<th style="text-align:left;">商品コード</th>
			<th style="text-align:left;">商品名</th>
			<th style="text-align:left;">前月末在庫</th>
			<th style="text-align:left;">当月入庫仕入数</th>
			<th style="text-align:left;">当月入庫移動数</th>
			<th style="text-align:left;">当月出庫売上数</th>
			<th style="text-align:left;">当月出庫移動数</th>
			<th style="text-align:left;">帳簿在庫数量</th>
			<th style="text-align:left;">在庫単価</th>
			<th style="text-align:left;">在庫金額</th>
			<th style="text-align:left;">上代単価</th>
			<th style="text-align:left;">上代金額</th>
		</tr>
    </thead>
    <tbody>
        @foreach($params['datas'] as $data)
            <tr>
				<td style="text-align:left;"></td>
				<td style="text-align:left;"></td>
            </tr>
        @endforeach
    </tbody>
</table>
@endsection