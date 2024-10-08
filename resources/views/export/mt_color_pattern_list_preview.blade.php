@extends('layouts.admin.file')
@section('page_title', 'プレビュー')
@section('title', 'プレビュー')
@section('content')

	<table>
	    <thead>
	        <tr>
	            <th>カラーパターンコード範囲：</th>
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
				<th>カラーパターンコード</th>
				<th>カラーコード1</th>
				<th>カラー名1</th>
				<th>カラーコード2</th>
				<th>カラー名2</th>
				<th>カラーコード3</th>
				<th>カラー名3</th>
				<th>カラーコード4</th>
				<th>カラー名4</th>
				<th>カラーコード5</th>
				<th>カラー名5</th>
				<th>カラーコード6</th>
				<th>カラー名6</th>
				<th>カラーコード7</th>
				<th>カラー名7</th>
				<th>カラーコード8</th>
				<th>カラー名8</th>
				<th>カラーコード9</th>
				<th>カラー名9</th>
				<th>カラーコード10</th>
				<th>カラー名10</th>
				<th>カラーコード11</th>
				<th>カラー名11</th>
				<th>カラーコード12</th>
				<th>カラー名12</th>
				<th>カラーコード13</th>
				<th>カラー名13</th>
				<th>カラーコード14</th>
				<th>カラー名14</th>
				<th>カラーコード15</th>
				<th>カラー名15</th>
				<th>カラーコード16</th>
				<th>カラー名16</th>
				<th>カラーコード17</th>
				<th>カラー名17</th>
				<th>カラーコード18</th>
				<th>カラー名18</th>
				<th>カラーコード19</th>
				<th>カラー名19</th>
				<th>カラーコード20</th>
				<th>カラー名20</th>
	        </tr>
	    </thead>
	    <tbody>
	        @foreach($params['datas'] as $data)
	            <tr>
					<td>{{ $data->color_pattern_cd }}</td>
					<td>{{ $data->color_cd_1 }}</td>
					<td>{{ $data->color_name_1 }}</td>
					<td>{{ $data->color_cd_2 }}</td>
					<td>{{ $data->color_name_2 }}</td>
					<td>{{ $data->color_cd_3 }}</td>
					<td>{{ $data->color_name_3 }}</td>
					<td>{{ $data->color_cd_4 }}</td>
					<td>{{ $data->color_name_4 }}</td>
					<td>{{ $data->color_cd_5 }}</td>
					<td>{{ $data->color_name_5 }}</td>
					<td>{{ $data->color_cd_6 }}</td>
					<td>{{ $data->color_name_6 }}</td>
					<td>{{ $data->color_cd_7 }}</td>
					<td>{{ $data->color_name_7 }}</td>
					<td>{{ $data->color_cd_8 }}</td>
					<td>{{ $data->color_name_8 }}</td>
					<td>{{ $data->color_cd_9 }}</td>
					<td>{{ $data->color_name_9 }}</td>
					<td>{{ $data->color_cd_10 }}</td>
					<td>{{ $data->color_name_10 }}</td>
					<td>{{ $data->color_cd_11 }}</td>
					<td>{{ $data->color_name_11 }}</td>
					<td>{{ $data->color_cd_12 }}</td>
					<td>{{ $data->color_name_12 }}</td>
					<td>{{ $data->color_cd_13 }}</td>
					<td>{{ $data->color_name_13 }}</td>
					<td>{{ $data->color_cd_14 }}</td>
					<td>{{ $data->color_name_14 }}</td>
					<td>{{ $data->color_cd_15 }}</td>
					<td>{{ $data->color_name_15 }}</td>
					<td>{{ $data->color_cd_16 }}</td>
					<td>{{ $data->color_name_16 }}</td>
					<td>{{ $data->color_cd_17 }}</td>
					<td>{{ $data->color_name_17 }}</td>
					<td>{{ $data->color_cd_18 }}</td>
					<td>{{ $data->color_name_18 }}</td>
					<td>{{ $data->color_cd_19 }}</td>
					<td>{{ $data->color_name_19 }}</td>
					<td>{{ $data->color_cd_20 }}</td>
					<td>{{ $data->color_name_20 }}</td>
	            </tr>
	        @endforeach
	    </tbody>
	</table>
@endsection
