<div>
    <div class="button_area">
        <button class="button" type="button" id="execute_search_brand1" wire:click="search">
            <div class="button-text_wrapper">実行する</div>
        </button>
    </div>
    <div class="element-form-rows">
        <div class="element-form element-form-columns">
            <div class="text_wrapper">ブランド1コード</div>
            <div class="frame">
                <div class="textbox">
                    <input type="text" name="brand1_cd" id="brand1_cd" class="element" minlength="0" maxlength="6"
                        size="6" wire:model="itemClassCd">
                </div>
            </div>
        </div>
        <div class="element-form element-form-columns">
            <div class="text_wrapper">ブランド1名(部分)</div>
            <div class="frame">
                <div class="textbox">
                    <input type="text" name="brand1_name" id="brand1_name" class="element" minlength="0"
                        maxlength="20" size="20" wire:model="itemClassName">
                </div>
            </div>
        </div>
    </div>
    @include('livewire.master_search.paginate_button', ['list' => $brand1Data])
    <div class="grid">
        <table class="table_sticky">
            <thead class="grid_header">
                <tr>
                    <td class="grid_wrapper_center td_5p">ブランド1コード</td>
                    <td class="grid_wrapper_center td_10p">ブランド1名</td>
                </tr>
            </thead>
            <tbody class="tbody_scroll" id="brand1_rec">
                @foreach ($brand1Data as $data)
                    <tr data-smm-dbclick="{{ $data->item_class_cd }}">
                        <td class="grid_wrapper_left">{{ $data['item_class_cd'] }}</td>
                        <td class="grid_wrapper_left">{{ $data['item_class_name'] }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
