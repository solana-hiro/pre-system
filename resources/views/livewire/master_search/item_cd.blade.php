<div data-lw="master-search.item-cd" id="master_search_item_cd">
    <div class="button_area">
        <button class="button" type="button" id="" wire:click="search">
            <div class="button-text_wrapper" id="livewire_search_btn">実行する</div>
        </button>
    </div>
    <div class="element-form-rows">
        <div class="element-form">
            <div class="text_wrapper">ブランド1コード</div>
            <div class="frame">
                <div class="textbox">
                    <input type="text" name="mt_item_class1_cd" id="input_code1" class="element" minlength="0"
                        onblur="ItemSearch.eventBlurCodeautoItemClass(this)"
                        maxlength="6" size="1" wire:model="mtItemClass1Cd" data-lwo="mtItemClass1Cd">
                    <img class="vector" id="img_code1" src="{{ asset('/img/icon/vector.svg') }}"
                        data-smm-open="search_brand1_modal" />
                </div>
                <div class="textbox td_100px">
                    <input type="text"  id="names_code1" value="">
                </div>
            </div>
        </div>
        <div class="element-form">
            <div class="text_wrapper">競技・カテゴリ</div>
            <div class="frame">
                <div class="textbox">
                    <input type="text" name="mt_item_class2_cd" id="input_code2" class="element" minlength="0"
                    onblur="ItemSearch.eventBlurCodeautoItemClass(this)"
                        maxlength="6" size="1" wire:model="mtItemClass2Cd" data-lwo="mtItemClass2Cd">
                    <img class="vector" id="img_code2" src="{{ asset('/img/icon/vector.svg') }}"
                        data-smm-open="search_game_category_modal" />
                </div>
                <div class="textbox td_100px">
                    <input type="text"  id="names_code2" value="">
                </div>
            </div>
        </div>
    </div>
    <div class="element-form-rows">
        <div class="element-form">
            <div class="text_wrapper">ジャンル</div>
            <div class="frame">
                <div class="textbox">
                    <input type="text" name="mt_item_class3_cd" id="input_code3" class="element" minlength="0"
                        onblur="ItemSearch.eventBlurCodeautoItemClass(this)"
                        maxlength="6" size="1" wire:model="mtItemClass3Cd" data-lwo="mtItemClass3Cd">
                    <img class="vector" id="img_code3" src="{{ asset('/img/icon/vector.svg') }}"
                        data-smm-open="search_genre_modal" />
                </div>
                <div class="textbox td_100px">
                    <input type="text"  id="names_code3" value="">
                </div>
            </div>
        </div>
        <div class="element-form">
            <div class="text_wrapper">販売開始年コード</div>
            <div class="frame">
                <div class="textbox">
                    <input type="text" name="mt_item_class4_cd" id="input_code4" class="element" minlength="0"
                        onblur="ItemSearch.eventBlurCodeautoItemClass(this)"
                        maxlength="6" size="1" wire:model="mtItemClass4Cd" data-lwo="mtItemClass4Cd">
                    <img class="vector" id="img_code4" src="{{ asset('/img/icon/vector.svg') }}"
                        data-smm-open="search_item_class_thing4_modal" />
                </div>
                <div class="textbox td_100px">
                    <input type="text"  id="names_code4" value="">
                </div>
            </div>
        </div>
        <div class="element-form">
            <div class="text_wrapper">工場分類5コード</div>
            <div class="frame">
                <div class="textbox">
                    <input type="text" name="mt_item_class5_cd" id="input_code5" class="element" minlength="0"
                        onblur="ItemSearch.eventBlurCodeautoItemClass(this)"
                        maxlength="6" size="1" wire:model="mtItemClass5Cd" data-lwo="mtItemClass5Cd">
                    <img class="vector" id="img_code5" src="{{ asset('/img/icon/vector.svg') }}"
                        data-smm-open="search_item_class_thing5_modal" />
                </div>
                <div class="textbox td_100px">
                    <input type="text"  id="names_code5" value="">
                </div>
            </div>
        </div>
    </div>
    <div class="element-form-rows">
        <div class="element-form">
            <div class="text_wrapper">製品/工賃6コード</div>
            <div class="frame">
                <div class="textbox">
                    <input type="text" name="mt_item_class6_cd" id="input_code6" class="element" minlength="0"
                        onblur="ItemSearch.eventBlurCodeautoItemClass(this)"
                        maxlength="6" size="1" wire:model="mtItemClass6Cd" data-lwo="mtItemClass6Cd">
                    <img class="vector" id="img_code6" src="{{ asset('/img/icon/vector.svg') }}"
                        data-smm-open="search_item_class_thing6_modal" />
                </div>
                <div class="textbox td_100px">
                    <input type="text"  id="names_code6" value="">
                </div>
            </div>
        </div>
        <div class="element-form">
            <div class="text_wrapper">資産在庫JAコード</div>
            <div class="frame">
                <div class="textbox">
                    <input type="text" name="mt_item_class7_cd" id="input_code7" class="element" minlength="0"
                        onblur="ItemSearch.eventBlurCodeautoItemClass(this)"
                        maxlength="6" size="1" wire:model="mtItemClass7Cd" data-lwo="mtItemClass7Cd">
                    <img class="vector" id="img_code7" src="{{ asset('/img/icon/vector.svg') }}"
                        data-smm-open="search_item_class_thing7_modal" />
                </div>
                <div class="textbox td_100px">
                    <input type="text"  id="names_code7" value="">
                </div>
            </div>
        </div>
    </div>
    <input type="hidden" id="hidden_code1" value="" name="hidden_code1" />
    <input type="hidden" id="hidden_code2" value="" name="hidden_code2" />
    <input type="hidden" id="hidden_code3" value="" name="hidden_code3" />
    <input type="hidden" id="hidden_code4" value="" name="hidden_code4" />
    <input type="hidden" id="hidden_code5" value="" name="hidden_code5" />
    <input type="hidden" id="hidden_code6" value="" name="hidden_code6" />
    <input type="hidden" id="hidden_code7" value="" name="hidden_code7" />
    <input type="hidden" name="item_kbn" id="item_kbn_with_search" wire:model="itemKbn" data-lwo="itemKbn" />
    <div class="element-form-rows">
        <div class="element-form">
            <div class="text_wrapper">商品名カナ</div>
            <div class="frame">
                <div class="textbox">
                    <input type="text" name="kana" id="kana" class="element" minlength="0"
                        maxlength="" size="10" wire:model="kana">
                </div>
            </div>
        </div>
        <div class="element-form">
            <div class="text_wrapper">商品コード</div>
            <div class="frame">
                <div class="textbox">
                    <input type="text" name="code" id="code" class="element" minlength="0"
                        maxlength="" size="10" wire:model="code">
                </div>
            </div>
        </div>
        <div class="element-form">
            <div class="text_wrapper">商品名(部分)</div>
            <div class="frame">
                <div class="textbox">
                    <input type="text" name="name" id="name" class="element" minlength="0"
                        maxlength="" size="10" wire:model="name">
                </div>
            </div>
        </div>
        <div class="element-form">
            <div class="text_wrapper">他品番(部分)</div>
            <div class="frame">
                <div class="textbox">
                    <input type="text" name="other_part_number" id="other_part_number" class="element"
                        minlength="0" maxlength="" size="10" wire:model="otherPartNumber">
                </div>
            </div>
        </div>
    </div>
    <div class="element-form-rows">
        <div class="element-form">
            <div class="text_wrapper">JANコード</div>
            <div class="frame">
                <div class="textbox">
                    <input type="text" name="jan" id="jan" class="element" minlength="0"
                        maxlength="" size="10" wire:model="jan">
                </div>
            </div>
        </div>
        <div class="element-form">
            <div class="text_wrapper">メンバーサイト商品コード</div>
            <div class="frame">
                <div class="textbox">
                    <input type="text" name="mt_member_site_item_cd" id="mt_member_site_item_cd" class="element"
                        minlength="0" maxlength="20" size="10" wire:model="mtMemberSiteItemCd">
                </div>
            </div>
        </div>
    </div>
    @include('livewire.master_search.paginate_button', ['list' => $itemData])
    <div class="grid">
        <table class="table_sticky">
            <thead class="grid_header">
                <tr>
                    <td class="grid_wrapper_center td_5p">商品コード</td>
                    <td class="grid_wrapper_center td_10p">他品番</td>
                    <td class="grid_wrapper_center td_10p">商品名</td>
                    <td class="grid_wrapper_center td_10p">商品名カナ</td>
                    <td class="grid_wrapper_center td_10p">上代単価</td>
                    <td class="grid_wrapper_center td_10p">ブランド1コード</td>
                    <td class="grid_wrapper_center td_10p">競技・カテゴリコード</td>
                    <td class="grid_wrapper_center td_10p">ジャンルコード</td>
                    <td class="grid_wrapper_center td_10p">販売開始年コード</td>
                    <td class="grid_wrapper_center td_10p">工場分類コード</td>
                    <td class="grid_wrapper_center td_10p">製品/工賃コード</td>
                    <td class="grid_wrapper_center td_10p">資産在庫JAコード</td>
                    <td class="grid_wrapper_center td_10p">メンバサイト商品コード</td>
                    <td class="grid_wrapper_center td_10p">メンバサイト商品名</td>
                </tr>
            </thead>
            <tbody class="tbody_scroll" id="item_cd_rec">
                @foreach ($itemData as $data)
                    <tr data-smm-dbclick="{{ $data->item_cd }}">
                        <td class="grid_wrapper_left">{{ $data['item_cd'] }}</td>
                        <td class="grid_wrapper_left">{{ $data['other_part_number'] }}</td>
                        <td class="grid_wrapper_left">{{ $data['item_name'] }}</td>
                        <td class="grid_wrapper_left">{{ $data['item_name_kana'] }}</td>
                        <td class="grid_wrapper_left">{{ $data['cost_price'] }}</td>
                        <td class="grid_wrapper_left">{{ $data['mt_item_class1_cd'] }}</td>
                        <td class="grid_wrapper_left">{{ $data['mt_item_class2_cd'] }}</td>
                        <td class="grid_wrapper_left">{{ $data['mt_item_class3_cd'] }}</td>
                        <td class="grid_wrapper_left">{{ $data['mt_item_class4_cd'] }}</td>
                        <td class="grid_wrapper_left">{{ $data['mt_item_class5_cd'] }}</td>
                        <td class="grid_wrapper_left">{{ $data['mt_item_class6_cd'] }}</td>
                        <td class="grid_wrapper_left">{{ $data['mt_item_class7_cd'] }}</td>
                        <td class="grid_wrapper_left">{{ $data['ec_item_cd'] }}</td>
                        <td class="grid_wrapper_left">{{ $data['ec_item_name'] }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
