<div data-lw="master-search.warehouse">
    <div class="button_area">
        <button class="button" type="button" wire:click="search">
            <div class="button-text_wrapper">実行する</div>
        </button>
    </div>
    <div class="element-form-rows">
        <div class="element-form">
            <div class="text_wrapper">倉庫コード</div>
            <div class="frame">
                <div class="textbox">
                    <input type="number" name="warehouse_cd" id="warehouse_cd" class="element input_number_6"
                        data-pad-code="6" data-limit-len="6" data-limit-minus data-lwo="warehouseCd"
                        wire:model="warehouseCd">
                </div>
            </div>
        </div>
        <div class="element-form">
            <div class="text_wrapper">名カナ</div>
            <div class="frame">
                <div class="textbox">
                    <input type="text" name="warehouse_name_kana" id="warehouse_name_kana" class="element"
                        minlength="0" maxlength="10" size="10" wire:model="warehouseName">
                </div>
            </div>
        </div>
    </div>
    @include('livewire.master_search.paginate_button', ['list' => $warehouseData])
    <div class="grid">
        <table class="table_sticky">
            <thead class="grid_header">
                <tr>
                    <td class="grid_wrapper_center td_5p">倉庫コード</td>
                    <td class="grid_wrapper_center td_15p">倉庫名</td>
                    <td class="grid_wrapper_center td_10p">名カナ</td>
                    <td class="grid_wrapper_center td_10p">倉庫種別</td>
                </tr>
            </thead>
            <tbody class="tbody_scroll" id="warehouse_rec">
                @foreach ($warehouseData as $data)
                    <tr data-smm-dbclick="{{ $data->warehouse_cd }}" data-smm-dbclick2="{{ $data->warehouse_name }}">
                        <td class="grid_wrapper_left">{{ $data['warehouse_cd'] }}</td>
                        <td class="grid_wrapper_left">{{ $data['warehouse_name'] }}</td>
                        <td class="grid_wrapper_left">{{ $data['warehouse_name_kana'] }}</td>
                        <td class="grid_wrapper_left">{{ $data['kind_label'] }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
