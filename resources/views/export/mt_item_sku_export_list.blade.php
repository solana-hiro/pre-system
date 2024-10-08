@extends('layouts.admin.file')
@section('page_title', 'エラーリスト')
@section('title', 'エラーリスト')
@section('content')

<table>
    <thead>
        <tr>
			<th style="text-align:left;">JANコード</th>
            <th style="text-align:left;">商品コード</th>
            <th style="text-align:left;">他品番</th>
            <th style="text-align:left;">商品名</th>
            <th style="text-align:left;">名カナ</th>
            <th style="text-align:left;">単位名</th>
            <th style="text-align:left;">カラーコード</th>
            <th style="text-align:left;">カラー名</th>
            <th style="text-align:left;">サイズコード</th>
            <th style="text-align:left;">サイズ名</th>
            <th style="text-align:left;">非表示フラグ</th>
            <th style="text-align:left;">仕入先コード</th>
            <th style="text-align:left;">ブランド1コード</th>
            <th style="text-align:left;">競技・カテゴリコード</th>
            <th style="text-align:left;">ジャンルコード</th>
            <th style="text-align:left;">販売開始年コード</th>
            <th style="text-align:left;">工場分類5コード</th>
            <th style="text-align:left;">製品/工賃6コード</th>
            <th style="text-align:left;">資産在庫JAコード</th>
            <th style="text-align:left;">商品区分</th>
            <th style="text-align:left;">在庫管理区分</th>
            <th style="text-align:left;">非課税区分</th>
            <th style="text-align:left;">税率区分</th>
            <th style="text-align:left;">税抜上代単価</th>
            <th style="text-align:left;">税込上代単価</th>
            <th style="text-align:left;">税抜参考上代単価</th>
            <th style="text-align:left;">税込参考上代単価</th>
            <th style="text-align:left;">税抜仕入単価</th>
            <th style="text-align:left;">税込仕入単価</th>
            <th style="text-align:left;">原価単価</th>
            <th style="text-align:left;">粗利算出用原価単価</th>
            <th style="text-align:left;">名称入力区分</th>
            <th style="text-align:left;">削除区分</th>
            <th style="text-align:left;">メンバーサイト連携区分</th>
            <th style="text-align:left;">メンバーサイト商品コード</th>
            <th style="text-align:left;">メンバーサイト商品名</th>
            <th style="text-align:left;">商品備考1</th>
            <th style="text-align:left;">商品備考2</th>
            <th style="text-align:left;">商品備考3</th>
            <th style="text-align:left;">商品備考4</th>
            <th style="text-align:left;">商品備考5</th>
        </tr>
    </thead>
    <tbody>
    	@php $i = 1; @endphp
        @foreach($params['datas'] as $data)
            <tr>
                <td style="text-align:left; @if(in_array("JANコード", $params['errorsList'][$i])) background-color: #FF0000; @endif" >{{ isset($data["JANコード"]) ? $data["JANコード"] : '' }}</td>
                <td style="text-align:left; @if(in_array("商品コード", $params['errorsList'][$i])) background-color: #FF0000; @endif" >{{ isset($data["商品コード"]) ? $data["商品コード"] : '' }}</td>
                <td style="text-align:left; @if(in_array("他品番", $params['errorsList'][$i])) background-color: #FF0000; @endif" >{{ isset($data["他品番"]) ? $data["他品番"] : '' }}</td>
                <td style="text-align:left; @if(in_array("商品名", $params['errorsList'][$i])) background-color: #FF0000; @endif" >{{ isset($data["商品名"]) ? $data["商品名"] : '' }}</td>
                <td style="text-align:left; @if(in_array("名カナ", $params['errorsList'][$i])) background-color: #FF0000; @endif" >{{ isset($data["名カナ"]) ? $data["名カナ"] : '' }}</td>
                <td style="text-align:left; @if(in_array("単位名", $params['errorsList'][$i])) background-color: #FF0000; @endif" >{{ isset($data["単位名"]) ? $data["単位名"] : '' }}</td>
                <td style="text-align:left; @if(in_array("カラーコード", $params['errorsList'][$i])) background-color: #FF0000; @endif" >{{ isset($data["カラーコード"]) ? $data["カラーコード"] : '' }}</td>
                <td style="text-align:left; @if(in_array("カラー名", $params['errorsList'][$i])) background-color: #FF0000; @endif" >{{ isset($data["カラー名"]) ? $data["カラー名"] : '' }}</td>
                <td style="text-align:left; @if(in_array("サイズコード", $params['errorsList'][$i])) background-color: #FF0000; @endif" >{{ isset($data["サイズコード"]) ? $data["サイズコード"] : '' }}</td>
                <td style="text-align:left; @if(in_array("サイズ名", $params['errorsList'][$i])) background-color: #FF0000; @endif" >{{ isset($data["サイズ名"]) ? $data["サイズ名"] : '' }}</td>
                <td style="text-align:left; @if(in_array("非表示フラグ", $params['errorsList'][$i])) background-color: #FF0000; @endif" >{{ isset($data["非表示フラグ"]) ? $data["非表示フラグ"] : '' }}</td>
                <td style="text-align:left; @if(in_array("仕入先コード", $params['errorsList'][$i])) background-color: #FF0000; @endif" >{{ isset($data["仕入先コード"]) ? $data["仕入先コード"] : '' }}</td>
                <td style="text-align:left; @if(in_array("ブランド1コード", $params['errorsList'][$i])) background-color: #FF0000; @endif" >{{ isset($data["ブランド1コード"]) ? $data["ブランド1コード"] : '' }}</td>
                <td style="text-align:left; @if(in_array("競技・カテゴリコード", $params['errorsList'][$i])) background-color: #FF0000; @endif" >{{ isset($data["競技・カテゴリコード"]) ? $data["競技・カテゴリコード"] : '' }}</td>
                <td style="text-align:left; @if(in_array("ジャンルコード", $params['errorsList'][$i])) background-color: #FF0000; @endif" >{{ isset($data["ジャンルコード"]) ? $data["ジャンルコード"] : '' }}</td>
                <td style="text-align:left; @if(in_array("販売開始年コード", $params['errorsList'][$i])) background-color: #FF0000; @endif" >{{ isset($data["販売開始年コード"]) ? $data["販売開始年コード"] : '' }}</td>
                <td style="text-align:left; @if(in_array("工場分類5コード", $params['errorsList'][$i])) background-color: #FF0000; @endif" >{{ isset($data["工場分類5コード"]) ? $data["工場分類5コード"] : '' }}</td>
                <td style="text-align:left; @if(in_array("製品/工賃6コード", $params['errorsList'][$i])) background-color: #FF0000; @endif" >{{ isset($data["製品/工賃6コード"]) ? $data["製品/工賃6コード"] : '' }}</td>
                <td style="text-align:left; @if(in_array("資産在庫JAコード", $params['errorsList'][$i])) background-color: #FF0000; @endif" >{{ isset($data["資産在庫JAコード"]) ? $data["資産在庫JAコード"] : '' }}</td>
                <td style="text-align:left; @if(in_array("商品区分", $params['errorsList'][$i])) background-color: #FF0000; @endif" >{{ isset($data["商品区分"]) ? $data["商品区分"] : '' }}</td>
                <td style="text-align:left; @if(in_array("在庫管理区分", $params['errorsList'][$i])) background-color: #FF0000; @endif" >{{ isset($data["在庫管理区分"]) ? $data["在庫管理区分"] : '' }}</td>
                <td style="text-align:left; @if(in_array("非課税区分", $params['errorsList'][$i])) background-color: #FF0000; @endif" >{{ isset($data["非課税区分"]) ? $data["非課税区分"] : '' }}</td>
                <td style="text-align:left; @if(in_array("税率区分", $params['errorsList'][$i])) background-color: #FF0000; @endif" >{{ isset($data["税率区分"]) ? $data["税率区分"] : '' }}</td>
                <td style="text-align:left; @if(in_array("税抜上代単価", $params['errorsList'][$i])) background-color: #FF0000; @endif" >{{ isset($data["税抜上代単価"]) ? $data["税抜上代単価"] : '' }}</td>
                <td style="text-align:left; @if(in_array("税込上代単価", $params['errorsList'][$i])) background-color: #FF0000; @endif" >{{ isset($data["税込上代単価"]) ? $data["税込上代単価"] : '' }}</td>
                <td style="text-align:left; @if(in_array("税抜参考上代単価", $params['errorsList'][$i])) background-color: #FF0000; @endif" >{{ isset($data["税抜参考上代単価"]) ? $data["税抜参考上代単価"] : '' }}</td>
                <td style="text-align:left; @if(in_array("税込参考上代単価", $params['errorsList'][$i])) background-color: #FF0000; @endif" >{{ isset($data["税込参考上代単価"]) ? $data["税込参考上代単価"] : '' }}</td>
                <td style="text-align:left; @if(in_array("税抜仕入単価", $params['errorsList'][$i])) background-color: #FF0000; @endif" >{{ isset($data["税抜仕入単価"]) ? $data["税抜仕入単価"] : '' }}</td>
                <td style="text-align:left; @if(in_array("税込仕入単価", $params['errorsList'][$i])) background-color: #FF0000; @endif" >{{ isset($data["税込仕入単価"]) ? $data["税込仕入単価"] : '' }}</td>
                <td style="text-align:left; @if(in_array("原価単価", $params['errorsList'][$i])) background-color: #FF0000; @endif" >{{ isset($data["原価単価"]) ? $data["原価単価"] : '' }}</td>
                <td style="text-align:left; @if(in_array("粗利算出用原価単価", $params['errorsList'][$i])) background-color: #FF0000; @endif" >{{ isset($data["粗利算出用原価単価"]) ? $data["粗利算出用原価単価"] : '' }}</td>
                <td style="text-align:left; @if(in_array("名称入力区分", $params['errorsList'][$i])) background-color: #FF0000; @endif" >{{ isset($data["名称入力区分"]) ? $data["名称入力区分"] : '' }}</td>
                <td style="text-align:left; @if(in_array("削除区分", $params['errorsList'][$i])) background-color: #FF0000; @endif" >{{ isset($data["削除区分"]) ? $data["削除区分"] : '' }}</td>
                <td style="text-align:left; @if(in_array("メンバーサイト連携区分", $params['errorsList'][$i])) background-color: #FF0000; @endif" >{{ isset($data["メンバーサイト連携区分"]) ? $data["メンバーサイト連携区分"] : '' }}</td>
                <td style="text-align:left; @if(in_array("メンバーサイト商品コード", $params['errorsList'][$i])) background-color: #FF0000; @endif" >{{ isset($data["メンバーサイト商品コード"]) ? $data["メンバーサイト商品コード"] : '' }}</td>
                <td style="text-align:left; @if(in_array("メンバーサイト商品名", $params['errorsList'][$i])) background-color: #FF0000; @endif" >{{ isset($data["メンバーサイト商品名"]) ? $data["メンバーサイト商品名"] : '' }}</td>
                <td style="text-align:left; @if(in_array("商品備考1", $params['errorsList'][$i])) background-color: #FF0000; @endif" >{{ isset($data["商品備考1"]) ? $data["商品備考1"] : '' }}</td>
                <td style="text-align:left; @if(in_array("商品備考2", $params['errorsList'][$i])) background-color: #FF0000; @endif" >{{ isset($data["商品備考2"]) ? $data["商品備考2"] : '' }}</td>
                <td style="text-align:left; @if(in_array("商品備考3", $params['errorsList'][$i])) background-color: #FF0000; @endif" >{{ isset($data["商品備考3"]) ? $data["商品備考3"] : '' }}</td>
                <td style="text-align:left; @if(in_array("商品備考4", $params['errorsList'][$i])) background-color: #FF0000; @endif" >{{ isset($data["商品備考4"]) ? $data["商品備考4"] : '' }}</td>
                <td style="text-align:left; @if(in_array("商品備考5", $params['errorsList'][$i])) background-color: #FF0000; @endif" >{{ isset($data["商品備考5"]) ? $data["商品備考5"] : '' }}</td>
				<td style="text-align:left;"> >{{ isset($data["エラー内容"]) ? $data["エラー内容"] : '' }}</td>
				@php $i++; @endphp
			</tr>
        @endforeach
    </tbody>
</table>
@endsection
