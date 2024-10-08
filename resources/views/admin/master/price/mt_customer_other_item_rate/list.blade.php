@extends('layouts.admin.app')
@section('page_title', '得意先別商品掛率マスタ リスト')
@section('title', '得意先別商品掛率マスタ リスト')
@section('description', '')
@section('keywords', '')
@section('canonical', '')
@section('blade_script')
    <script>
        const laravelResponse = [
            @json(session('_old_input')),
            @json($errors->all()),
            @json(session('sessionErrors'))
        ]; // ListErrorAlert専用
    </script>
@endsection

@section('content')
    <form role="search" action="{{ route('master.price.mt_customer_other_item_rate.export') }}" method="post">
        @csrf
        <div class="main-area">
            <div class="button_area">
                <div class="div">
                    <button class="button" type="submit" name="cancel" onclick="this.form.target='_self'">
                        <div class="text_wrapper">キャンセル</div>
                    </button>
                    <button class="div-wrapper" type="submit" name="preview" onclick="this.form.target='_blank'">
                        <div class="text_wrapper_2">プレビューを見る</div>
                    </button>
                    <button class="div-wrapper" type="submit" name="excel" onclick="this.form.target='_self'">
                        <div class="text_wrapper_2">Excelへ出力</div>
                    </button>
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
            @endif
            <div class="element-form element-form-rows">
                <div class="text_wrapper">PS区分：</div>
                <div class="frame">
                    <div class="div">
                        <label class="text_wrapper_2">
                            <input type="radio" id="" name="ps_kbn" value="0" checked />
                            プロパー
                        </label>
                    </div>
                </div>
            </div><br>
            <div class="element-form element-form-rows">
                <div class="text_wrapper label">得意先コード範囲</div>
                <div class="frame">
                    <div class="textbox">
                        <input type="number" name="customer_code_start" class="element w-24" data-limit-len="6"
                            data-limit-minus data-pad-code="6" value="{{ old('customer_code_start') }}" />
                        <img class="vector" id="img_customer_code_start" src="/img/icon/vector.svg"
                            data-smm-open="search_customer_modal" />
                    </div>
                    <div class="text_wrapper">～</div>
                    <div class="textbox">
                        <input type="text" name="customer_code_end" class="element w-24" data-limit-len="6"
                            data-limit-minus data-pad-code="6" value="{{ old('customer_code_end') }}" />
                        <img class="vector" id="img_customer_code_end" src="/img/icon/vector.svg"
                            data-smm-open="search_customer_modal" />
                    </div>
                </div>
            </div><br>
            <div class="element-form element-form-rows">
                <div class="text_wrapper label">商品コード範囲</div>
                <div class="frame">
                    <div class="textbox">
                        <input type="text" name="item_code_start" id="input_item_cd_start" class="element" minlength="0"
                            maxlength="9" size="9" value="{{ old('item_code_start') }}" />
                        <img class="vector" id="img_item_cd_start" src="/img/icon/vector.svg"
                            data-smm-open="search_item_cd_modal" />
                    </div>
                    <div class="text_wrapper">～</div>
                    <div class="textbox">
                        <input type="text" name="item_code_end" id="input_item_cd_end" class="element" minlength="0"
                            maxlength="9" size="9" value="{{ old('item_code_end') }}" />
                        <img class="vector" id="img_item_cd_end" src="/img/icon/vector.svg"
                            data-smm-open="search_item_cd_modal" />
                    </div>
                </div>
            </div>
            <input type="hidden" id="hidden_customer_code_start" value="" name="hidden_customer_code_start" />
            <input type="hidden" id="hidden_customer_code_end" value="" name="hidden_customer_code_end" />
            <input type="hidden" id="hidden_item_cd_start" value="" name="hidden_item_cd_start" />
            <input type="hidden" id="hidden_item_cd_end" value="" name="hidden_item_cd_end" />
        </div>
        @include('components.menu.selected', ['view' => 'main'])
    </form>
    @include('admin.master.search.customer', ['customerData' => $customerData])
    @include('admin.master.search.brand1', ['brand1Data' => $brand1Data])
    @include('admin.master.search.game_category', ['itemClassThing2Data' => $itemClassThing2Data])
    @include('admin.master.search.genre', ['genreData' => $genreData])
    @include('admin.master.search.item_cd', ['itemData' => $itemData])
    @include('admin.master.search.item_class_thing4', ['itemClassThing4Data' => $itemClassThing4Data])
    @include('admin.master.search.item_class_thing5', ['itemClassThing5Data' => $itemClassThing5Data])
    @include('admin.master.search.item_class_thing6', ['itemClassThing6Data' => $itemClassThing6Data])
    @include('admin.master.search.item_class_thing7', ['itemClassThing7Data' => $itemClassThing7Data])
    @include('admin.master.search.item_cd', ['itemData' => $itemData])
@endsection
