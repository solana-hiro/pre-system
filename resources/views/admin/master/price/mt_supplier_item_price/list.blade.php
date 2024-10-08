@extends('layouts.admin.app')
@section('page_title', '仕入先商品単価一覧 リスト')
@section('title', '仕入先商品単価一覧 リスト')
@section('description', '')
@section('keywords', '')
@section('canonical', '')
@section('blade_script')
    <script type="module" src="{{ asset('js/master/price/mt_supplier_item_price/list.js') }}"></script>
    <script>
        const laravelResponse = [
            @json(session('_old_input')),
            @json($errors->all()),
            @json(session('sessionErrors'))
        ]; // ListErrorAlert専用
    </script>
@endsection

@section('content')
    <form role="search" action="{{ route('master.price.mt_supplier_item_price.export') }}" method="post">
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
                <div class="text_wrapper label">仕入先コード範囲</div>
                <div class="frame">
                    <div class="textbox">
                        <input type="number" name="supplier_code_start" class="element w-24"
                            value="{{ old('supplier_code_start', '') }}" data-limit-len="6" data-limit-minus
                            data-pad-code="6" />
                        <img class="vector" src="/img/icon/vector.svg" data-smm-open="search_supplier_modal">
                    </div>
                    <div class="text_wrapper">～</div>
                    <div class="textbox">
                        <input type="number" name="supplier_code_end" class="element w-24"
                            value="{{ old('supplier_code_end', '') }}" data-limit-len="6" data-limit-minus
                            data-pad-code="6" />
                        <img class="vector" src="/img/icon/vector.svg" data-smm-open="search_supplier_modal">
                    </div>
                </div>
                <input type="hidden" name="hidden_supplier_code_start" id="hidden_supplier_code_start">
                <input type="hidden" name="hidden_supplier_code_end" id="hidden_supplier_code_end">
            </div><br>
            <div class="element-form element-form-rows">
                <div class="text_wrapper label">商品コード範囲</div>
                <div class="frame">
                    <div class="textbox">
                        <input type="text" name="item_code_start" class="element w-24" id="input_item_code_start"
                            minlength="0" maxlength="9" value="{{ old('item_code_start') }}" />
                        <img class="vector" src="/img/icon/vector.svg" data-smm-open="search_item_cd_modal" />
                    </div>
                    <div class="text_wrapper">～</div>
                    <div class="textbox">
                        <input type="text" name="item_code_end" class="element w-24" id="input_item_code_end"
                            minlength="0" maxlength="9" value="{{ old('item_code_end') }}" />
                        <img class="vector" src="/img/icon/vector.svg" data-smm-open="search_item_cd_modal" />
                    </div>
                </div>
            </div>
        </div>
        <input type="hidden" id="hidden_supplier_code_start" value="" name="hidden_supplier_code_start" />
        <input type="hidden" id="hidden_supplier_code_end" value="" name="hidden_supplier_code_end" />
        <input type="hidden" id="hidden_item_cd_start" value="" name="hidden_item_cd_start" />
        <input type="hidden" id="hidden_item_cd_end" value="" name="hidden_item_cd_end" />
        @include('components.menu.selected', ['view' => 'main'])
    </form>
    @include('admin.master.search.supplier')
    @include('admin.master.search.item_cd')
@endsection
