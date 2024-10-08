@extends('layouts.admin.app')
@section('page_title', '得意先リスト（一覧）')
@section('title', '得意先リスト（一覧）')
@section('keywords', $commonParams['pageInfo']['keywords'])
@section('canonical', $commonParams['pageInfo']['canonical'])
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
    <div class="main-area">
        <form role="search" action="{{ route('master.customer.mt_customer.export') }}" method="post" target="win">
            @csrf
            <div class="button_area">
                <div class="div">
                    <button class="button" type="submit" name="cancel" onclick="this.form.target='_self'">
                        <div class="text_wrapper">キャンセル</div>
                    </button>
                    <button class="div-wrapper" type="submit" name="preview" id="preview"
                        onclick="this.form.target='_blank'">
                        <div class="text_wrapper_2">プレビューを見る</div>
                    </button>
                    <button class="div-wrapper" type="submit" name="excel" id="download" onclick="this.form.target='_self'">
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
            <div class="element-form">
                <div class="text_wrapper">得意先コード範囲</div>
                <div class="frame">
                    <div class="textbox">
                        <input type="number" name="code_start" id="input_customer_start" class="element input_number_6"
                            data-limit-len="6" data-limit-minus value="{{ old('code_start', '') }}" />
                        <img class="vector" id="img_customer_start" src="{{ asset('/img/icon/vector.svg') }}"
                            data-smm-open="search_customer_modal" />
                    </div>
                    <div class="text_wrapper">～</div>
                    <div class="textbox">
                        <input type="number" name="code_end" class="element input_number_6" id="input_customer_end"
                            data-limit-len="6" data-limit-minus value="{{ old('code_end', '') }}" />
                        <img class="vector" id="img_customer_end" src="{{ asset('/img/icon/vector.svg') }}"
                            data-smm-open="search_customer_modal" />
                    </div>
                    <input type="hidden" id="hidden_customer_start" value="" name="hidden_customer_start" />
                    <input type="hidden" id="hidden_customer_end" value="" name="hidden_customer_end" />
                </div>
            </div>
            @include('components.menu.selected', ['view' => 'main'])
        </form>
    </div>
    @include('admin.master.search.customer', ['customerData' => $customerData])
    <script>
        const inputBox = document.getElementById("input_customer_start");
        const outputBox = document.getElementById("input_customer_end");
        inputBox.onblur = function() {
            if ("" !== inputBox.value) {
                inputBox.value = inputBox.value.toString().padStart(6, '0');
            }
            if ("" === outputBox.value) {
                outputBox.value = inputBox.value;
            }
        };
        outputBox.onblur = function() {
            if ("" !== outputBox.value) {
                outputBox.value = outputBox.value.toString().padStart(6, '0');
            }
        };
    </script>
@endsection
