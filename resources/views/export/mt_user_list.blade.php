@extends('layouts.admin.file')
@section('page_title', '一覧表')
@section('title', '一覧表')
@section('content')
<table>
    <thead>
        <tr>
            <th style="text-align:left;">■検索項目</th>
        </tr>
        <tr>
            <th style="text-align:left;">ユーザコード：</th>
            <th style="text-align:left;">{{ $params['user_cd'] }}</th>
        </tr>
        <tr>
            <th style="text-align:left;">ユーザ名(部分）：</th>
            <th style="text-align:left;">{{ $params['user_name'] }}</th>
        </tr>
        <tr>
            <th style="text-align:left;">ユーザ名カナ(部分）：</th>
            <th style="text-align:left;">{{ $params['user_name_kana'] }}</th>
        </tr>
        <tr>
            <th style="text-align:left;">部門：</th>
            <th style="text-align:left;">{{ $params['department_cd'] }}</th>
        </tr>
        <tr>
            <th style="text-align:left;">単価訂正可能のみ：</th>
            <th style="text-align:left;">{{ $params['sp_auth_price_correction_possible'] }}</th>
        </tr>
        <tr>
            <th style="text-align:left;">★無し可能のみ：</th>
            <th style="text-align:left;">{{ $params['sp_auth_star_none_possible'] }}</th>
        </tr>
        <tr>
            <th style="text-align:left;">手検品可能のみ：</th>
            <th style="text-align:left;">{{ $params['sp_auth_hand_inspection_possible'] }}</th>
        </tr>
        <tr>
            <th style="text-align:left;">有効のみ：</th>
            <th style="text-align:left;">{{ $params['validity_flg'] }}</th>
        </tr>
        <tr>
            <th style="text-align:left;">処理日：</th>
            <th style="text-align:left;">{{ $params['currentDate'] }}</th>
        </tr>
        <tr></tr>
        <tr>
			<th style="text-align:left;">No.</th>
			<th style="text-align:left;">ユーザコード</th>
			<th style="text-align:left;">ユーザ名</th>
			<th style="text-align:left;">ユーザ名カナ</th>
			<th style="text-align:left;">部門コード</th>
			<th style="text-align:left;">部門名</th>
			<th style="text-align:left;">単価訂正可能</th>
            <th style="text-align:left;">★無し可能</th>
            <th style="text-align:left;">手検品可能</th>
            <th style="text-align:left;">有効</th>
		</tr>
    </thead>
    <tbody>
        @php $i=1; @endphp
        @foreach($params['datas'] as $data)
            <tr>
				<td style="text-align:left;">{{ $i }}</td>
				<td style="text-align:left;">{{ $data->user_cd }}</td>
				<td style="text-align:left;">{{ $data->user_name }}</td>
				<td style="text-align:left;">{{ $data->user_name_kana }}</td>
				<td style="text-align:left;">{{ $data->department_cd }}</td>
				<td style="text-align:left;">{{ $data->department_name }}</td>
                <td style="text-align:left;">{{ $data->sp_auth_price_correction_possible === 1 ? $data->sp_auth_price_correction_possible : '' }}</td>
				<td style="text-align:left;">{{ $data->sp_auth_star_none_possible  === 1 ? $data->sp_auth_star_none_possible : '' }}</td>
				<td style="text-align:left;">{{ $data->sp_auth_hand_inspection_possible === 1 ? $data->sp_auth_hand_inspection_possible : '' }}</td>
				<td style="text-align:left;">{{ $data->validity_flg === 1 ? $data->validity_flg : '' }}</td>
            </tr>
            @php $i++; @endphp
        @endforeach
    </tbody>
</table>
@endsection
