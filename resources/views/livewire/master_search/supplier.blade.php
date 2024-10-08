<div data-lw="master-search.supplier">
    <div class="button_area">
        <button class="button" type="button" wire:click="search">
            <div class="button-text_wrapper">実行する</div>
        </button>
    </div>
    <div class="element-form-rows">
        <div class="element-form">
            <div class="text_wrapper">仕入先コード</div>
            <div class="frame">
                <div class="textbox">
                    <input type="number" name="supplier_cd" id="supplier_cd" class="element input_number_6"
                        data-pad-code="6" data-limit-len="6" data-limit-minus data-lwo="supplierCd"
                        wire:model="supplierCd">
                </div>
            </div>
        </div>
        <div class="element-form">
            <div class="text_wrapper">名称(部分)</div>
            <div class="frame">
                <div class="textbox">
                    <input type="text" name="supplier_name" id="supplier_name" class="element" minlength="0"
                        maxlength="20" size="20" wire:model="supplierName">
                </div>
            </div>
        </div>
    </div>
    <div class="element-form-rows">
        <div class="element-form">
            <div class="text_wrapper">仕入先名カナ</div>
            <div class="frame">
                <div class="textbox">
                    <input type="text" name="supplier_name_kana" id="supplier_name_kana" class="element"
                        minlength="0" maxlength="20" size="20" wire:model="supplierNameKana">
                </div>
            </div>
        </div>
        <div class="element-form">
            <div class="text_wrapper">TEL(部分)</div>
            <div class="frame">
                <div class="textbox">
                    <input type="text" name="tel" id="tel" class="element" minlength="0" maxlength="11"
                        size="11" wire:model="tel">
                </div>
            </div>
        </div>
    </div>
    @include('livewire.master_search.paginate_button', ['list' => $supplierData])
    <div class="grid">
        <table class="table_sticky">
            <thead class="grid_header">
                <tr>
                    <td class="grid_wrapper_center td_5p">仕入先コード</td>
                    <td class="grid_wrapper_center td_10p">仕入先名</td>
                    <td class="grid_wrapper_center td_10p">カナ</td>
                    <td class="grid_wrapper_center td_10p">電話番号</td>
                    <td class="grid_wrapper_center td_5p">締日</td>
                </tr>
            </thead>
            <tbody class="tbody_scroll" id="supplier_rec">
                @foreach ($supplierData as $data)
                    <tr data-smm-dbclick="{{ $data->supplier_cd }}">
                        <td class="grid_wrapper_left">{{ $data['supplier_cd'] }}</td>
                        <td class="grid_wrapper_left">{{ $data['supplier_name'] }}</td>
                        <td class="grid_wrapper_left">{{ $data['supplier_name_kana'] }}</td>
                        <td class="grid_wrapper_left">{{ $data['tel'] }}</td>
                        <td class="grid_wrapper_left">
                            @if ($data['sequentially_kbn'] == 0)
                                {{ $data['closing_date'] . '/' . $data['closing_month'] . '/' . $data['pay_date'] }}
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
