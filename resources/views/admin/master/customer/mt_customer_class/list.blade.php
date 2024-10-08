@extends('layouts.admin.app')
@section('page_title', '得意先分類リスト(一覧)')
@section('title', '得意先分類リスト(一覧) ')
@section('description', $commonParams['pageInfo']['description'])
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
        <form role="search" action="{{ route('master.customer.mt_customer_class.list.export') }}" method="post"
            name="mtCustomerClassListForm">
            @csrf
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
            <div class="box">
                <div class="group">
                    <div class="element">
                        <div class="text_wrapper">対象得意先分類</div>
                        <div class="frame">
                            <div class="div">
                                <label class="text_wrapper_2">
                                    <input type="radio" id="customer_class_thing_id_1" name="customer_class_thing_id"
                                        value="1" onclick="customerClassIdListClick()"
                                        @if (old('customer_class_thing_id') === '1' || null === old('customer_class_thing_id')) checked @endif />
                                    販売パターン1
                                </label>
                            </div>
                            <div class="div">
                                <label class="text_wrapper_2">
                                    <input type="radio" id="customer_class_thing_id_2" name="customer_class_thing_id"
                                        value="2" onclick="customerClassIdListClick()"
                                        @if (old('customer_class_thing_id') === '2') checked @endif />
                                    業種・特徴2
                                </label>
                            </div>
                            <div class="div">
                                <label class="text_wrapper_2">
                                    <input type="radio" id="customer_class_thing_id_3" name="customer_class_thing_id"
                                        value="3" onclick="customerClassIdListClick()"
                                        @if (old('customer_class_thing_id') === '3') checked @endif />
                                    ランク3
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @if (old('customer_class_thing_id') === '2' || old('customer_class_thing_id') === '3')
                <div class="element-form" id="customer_class_thing_1" style="display: none;">
                @else
                    <div class="element-form" id="customer_class_thing_1">
            @endif
            <div class="text_wrapper">販売パターン1範囲</div>
            <div class="frame">
                <div class="textbox">
                    <input type="text" id="input_code1_start" name="code1_start" class="element" minlength="0"
                        maxlength="6" size="6" value="{{ old('code1_start', '') }}" />
                    <img class="vector" id="img_code1_start" src="{{ asset('/img/icon/vector.svg') }}"
                        data-smm-open="search_customer_class_thing1_modal" />
                </div>
                <div class="text_wrapper">～</div>
                <div class="textbox">
                    <input type="text" id="input_code1_end" name="code1_end" class="element" minlength="0"
                        maxlength="6" size="6" value="{{ old('code1_end', '') }}" />
                    <img class="vector" id="img_code1_end" src="{{ asset('/img/icon/vector.svg') }}"
                        data-smm-open="search_customer_class_thing1_modal" />
                </div>
            </div>
    </div>
    @if (old('customer_class_thing_id') === '2')
        <div class="element-form" id="customer_class_thing_2">
        @else
            <div class="element-form" id="customer_class_thing_2" style="display:none;">
    @endif
    <div class="text_wrapper">業種・特徴2範囲</div>
    <div class="frame">
        <div class="textbox">
            <input type="text" id="input_code2_start" name="code2_start" class="element" minlength="0" maxlength="6"
                size="6" value="{{ old('code2_start', '') }}" />
            <img class="vector" id="img_code2_start" src="{{ asset('/img/icon/vector.svg') }}"
                data-smm-open="search_customer_class_thing2_modal" />
        </div>
        <div class="text_wrapper">～</div>
        <div class="textbox">
            <input type="text" id="input_code2_end" name="code2_end" class="element" minlength="0" maxlength="6"
                size="6" value="{{ old('code2_end', '') }}" />
            <img class="vector" id="img_code2_end" src="{{ asset('/img/icon/vector.svg') }}"
                data-smm-open="search_customer_class_thing2_modal" />
        </div>
    </div>
    </div>
    @if (old('customer_class_thing_id') === '3')
        <div class="element-form" id="customer_class_thing_3">
        @else
            <div class="element-form" id="customer_class_thing_3" style="display:none;">
    @endif
    <div class="text_wrapper">ランク3範囲</div>
    <div class="frame">
        <div class="textbox">
            <input type="text" id="input_code3_start" name="code3_start" class="element" minlength="0"
                maxlength="6" size="6" value="{{ old('code3_start', '') }}" />
            <img class="vector" id="img_code3_start" src="{{ asset('/img/icon/vector.svg') }}"
                data-smm-open="search_rank3_modal" />
        </div>
        <div class="text_wrapper">～</div>
        <div class="textbox">
            <input type="text" id="input_code3_end" name="code3_end" class="element" minlength="0" maxlength="6"
                size="6" value="{{ old('code3_end', '') }}" />
            <img class="vector" id="img_code3_end" src="{{ asset('/img/icon/vector.svg') }}"
                data-smm-open="search_rank3_modal" />
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
    </div>
    @include('admin.master.search.customer_class_thing1', ['customerClass1Data' => $customerClass1Data])
    @include('admin.master.search.customer_class_thing2', ['customerClass2Data' => $customerClass2Data])
    @include('admin.master.search.rank3', ['rank3Data' => $rank3Data])

@endsection
