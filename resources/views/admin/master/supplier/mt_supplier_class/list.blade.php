@extends('layouts.admin.app')
@section('page_title', '仕入先分類リスト（一覧）')
@section('title', '仕入先分類リスト（一覧）')
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
    <form role="search" action="{{ route('master.supplier.mt_supplier_class.list.export') }}" method="post"
        name="mtSupplierClassListForm">
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
            <div class="alert alert-danger">
                <ul id="alert-danger-ul">
            </div>
            <div class="box">
                <div class="group">
                    <div class="element">
                        <div class="text_wrapper">対象仕入先分類</div>
                        <div class="frame">
                            <div class="div">
                                <label class="text_wrapper_2">
                                    <input type="radio" id="supplier_class_thing_id_1" name="supplier_class_thing_id"
                                        value="1" onclick="supplierClassIdListClick()"
                                        @if (old('supplier_class_thing_id') === '1' || null === old('supplier_class_thing_id')) checked @endif />
                                    仕入先分類1
                                </label>
                            </div>
                            <div class="div">
                                <label class="text_wrapper_2">
                                    <input type="radio" id="supplier_class_thing_id_2" name="supplier_class_thing_id"
                                        value="2" onclick="supplierClassIdListClick()"
                                        @if (old('supplier_class_thing_id') === '2') checked @endif />
                                    仕入先分類2
                                </label>
                            </div>
                            <div class="div">
                                <label class="text_wrapper_2">
                                    <input type="radio" id="supplier_class_thing_id_3" name="supplier_class_thing_id"
                                        value="3" onclick="supplierClassIdListClick()"
                                        @if (old('supplier_class_thing_id') === '3') checked @endif />
                                    仕入先分類3
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @if (old('supplier_class_thing_id') === '2' || old('supplier_class_thing_id') === '3')
                <div class="element-form" id="supplier_class_thing_1" style="display:none;">
                @else
                    <div class="element-form" id="supplier_class_thing_1">
            @endif
            <div class="text_wrapper">仕入先分類1コード範囲</div>
            <div class="frame">
                <div class="textbox">
                    <input type="text" name="code1_start" id="input_code1_start" class="element" minlength="0"
                        maxlength="6" size="6" value="{{ old('code1_start', '') }}" />
                    <img class="vector" id="img_code1_start" src="{{ asset('/img/icon/vector.svg') }}"
                        data-smm-open="search_supplier_class1_modal" />
                </div>
                <div class="text_wrapper">～</div>
                <div class="textbox">
                    <input type="text" name="code1_end" id="input_code1_end" class="element" minlength="0"
                        maxlength="6" size="6" value="{{ old('code1_end', '') }}" />
                    <img class="vector" id="img_code1_end" src="{{ asset('/img/icon/vector.svg') }}"
                        data-smm-open="search_supplier_class1_modal" />
                </div>
            </div>
        </div>
        @if (old('supplier_class_thing_id') === '2')
            <div class="element-form" id="supplier_class_thing_2">
            @else
                <div class="element-form" id="supplier_class_thing_2" style="display:none;">
        @endif
        <div class="text_wrapper">仕入先分類2コード範囲</div>
        <div class="frame">
            <div class="textbox">
                <input type="text" name="code2_start" id="input_code2_start" class="element" minlength="0"
                    maxlength="6" size="6" value="{{ old('code2_start', '') }}" />
                <img class="vector" id="img_code2_start" src="{{ asset('/img/icon/vector.svg') }}"
                    data-smm-open="search_supplier_class2_modal" />
            </div>
            <div class="text_wrapper">～</div>
            <div class="textbox">
                <input type="text" name="code2_end" id="input_code2_end" class="element" minlength="0"
                    maxlength="6" size="6" value="{{ old('code2_end', '') }}" />
                <img class="vector" id="img_code2_end" src="{{ asset('/img/icon/vector.svg') }}"
                    data-smm-open="search_supplier_class2_modal" />
            </div>
        </div>
        </div>
        @if (old('supplier_class_thing_id') === '3')
            <div class="element-form" id="supplier_class_thing_3">
            @else
                <div class="element-form" id="supplier_class_thing_3" style="display:none;">
        @endif
        <div class="text_wrapper">仕入先分類3コード範囲</div>
        <div class="frame">
            <div class="textbox">
                <input type="text" name="code3_start" id="input_code3_start" class="element" minlength="0"
                    maxlength="6" size="6" value="{{ old('code3_start', '') }}" />
                <img class="vector" id="img_code3_start" src="{{ asset('/img/icon/vector.svg') }}"
                    data-smm-open="search_supplier_class3_modal" />
            </div>
            <div class="text_wrapper">～</div>
            <div class="textbox">
                <input type="text" name="code3_end" id="input_code3_end" class="element" minlength="0"
                    maxlength="6" size="6" value="{{ old('code3_end', '') }}" />
                <img class="vector" id="img_code3_end" src="{{ asset('/img/icon/vector.svg') }}"
                    data-smm-open="search_supplier_class3_modal" />
            </div>
        </div>
        </div>
        </div>
        <input type="hidden" id="hidden_code1_start" value="" name="hidden_code1_start" />
        <input type="hidden" id="hidden_code1_end" value="" name="hidden_code1_end" />
        <input type="hidden" id="hidden_code2_start" value="" name="hidden_code2_start" />
        <input type="hidden" id="hidden_code2_end" value="" name="hidden_code2_end" />
        <input type="hidden" id="hidden_code3_start" value="" name="hidden_code3_start" />
        <input type="hidden" id="hidden_code3_end" value="" name="hidden_code3_end" />
        @include('components.menu.selected', ['view' => 'main'])
    </form>
    @include('admin.master.search.supplier_class1', ['supplierClass1Data' => $supplierClass1Data])
    @include('admin.master.search.supplier_class2', ['supplierClass2Data' => $supplierClass2Data])
    @include('admin.master.search.supplier_class3', ['supplierClass3Data' => $supplierClass3Data])
    <!-- <script>
        const inputBox1 = document.getElementById("input_code1_start");
        const outputBox1 = document.getElementById("input_code1_end");
        const inputBox2 = document.getElementById("input_code2_start");
        const outputBox2 = document.getElementById("input_code2_end");
        const inputBox3 = document.getElementById("input_code3_start");
        const outputBox3 = document.getElementById("input_code3_end");
        inputBox1.onblur = function() {
            if ("" !== inputBox1.value) {
                inputBox1.value = inputBox1.value.toString().padStart(6, '0');
            }
        };
        outputBox1.onblur = function() {
            if ("" !== outputBox1.value) {
                outputBox1.value = outputBox1.value.toString().padStart(6, '0');
            }
        };
        inputBox2.onblur = function() {
            if ("" !== inputBox2.value) {
                inputBox2.value = inputBox2.value.toString().padStart(6, '0');
            }
        };
        outputBox2.onblur = function() {
            if ("" !== outputBox2.value) {
                outputBox2.value = outputBox2.value.toString().padStart(6, '0');
            }
        };
        inputBox3.onblur = function() {
            if ("" !== inputBox3.value) {
                inputBox3.value = inputBox3.value.toString().padStart(6, '0');
            }
        };
        outputBox3.onblur = function() {
            if ("" !== outputBox3.value) {
                outputBox3.value = outputBox3.value.toString().padStart(6, '0');
            }
        };
    </script> -->
@endsection
