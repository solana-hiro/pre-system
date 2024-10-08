@extends('layouts.admin.app')
@section('page_title', '運送会社リスト')
@section('title', '運送会社リスト')
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
    <form role="search" action="{{ route('master.other.mt_shipping_company.export') }}" method="post">
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
                <div class="text_wrapper label">運送会社コード範囲</div>
                <div class="frame">
                    <div class="textbox">
                        <input type="number" name="code_start" id="input_code_start" class="element input_number_4"
                            data-limit-len="4" data-limit-minus value="{{ old('code_start', '') }}" />
                        <img class="vector" id="img_code_start" src="/img/icon/vector.svg"
                            data-smm-open="search_shipping_company_modal" />
                    </div>
                    <div class="text_wrapper">～</div>
                    <div class="textbox">
                        <input type="number" name="code_end" id="input_code_end" class="element input_number_4"
                            data-limit-len="4" data-limit-minus value="{{ old('code_end', '') }}" />
                        <img class="vector" id="img_code_end" src="/img/icon/vector.svg"
                            data-smm-open="search_shipping_company_modal" />
                    </div>
                </div>
            </div>
        </div>
        <input type="hidden" id="hidden_code_start" value="" name="hidden_code_start" />
        <input type="hidden" id="hidden_code_end" value="" name="hidden_code_end" />
        @include('components.menu.selected', ['view' => 'main'])
    </form>
    @include('admin.master.search.shipping_company', ['shippingCompanyData' => $shippingCompanyData])
    <script>
        const inputBox = document.getElementById("input_code_start");
        const outputBox = document.getElementById("input_code_end");
        inputBox.onblur = function() {
            if ("" !== inputBox.value) {
                inputBox.value = inputBox.value.toString().padStart(4, '0');
            }
        };
        outputBox.onblur = function() {
            if ("" !== outputBox.value) {
                outputBox.value = outputBox.value.toString().padStart(4, '0');
            }
        };
    </script>
@endsection
