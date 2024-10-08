@extends('layouts.admin.app')
@section('page_title', '売価情報マスタ リスト')
@section('title', '売価情報マスタ リスト(画面のみ)')
@section('description', '')
@section('keywords', '')
@section('canonical', '')

@section('content')
    <form role="search" action="{{ route('master.price.selling_price.export') }}" method="post">
        @csrf
        <div class="main-area">
            <div class="button_area">
                <div class="div">
                    <button class="div-wrapper" type="submit" name="excel">
                        <div class="text_wrapper_2">Excelへ出力</div>
                    </button>
                </div>
            </div>

            <div class="element-form element-form-rows">
                <div class="text_wrapper label">&emsp;得意先コード範囲</div>
                <div class="frame">
                    <div class="textbox">
                        <input type="text" name="name" class="element" minlength="0" maxlength="6" size="10" />
                        <img class="vector" src="/img/icon/vector.svg" />
                    </div>
                    <div class="text_wrapper">～</div>
                    <div class="textbox">
                        <input type="text" name="name" class="element" minlength="0" maxlength="6" size="10" />
                        <img class="vector" src="/img/icon/vector.svg" />
                    </div>
                </div>
            </div><br>
            <div class="element-form element-form-rows">
                <div class="text_wrapper label">&emsp;&emsp;商品コード範囲</div>
                <div class="frame">
                    <div class="textbox">
                        <input type="text" name="name" class="element" minlength="0" maxlength="6" size="10" />
                        <img class="vector" src="/img/icon/vector.svg" />
                    </div>
                    <div class="text_wrapper">～</div>
                    <div class="textbox">
                        <input type="text" name="name" class="element" minlength="0" maxlength="6" size="10" />
                        <img class="vector" src="/img/icon/vector.svg" />
                    </div>
                </div>
            </div><br>
            <div class="element-form element-form-rows">
                <div class="text_wrapper label">バーゲン開始日範囲</div>
                <div class="frame">
                    <div class="textbox">
                        <input type="text" name="name" class="element textbox_40px" minlength="0" maxlength="4"
                            value="" />年
                        <input type="text" name="name" class="element textbox_24px" minlength="0" maxlength="2"
                            value="" />月
                        <input type="text" name="name" class="element textbox_24px" minlength="0" maxlength="2"
                            value="" />日
                        <img src="/img/icon/calender.svg">
                    </div>
                    <div class="text_wrapper">～</div>
                    <div class="textbox">
                        <input type="text" name="name" class="element textbox_40px" minlength="0" maxlength="4"
                            value="" />年
                        <input type="text" name="name" class="element textbox_24px" minlength="0" maxlength="2"
                            value="" />月
                        <input type="text" name="name" class="element textbox_24px" minlength="0" maxlength="2"
                            value="" />日
                        <img src="/img/icon/calender.svg">
                    </div>
                </div>
            </div><br>
            <div class="element-form element-form-rows">
                <div class="text_wrapper label">&emsp;&emsp;新売価適用範囲</div>
                <div class="frame">
                    <div class="textbox">
                        <input type="text" name="name" class="element textbox_40px" minlength="0" maxlength="4"
                            value="" />年
                        <input type="text" name="name" class="element textbox_24px" minlength="0" maxlength="2"
                            value="" />月
                        <input type="text" name="name" class="element textbox_24px" minlength="0" maxlength="2"
                            value="" />日
                        <img src="/img/icon/calender.svg">
                    </div>
                    <div class="text_wrapper">～</div>
                    <div class="textbox">
                        <input type="text" name="name" class="element textbox_40px" minlength="0" maxlength="4"
                            value="" />年
                        <input type="text" name="name" class="element textbox_24px" minlength="0" maxlength="2"
                            value="" />月
                        <input type="text" name="name" class="element textbox_24px" minlength="0" maxlength="2"
                            value="" />日
                        <img src="/img/icon/calender.svg">
                    </div>
                </div>
            </div>
        </div>
        @include('components.menu.selected', ['view' => 'main'])
    </form>
@endsection
