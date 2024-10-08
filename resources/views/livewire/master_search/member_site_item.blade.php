<div>
    <div class="button_area">
        <button class="button" type="button" id="execute_search_member_site_item" wire:click="search">
            <div class="button-text_wrapper">実行する</div>
        </button>
    </div>
    <div class="element-form-columns">
        <div class="element-form element-form-rows">
            <div class="text_wrapper">メンバーサイト商品コード</div>
            <div class="frame">
                <div class="textbox">
                    <input type="text" name="ec_item_cd" id="ec_item_cd" class="element" minlength="0"
                        maxlength="20" size="15" wire:model="ecItemCd">
                </div>
            </div>
        </div><br>
        <div class="element-form element-form-rows">
            <div class="text_wrapper">メンバーサイト商品名(部分)</div>
            <div class="frame">
                <div class="textbox">
                    <input type="text" name="ec_item_name" id="ec_item_name" class="element" minlength="0"
                        maxlength="30" size="15" wire:model="ecItemName">
                </div>
            </div>
        </div>
    </div>
    @include('livewire.master_search.paginate_button', ['list' => $memberSiteItemData])
    <div class="grid">
        <table class="table_sticky">
            <thead class="grid_header">
                <tr>
                    <td class="grid_wrapper_center td_5p">メンバーサイト商品コード</td>
                    <td class="grid_wrapper_center td_10p">メンバーサイト商品名</td>
                </tr>
            </thead>
            <tbody class="tbody_scroll" id="member_site_item_rec">
                @foreach ($memberSiteItemData as $data)
                    <tr data-smm-dbclick="{{ $data->ec_item_cd }}">
                        <td class="grid_wrapper_left">{{ $data['ec_item_cd'] }}</td>
                        <td class="grid_wrapper_left">{{ $data['ec_item_name'] }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
