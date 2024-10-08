<div>
    <div class="button_area">
        <button class="button" type="button" id="execute_search_firm_class5" wire:click="search">
            <div class="button-text_wrapper">実行する</div>
        </button>
    </div>
    <div class="element-form-rows">
        <div class="element-form element-form-columns">
            <div class="text_wrapper">工場分類5コード</div>
            <div class="frame">
                <div class="textbox">
                    <input type="text" name="firm_class5_cd" id="firm_class5_cd" class="element" minlength="0"
                        maxlength="6" size="6" wire:model="itemClassCd">
                </div>
            </div>
        </div>
        <div class="element-form element-form-columns">
            <div class="text_wrapper">工場分類5名(部分)</div>
            <div class="frame">
                <div class="textbox">
                    <input type="text" name="firm_class5_name" id="firm_class5_name" class="element" minlength="0"
                        maxlength="20" size="20" wire:model="itemClassName">
                </div>
            </div>
        </div>
    </div>
    @include('livewire.master_search.paginate_button', ['list' => $itemClassThing5Data])
    <div class="grid">
        <table class="table_sticky">
            <thead class="grid_header">
                <tr>
                    <td class="grid_wrapper_center td_5p">工場分類5コード</td>
                    <td class="grid_wrapper_center td_15p">工場分類5名</td>
                </tr>
            </thead>
            <tbody class="tbody_scroll" id="firm_class5_rec">
                @foreach ($itemClassThing5Data as $data)
                    <tr data-smm-dbclick="{{ $data->item_class_cd }}">
                        <td class="grid_wrapper_left">{{ $data['item_class_cd'] }}</td>
                        <td class="grid_wrapper_left">{{ $data['item_class_name'] }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
