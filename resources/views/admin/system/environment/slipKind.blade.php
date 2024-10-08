@extends('layouts.admin.app')
@section('page_title', '伝票種別マスタ')
@section('title', '伝票種別マスタ')
@section('description', '')
@section('keywords', '')
@section('canonical', '')

@section('content')
    <form role="search" action="" method="">
        @csrf
        <div class="main-area">
            <div class="button_area">
                <div class="div">
                </div>
            </div>
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @elseif (Session::has('sessionErrors'))
                <div class="alert alert-danger">
                    <ul>
                        @foreach (session('sessionErrors') as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @elseif (Session::has('flashmessage'))
                @include('components.modal.message', ['flashmessage' => session('flashmessage')])
            @elseif (Session::has('errormessage'))
                @include('components.modal.error', ['errormessage' => session('errormessage')])
            @endif
            <div class="alert alert-danger">
                <ul id="alert-danger-ul">
            </div>

            <div class="element-form-rows">
                <div class="element-form-columns td_200px left">
                    <div class="element-form-columns">
                        <p>伝票種別区分</p>
                        <p>01: 受注</p>
                        <p>02: 売上</p>
                        <p>03: 入金</p>
                        <p>04: 発注</p>
                        <p>05: 仕入</p>
                        <p>06: 支払</p>
                        <p>07: 送り状</p>
                        <p>08: 入出庫</p>
                        <p>09: 請求書</p>
                        <p>14: 見積</p>
                        <p>17: 荷札</p>
                    </div>
                </div>
                <div class="grid">
                    <table>
                        <thead class="grid_header">
                            <tr>
                                <td class="grid_wrapper_center td_10p">伝票種別区分</td>
                                <td class="grid_wrapper_center td_20p">伝票種別</td>
                                <td class="grid_wrapper_center td_35p">伝票種別名</td>
                                <td class="grid_wrapper_center td_20p">伝票行数</td>
                                <td class="grid_wrapper_center td_10p">用紙幅(0.01インチ)</td>
                                <td class="grid_wrapper_center td_10p">用紙高さ(0.01インチ)</td>
                                <td class="grid_wrapper_center td_10p">出力区分</td>
                            </tr>
                        </thead>
                        <tbody class="grid_body">
                            @if (isset($initData) && count($initData) > 0)
                                @foreach ($initData as $data)
                                    <tr>
                                        <td class="grid_col_2 col_rec">{{ $data['slip_kind_kbn_cd'] }}</td>
                                        <td class="grid_col_2 col_rec">{{ $data['slip_kind_cd'] }}</td>
                                        <td class="grid_col_2 col_rec">{{ $data['slip_kind_name'] }}</td>
                                        <td class="grid_col_2 col_rec">{{ $data['slip_row'] }}</td>
                                        <td class="grid_col_2 col_rec">{{ $data['paper_width'] }}</td>
                                        <td class="grid_col_2 col_rec">{{ $data['paper_height'] }}</td>
                                        <td class="grid_col_2 col_rec">{{ $data['output_kbn'] }}</td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                    <span>※合計請求書の場合、伝票行数に0を指定してください。</span>
                </div>
            </div>
        </div>
        <!--
            <button type="submit" id="redirectToSlipKindMst" name="redirectFromSearch" class="display_none_all" value=""></button>
            -->
    </form>
    @include('admin.master.search.slip_kind', ['slipKindKbnCd' => '04'])
@endsection
