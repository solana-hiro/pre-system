<div>
    <div class="button_area">
        <button class="button" type="button" id="execute_search_rank3" wire:click="search">
            <div class="button-text_wrapper">実行する</div>
        </button>
    </div>
    <div class="element-form-rows">
        <div class="element-form element-form-columns">
            <div class="text_wrapper">ランク3コード</div>
            <div class="frame">
                <div class="textbox">
                    <input type="text" name="rank3_cd" id="rank3_cd" class="element" minlength="0" maxlength="6"
                        size="6" wire:model="customerClassCd">
                </div>
            </div>
        </div>
        <div class="element-form element-form-columns">
            <div class="text_wrapper">ランク3名(部分)</div>
            <div class="frame">
                <div class="textbox">
                    <input type="text" name="rank3_name" id="rank3_name" class="element" minlength="0"
                        maxlength="20" size="20" wire:model="customerClassName">
                </div>
            </div>
        </div>
    </div>
    @include('livewire.master_search.paginate_button', ['list' => $rank3Data])
    <div class="grid">
        <table class="table_sticky">
            <thead class="grid_header">
                <tr>
                    <td class="grid_wrapper_center td_5p">ランク3コード</td>
                    <td class="grid_wrapper_center td_10p">ランク3名</td>
                </tr>
            </thead>
            <tbody class="tbody_scroll" id="rank3_rec">
                @foreach ($rank3Data as $data)
                    <tr data-smm-dbclick="{{ $data->customer_class_cd }}" data-record-id="{{ $data->id }}"
                        @if (!is_null($option)) data-smm-option="{{ $option }}" @endif
                        @if (!is_null($target)) data-smm-option-target="{{ $target }}" @endif
                        @if (!is_null($oValue)) data-smm-option-value="{{ $oValue }}" @endif>
                        <td class="grid_wrapper_left">{{ $data['customer_class_cd'] }}</td>
                        <td class="grid_wrapper_left">{{ $data['customer_class_name'] }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
