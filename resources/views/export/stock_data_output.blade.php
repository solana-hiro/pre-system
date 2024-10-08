@extends('layouts.admin.file')
@section('page_title', '一覧表')
@section('title', '一覧表')
@section('content')

<table>
    <thead>
        <tr>
			<th style="text-align:left;">JANコード</th>
			<th style="text-align:left;">他品番</th>
			<th style="text-align:left;">商品コード</th>
			<th style="text-align:left;">商品名</th>
			<th style="text-align:left;">カラーコード</th>
			<th style="text-align:left;">カラー名</th>
			<th style="text-align:left;">サイズコード</th>
			<th style="text-align:left;">サイズ名</th>
			<th style="text-align:left;">販売可能数</th>
			<th style="text-align:left;">第1入荷日</th>
			<th style="text-align:left;">第1入荷予定数</th>
			<th style="text-align:left;">第1入荷備考</th>
			<th style="text-align:left;">第2入荷日</th>
			<th style="text-align:left;">第2入荷予定数</th>
			<th style="text-align:left;">第3入荷日</th>
			<th style="text-align:left;">第3入荷予定数</th>
			<th style="text-align:left;">第4入荷日</th>
			<th style="text-align:left;">第4入荷予定数</th>
			<th style="text-align:left;">I名人連携区分</th>
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