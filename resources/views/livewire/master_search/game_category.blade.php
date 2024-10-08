<div>
    <div class="button_area">
        <button class="button" type="button" id="execute_search_game_category" wire:click="search">
            <div class="button-text_wrapper">実行する</div>
        </button>
    </div>
    <div class="element-form-rows">
        <div class="element-form element-form-columns">
            <div class="text_wrapper">競技・カテゴリコード</div>
            <div class="frame">
                <div class="textbox">
                    <input type="text" name="game_category_cd" id="game_category_cd" class="element" minlength="0"
                        maxlength="6" size="6" wire:model="itemClassCd">
                </div>
            </div>
        </div>
        <div class="element-form element-form-columns">
            <div class="text_wrapper">競技・カテゴリ名(部分)</div>
            <div class="frame">
                <div class="textbox">
                    <input type="text" name="game_category_name" id="game_category_name" class="element"
                        minlength="0" maxlength="20" size="20" wire:model="itemClassName">
                </div>
            </div>
        </div>
    </div>
    @include('livewire.master_search.paginate_button', ['list' => $itemClassThing2Data])
    <div class="grid">
        <table class="table_sticky">
            <thead class="grid_header">
                <tr>
                    <td class="grid_wrapper_center td_5p">競技・カテゴリコード</td>
                    <td class="grid_wrapper_center td_10p">競技・カテゴリ名</td>
                </tr>
            </thead>
            <tbody class="tbody_scroll">
            <tbody class="tbody_scroll" id="game_category_rec">
                @foreach ($itemClassThing2Data as $data)
                    <tr data-smm-dbclick="{{ $data->item_class_cd }}">
                        <td class="grid_wrapper_left">{{ $data['item_class_cd'] }}</td>
                        <td class="grid_wrapper_left">{{ $data['item_class_name'] }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
