@extends('layouts.admin.app')
@section('page_title', '納品先リスト（一覧）')
@section('title', '納品先リスト（一覧）')
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
    <form role="search" action="{{ route('master.delivery.mt_delivery_destinations.export') }}" method="post">
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
            <div class="element-form">
                <div class="text_wrapper">納品先コード範囲</div>
                <div class="frame">
                    <div class="textbox">
                        <input type="number" name="code_start" id="input_code_start" class="element input_number_6"
                            data-limit-len="6" data-limit-minus value="{{ old('code_start', '') }}" />
                        <img class="vector" id="img_code_start" src="/img/icon/vector.svg"
                            data-smm-open="search_delivery_destination_modal" />
                    </div>
                    <div class="text_wrapper">～</div>
                    <div class="textbox">
                        <input type="text" name="code_end" id="input_code_end" class="element" minlength="0"
                            maxlength="6" size="6" value="{{ old('code_end', '') }}" />
                        <img class="vector" id="img_code_end" src="/img/icon/vector.svg"
                            data-smm-open="search_delivery_destination_modal" />
                    </div>
                    <input type="hidden" id="hidden_code_start" value="" name="hidden_code_start" />
                    <input type="hidden" id="hidden_code_end" value="" name="hidden_code_end" />
                </div>
            </div>
        </div>
        @include('components.menu.selected', ['view' => 'main'])
    </form>
    @include('admin.master.search.delivery_destination')
    <script>
        const inputBox = document.getElementById("input_code_start");
        const outputBox = document.getElementById("input_code_end");
        inputBox.onblur = function() {
            if ("" !== inputBox) {
                inputBox.value = inputBox.value.toString().padStart(6, '0');
            }
        };
        outputBox.onblur = function() {
            if ("" !== outputBox) {
                outputBox.value = outputBox.value.toString().padStart(6, '0');
            }
        };
    </script>
@endsection
