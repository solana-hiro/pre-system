@extends('layouts.admin.app')
@section('page_title', '売価情報マスタ')
@section('title', '売価情報マスタ(画面のみ)')
@section('description', '')
@section('keywords', '')
@section('canonical', '')

@section('content')
    <form role="search" action="{{ route('master.price.selling_price.update') }}" method="post">
        @csrf

        <div class="main-area">
            <div class="button_area">
                <div class="div">
                    <button class="button" type="submit" name="delete">
                        <div class="text_wrapper">削除する</div>
                    </button>
                    <button class="div-wrapper" type="submit" name="back">
                        <div class="text_wrapper_2">前頁</div>
                    </button>
                    <button class="div-wrapper" type="submit" name="next">
                        <div class="text_wrapper_2">次頁</div>
                    </button>
                    <button class="button-2" type="submit" name="update">
                        <div class="text_wrapper_3">登録する</div>
                    </button>
                </div>
            </div>
            <div class="box">
                <div class="group">
                    <div class="element">
                        <div class="frame">
                            <div class="text_wrapper">処理区分：</div>
                            <div class="div">
                                <label class="text_wrapper_2">
                                    <input type="radio" id="" name="kbn" value="" checked />
                                    新規
                                </label>
                            </div>
                            <div class="div">
                                <label class="text_wrapper_2">
                                    <input type="radio" id="" name="kbn" value="" />
                                    修正
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="box">
                <div class="element-form-rows">
                    <div class="element-form">
                        <div class="text_wrapper">得意先</div>
                        <div class="frame">
                            <div class="textbox !w-[96px]">
                                <input type="number" name="" class="element !w-full" data-limit-len="6"
                                    data-limit-minus />
                                <img class="vector !m-0" src="/img/icon/vector.svg" />
                            </div>
                            <div class="textbox">
                                <input type="text" name="" class="element !w-[256px]" readonly />
                            </div>
                            ～
                            <div class="textbox !w-[96px]">
                                <input type="number" name="" class="element !w-full" data-limit-len="6"
                                    data-limit-minus />
                                <img class="vector !m-0" src="/img/icon/vector.svg" />
                            </div>
                        </div>
                    </div>
                    <div class="element-form">
                        <div class="text_wrapper">商品コード範囲</div>
                        <div class="frame">
                            <div class="textbox !w-[120px]">
                                <input type="text" name="" class="element !w-full" maxlength="9" />
                                <img class="vector !m-0" src="/img/icon/vector.svg" />
                            </div>
                            ～
                            <div class="textbox !w-[120px]">
                                <input type="text" name="" class="element !w-full" maxlength="9" />
                                <img class="vector !m-0" src="/img/icon/vector.svg" />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="element-form-rows">
                    <div class="element-form element-form-columns">
                        <div class="text_wrapper">ブランド１</div>
                        <div class="frame">
                            <div class="textbox !w-[96px]">
                                <input type="text" name="" class="element !w-full" maxlength="6" />
                                <img class="vector !m-0" src="/img/icon/vector.svg" />
                            </div>
                            <div class="textbox">
                                <input type="text" name="" class="element !w-[128px]" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="element-form element-form-columns">
                        <div class="text_wrapper">競技・カテゴリ</div>
                        <div class="frame">
                            <div class="textbox !w-[96px]">
                                <input type="text" name="" class="element !w-full" maxlength="6" />
                                <img class="vector !m-0" src="/img/icon/vector.svg" />
                            </div>
                            <div class="textbox">
                                <input type="text" name="" class="element !w-[128px]" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="element-form element-form-columns">
                        <div class="text_wrapper">ジャンル</div>
                        <div class="frame">
                            <div class="textbox !w-[96px]">
                                <input type="text" name="" class="element !w-full" maxlength="6" />
                                <img class="vector !m-0" src="/img/icon/vector.svg" />
                            </div>
                            <div class="textbox">
                                <input type="text" name="" class="element !w-[128px]" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="element-form element-form-columns">
                        <div class="text_wrapper">販売開始年</div>
                        <div class="frame">
                            <div class="textbox !w-[96px]">
                                <input type="text" name="" class="element !w-full" maxlength="6" />
                                <img class="vector !m-0" src="/img/icon/vector.svg" />
                            </div>
                            <div class="textbox">
                                <input type="text" name="" class="element !w-[128px]" readonly>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="element-form-rows">
                    <div class="element-form element-form-columns">
                        <div class="text_wrapper">工場分類5コード</div>
                        <div class="frame">
                            <div class="textbox !w-[96px]">
                                <input type="text" name="" class="element !w-full" maxlength="6" />
                                <img class="vector !m-0" src="/img/icon/vector.svg" />
                            </div>
                            <div class="textbox">
                                <input type="text" name="" class="element !w-[128px]" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="element-form element-form-columns">
                        <div class="text_wrapper">製品/工賃6コード</div>
                        <div class="frame">
                            <div class="textbox !w-[96px]">
                                <input type="text" name="" class="element !w-full" maxlength="6" />
                                <img class="vector !m-0" src="/img/icon/vector.svg" />
                            </div>
                            <div class="textbox">
                                <input type="text" name="" class="element !w-[128px]" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="element-form element-form-columns">
                        <div class="text_wrapper">資産在庫JAコード</div>
                        <div class="frame">
                            <div class="textbox !w-[96px]">
                                <input type="text" name="" class="element !w-full" maxlength="6" />
                                <img class="vector !m-0" src="/img/icon/vector.svg" />
                            </div>
                            <div class="textbox">
                                <input type="text" name="" class="element !w-[128px]" readonly>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="box">
                <div class="sub_contents !gap-0 !max-w-none">
                    <div class="left_memo text-xs !w-[317px] me-4">
                        ※一括設定時、バーゲン売価、新売価が入力されている場合は、設定掛率が適用されません。<br />※一括設定日付が入っていない場合は、明細の日付入力時に設定掛率が適用されます。<br />※一括設定日が入っている場合は登録時に設定掛け率が適用されます。<br />※設定掛率は旧売価には適用されません。
                    </div>
                    <div class="">
                        <div class="grid_gray">
                            <table class="grid_gray_table_100p">
                                <thead class="grid_gray_header">
                                    <tr>
                                        <td class="grid_wrapper_center !w-[160px]">バーゲン開始日</td>
                                        <td class="grid_wrapper_center !w-[120px]">税抜バーゲン売価</td>
                                        <td class="grid_wrapper_center !w-[160px]" rowspan="2">新売価適用日</td>
                                        <td class="grid_wrapper_center !w-[120px]">税抜新売価</td>
                                        <td class="grid_wrapper_center !w-[120px]" rowspan="2">設定掛率</td>
                                    </tr>
                                    <tr>
                                        <td class="grid_wrapper_center !w-[160px]">バーゲン終了日</td>
                                        <td class="grid_wrapper_center !w-[120px]">税込バーゲン売価</td>
                                        <td class="grid_wrapper_center !w-[120px]">税込新売価</td>
                                    </tr>
                                </thead>
                                <tbody class="grid_body">
                                    <tr>
                                        <td class="grid_col_4 col_rec !text-base">
                                            @include('admin.master.price.date_form', [
                                                'initialDate' => null,
                                                'paramName' => '',
                                                'oldParamName' => '',
                                                'calendarIndex' => 0,
                                                'width' => [
                                                    'year' => '!w-[36px]',
                                                    'month' => '!w-[18px]',
                                                    'day' => '!w-[18px]',
                                                ],
                                                'readonly' => false,
                                            ])
                                        </td>
                                        <td class="grid_wrapper_right">
                                            <input type="text" class="grid_textbox text-right !w-full" maxlength="13">
                                        </td>
                                        <td rowspan="2" class="grid_col_4 col_rec !text-base">
                                            @include('admin.master.price.date_form', [
                                                'initialDate' => null,
                                                'paramName' => '',
                                                'oldParamName' => '',
                                                'calendarIndex' => 0,
                                                'width' => [
                                                    'year' => '!w-[36px]',
                                                    'month' => '!w-[18px]',
                                                    'day' => '!w-[18px]',
                                                ],
                                                'readonly' => false,
                                            ])
                                        </td>
                                        <td class="grid_wrapper_right">
                                            <input type="text" class="grid_textbox text-right !w-full" maxlength="13">
                                        </td>
                                        <td class="grid_wrapper_left" rowspan="2">
                                            <input type="text" class="grid_textbox text-right" maxlength="3">%
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="grid_col_4 col_rec !text-base">
                                            @include('admin.master.price.date_form', [
                                                'initialDate' => null,
                                                'paramName' => '',
                                                'oldParamName' => '',
                                                'calendarIndex' => 0,
                                                'width' => [
                                                    'year' => '!w-[36px]',
                                                    'month' => '!w-[18px]',
                                                    'day' => '!w-[18px]',
                                                ],
                                                'readonly' => false,
                                            ])
                                        </td>
                                        <td class="grid_wrapper_right">
                                            <input type="text" class="grid_textbox text-right !w-full" maxlength="13">
                                        </td>
                                        <td class="grid_wrapper_right">
                                            <input type="text" class="grid_textbox text-right !w-full" maxlength="13">
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="grid">
                <table>
                    <thead class="grid_header">
                        <tr>
                            <td class="grid_wrapper_center !min-w-[230px]">商品コード</td>
                            <td class="grid_wrapper_center !w-[120px]">税抜上代単価</td>
                            <td class="grid_wrapper_center !w-[160px]">バーゲン開始日</td>
                            <td class="grid_wrapper_center !w-[120px]">税抜バーゲン売価</td>
                            <td class="grid_wrapper_center !w-[160px]">新売価適用日</td>
                            <td class="grid_wrapper_center !w-[120px]">税抜新売価</td>
                            <td class="grid_wrapper_center !w-[120px]">税抜旧売価</td>
                        </tr>
                        <tr>
                            <td class="grid_wrapper_center !min-w-[230px]">商品</td>
                            <td class="grid_wrapper_center !w-[120px]">税込上代単価</td>
                            <td class="grid_wrapper_center !w-[160px]">バーゲン終了日</td>
                            <td class="grid_wrapper_center !w-[120px]">税込バーゲン売価</td>
                            <td class="grid_wrapper_center !w-[160px]">旧売価適用日</td>
                            <td class="grid_wrapper_center !w-[120px]">税込新売価</td>
                            <td class="grid_wrapper_center !w-[120px]">税込旧売価</td>
                        </tr>
                    </thead>
                    <tbody class="grid_body">
                        @for ($i = 0; $i <= 10; $i++)
                            <tr class="!h-8 {{ $i % 2 === 0 ? 'bg-tr-white' : 'bg-tr-yellow' }}">
                                <td class="grid_col_6 col_rec col_rec">
                                    <div class="flex">
                                        <input type="text" name="" class="grid_textbox !w-full"
                                            maxlength="9">
                                        <img class="grid_img_left !me-2" src="/img/icon/vector.svg">
                                    </div>
                                </td>
                                <td class="grid_col_2 col_rec">
                                    <input type="text" name="" class="grid_textbox text-right !w-full"
                                        maxlength="13">
                                </td>
                                <td class="grid_col_4 col_rec">
                                    @include('admin.master.price.date_form', [
                                        'initialDate' => null,
                                        'paramName' => '',
                                        'oldParamName' => '',
                                        'calendarIndex' => 0,
                                        'width' => [
                                            'year' => '!w-[36px]',
                                            'month' => '!w-[18px]',
                                            'day' => '!w-[18px]',
                                        ],
                                        'readonly' => false,
                                    ])
                                </td>
                                <td class="grid_col_2 col_rec">
                                    <input type="text" name="" class="grid_textbox text-right !w-full"
                                        maxlength="13">
                                </td>
                                <td class="grid_col_4 col_rec">
                                    @include('admin.master.price.date_form', [
                                        'initialDate' => null,
                                        'paramName' => '',
                                        'oldParamName' => '',
                                        'calendarIndex' => 0,
                                        'width' => [
                                            'year' => '!w-[36px]',
                                            'month' => '!w-[18px]',
                                            'day' => '!w-[18px]',
                                        ],
                                        'readonly' => false,
                                    ])
                                </td>
                                <td class="grid_col_2 col_rec">
                                    <input type="text" name="" class="grid_textbox text-right !w-full"
                                        maxlength="13">
                                </td>
                                <td class="grid_col_2 col_rec">
                                    <input type="text" name="" class="grid_textbox text-right !w-full"
                                        maxlength="13">
                                </td>
                            </tr>
                            <tr class="!h-8 {{ $i % 2 === 0 ? 'bg-tr-white' : 'bg-tr-yellow' }}">
                                <td class="grid_col_6 col_rec col_rec">
                                    <input type="text" name="" class="grid_textbox !w-full" readonly>
                                </td>
                                <td class="grid_col_2 col_rec">
                                    <input type="text" name="" class="grid_textbox text-right">
                                </td>
                                <td class="grid_col_4 col_rec">
                                    @include('admin.master.price.date_form', [
                                        'initialDate' => null,
                                        'paramName' => '',
                                        'oldParamName' => '',
                                        'calendarIndex' => 0,
                                        'width' => [
                                            'year' => '!w-[36px]',
                                            'month' => '!w-[18px]',
                                            'day' => '!w-[18px]',
                                        ],
                                        'readonly' => false,
                                    ])
                                </td>
                                <td class="grid_col_2 col_rec">
                                    <input type="text" name="" class="grid_textbox text-right !w-full">
                                </td>
                                <td class="grid_col_4 col_rec">
                                    @include('admin.master.price.date_form', [
                                        'initialDate' => null,
                                        'paramName' => '',
                                        'oldParamName' => '',
                                        'calendarIndex' => 0,
                                        'width' => [
                                            'year' => '!w-[36px]',
                                            'month' => '!w-[18px]',
                                            'day' => '!w-[18px]',
                                        ],
                                        'readonly' => false,
                                    ])
                                </td>
                                <td class="grid_col_2 col_rec">
                                    <input type="text" name="" class="grid_textbox text-right !w-full">
                                </td>
                                <td class="grid_col_2 col_rec">
                                    <input type="text" name="" class="grid_textbox text-right !w-full">
                                </td>
                            </tr>
                        @endfor
                    </tbody>
                </table>
            </div>
        </div>
        @include('components.menu.selected', ['view' => 'main'])
    </form>
@endsection
