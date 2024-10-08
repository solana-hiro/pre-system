<div>
    <div class="button_area">
        <button class="button" type="button" id="execute_search_supplier_class2" wire:click="search">
            <div class="button-text_wrapper">実行する</div>
        </button>
    </div>
    <div class="element-form-rows">
        <div class="element-form">
            <div class="text_wrapper">仕入先分類2コード</div>
            <div class="frame">
                <div class="textbox">
                    <input type="text" name="supplier_class2_cd" id="supplier_class2_cd" class="element"
                        minlength="0" maxlength="6" size="6" wire:model="supplierClassCd">
                </div>
            </div>
        </div>
        <div class="element-form">
            <div class="text_wrapper">仕入先分類2名(部分)</div>
            <div class="frame">
                <div class="textbox">
                    <input type="text" name="supplier_class2_name" id="supplier_class2_name" class="element"
                        minlength="0" maxlength="20" size="15" wire:model="supplierClassName">
                </div>
            </div>
        </div>
    </div>
    @include('livewire.master_search.paginate_button', ['list' => $supplierClass2Data])
    <div class="grid">
        <table class="table_sticky">
            <thead class="grid_header">
                <tr>
                    <td class="grid_wrapper_center td_5p">仕入先分類2コード</td>
                    <td class="grid_wrapper_center td_10p">仕入先分類2名</td>
                </tr>
            </thead>
            <tbody class="tbody_scroll" id="supplier_class2_rec">
                @foreach ($supplierClass2Data as $data)
                    <tr data-smm-dbclick="{{ $data->supplier_class_cd }}">
                        <td class="grid_wrapper_left">{{ $data['supplier_class_cd'] }}</td>
                        <td class="grid_wrapper_left">{{ $data['supplier_class_name'] }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
