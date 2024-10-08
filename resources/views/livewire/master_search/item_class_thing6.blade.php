<div>
    <div class="button_area">
        <button class="button" type="button" id="execute_search_item_class_thing6" wire:click="search">
            <div class="button-text_wrapper">実行する</div>
        </button>
    </div>
    <div class="element-form-rows">
        <div class="element-form">
            <div class="text_wrapper">製品/工賃6コード</div>
            <div class="frame">
                <div class="textbox">
                    <input type="text" name="item_class_thing6_cd" id="item_class_thing6_cd" class="element"
                        minlength="0" maxlength="6" size="6" wire:model="itemClassCd">
                </div>
            </div>
        </div>
        <div class="element-form">
            <div class="text_wrapper">製品/工賃6名(部分)</div>
            <div class="frame">
                <div class="textbox">
                    <input type="text" name="item_class_thing6_name" id="item_class_thing6_name" class="element"
                        minlength="0" maxlength="20" size="10" wire:model="itemClassName">
                </div>
            </div>
        </div>
    </div>
    @include('livewire.master_search.paginate_button', ['list' => $itemClassThing6Data])
    <div class="grid">
        <table class="table_sticky">
            <thead class="grid_header">
                <tr>
                    <td class="grid_wrapper_center td_5p">製品/工賃6コード</td>
                    <td class="grid_wrapper_center td_10p">製品/工賃6名</td>
                </tr>
            </thead>
            <tbody class="tbody_scroll" id="item_class_thing6_rec">
                @foreach ($itemClassThing6Data as $data)
                    <tr data-smm-dbclick="{{ $data->item_class_cd }}">
                        <td class="grid_wrapper_left">{{ $data['item_class_cd'] }}</td>
                        <td class="grid_wrapper_left">{{ $data['item_class_name'] }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
