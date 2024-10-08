@extends('layouts.admin.file')
@section('page_title', '一覧表')
@section('title', '一覧表')
@section('content')

<table>
    <thead>
        <tr>
            <th style="text-align:left;">カラーパターンコード範囲：</th>
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
			<th style="text-align:left;">カラーパターンコード</th>
			<th style="text-align:left;">カラーコード1</th>
			<th style="text-align:left;">カラー名1</th>
			<th style="text-align:left;">カラーコード2</th>
			<th style="text-align:left;">カラー名2</th>
			<th style="text-align:left;">カラーコード3</th>
			<th style="text-align:left;">カラー名3</th>
			<th style="text-align:left;">カラーコード4</th>
			<th style="text-align:left;">カラー名4</th>
			<th style="text-align:left;">カラーコード5</th>
			<th style="text-align:left;">カラー名5</th>
			<th style="text-align:left;">カラーコード6</th>
			<th style="text-align:left;">カラー名6</th>
			<th style="text-align:left;">カラーコード7</th>
			<th style="text-align:left;">カラー名7</th>
			<th style="text-align:left;">カラーコード8</th>
			<th style="text-align:left;">カラー名8</th>
			<th style="text-align:left;">カラーコード9</th>
			<th style="text-align:left;">カラー名9</th>
			<th style="text-align:left;">カラーコード10</th>
			<th style="text-align:left;">カラー名10</th>
			<th style="text-align:left;">カラーコード11</th>
			<th style="text-align:left;">カラー名11</th>
			<th style="text-align:left;">カラーコード12</th>
			<th style="text-align:left;">カラー名12</th>
			<th style="text-align:left;">カラーコード13</th>
			<th style="text-align:left;">カラー名13</th>
			<th style="text-align:left;">カラーコード14</th>
			<th style="text-align:left;">カラー名14</th>
			<th style="text-align:left;">カラーコード15</th>
			<th style="text-align:left;">カラー名15</th>
			<th style="text-align:left;">カラーコード16</th>
			<th style="text-align:left;">カラー名16</th>
			<th style="text-align:left;">カラーコード17</th>
			<th style="text-align:left;">カラー名17</th>
			<th style="text-align:left;">カラーコード18</th>
			<th style="text-align:left;">カラー名18</th>
			<th style="text-align:left;">カラーコード19</th>
			<th style="text-align:left;">カラー名19</th>
			<th style="text-align:left;">カラーコード20</th>
			<th style="text-align:left;">カラー名20</th>
        </tr>
    </thead>
    <tbody>
        @foreach($params['datas'] as $data)
            <tr>
				<td style="text-align:left;">{{ $data->color_pattern_cd }}</td>
				<td style="text-align:left;">{{ $data->color_cd_1 }}</td>
				<td style="text-align:left;">{{ $data->color_name_1 }}</td>
				<td style="text-align:left;">{{ $data->color_cd_2 }}</td>
				<td style="text-align:left;">{{ $data->color_name_2 }}</td>
				<td style="text-align:left;">{{ $data->color_cd_3 }}</td>
				<td style="text-align:left;">{{ $data->color_name_3 }}</td>
				<td style="text-align:left;">{{ $data->color_cd_4 }}</td>
				<td style="text-align:left;">{{ $data->color_name_4 }}</td>
				<td style="text-align:left;">{{ $data->color_cd_5 }}</td>
				<td style="text-align:left;">{{ $data->color_name_5 }}</td>
				<td style="text-align:left;">{{ $data->color_cd_6 }}</td>
				<td style="text-align:left;">{{ $data->color_name_6 }}</td>
				<td style="text-align:left;">{{ $data->color_cd_7 }}</td>
				<td style="text-align:left;">{{ $data->color_name_7 }}</td>
				<td style="text-align:left;">{{ $data->color_cd_8 }}</td>
				<td style="text-align:left;">{{ $data->color_name_8 }}</td>
				<td style="text-align:left;">{{ $data->color_cd_9 }}</td>
				<td style="text-align:left;">{{ $data->color_name_9 }}</td>
				<td style="text-align:left;">{{ $data->color_cd_10 }}</td>
				<td style="text-align:left;">{{ $data->color_name_10 }}</td>
				<td style="text-align:left;">{{ $data->color_cd_11 }}</td>
				<td style="text-align:left;">{{ $data->color_name_11 }}</td>
				<td style="text-align:left;">{{ $data->color_cd_12 }}</td>
				<td style="text-align:left;">{{ $data->color_name_12 }}</td>
				<td style="text-align:left;">{{ $data->color_cd_13 }}</td>
				<td style="text-align:left;">{{ $data->color_name_13 }}</td>
				<td style="text-align:left;">{{ $data->color_cd_14 }}</td>
				<td style="text-align:left;">{{ $data->color_name_14 }}</td>
				<td style="text-align:left;">{{ $data->color_cd_15 }}</td>
				<td style="text-align:left;">{{ $data->color_name_15 }}</td>
				<td style="text-align:left;">{{ $data->color_cd_16 }}</td>
				<td style="text-align:left;">{{ $data->color_name_16 }}</td>
				<td style="text-align:left;">{{ $data->color_cd_17 }}</td>
				<td style="text-align:left;">{{ $data->color_name_17 }}</td>
				<td style="text-align:left;">{{ $data->color_cd_18 }}</td>
				<td style="text-align:left;">{{ $data->color_name_18 }}</td>
				<td style="text-align:left;">{{ $data->color_cd_19 }}</td>
				<td style="text-align:left;">{{ $data->color_name_19 }}</td>
				<td style="text-align:left;">{{ $data->color_cd_20 }}</td>
				<td style="text-align:left;">{{ $data->color_name_20 }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
@endsection
