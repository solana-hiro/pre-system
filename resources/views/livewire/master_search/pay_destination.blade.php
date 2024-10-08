<div data-lw="master-search.pay-destination">
    <div class="button_area">
        <button class="button" type="button" wire:click="search">
            <div class="button-text_wrapper">実行する</div>
        </button>
    </div>
    <div class="element-form-rows">
        <div class="element-form">
            <div class="text_wrapper">支払先コード</div>
            <div class="frame">
                <div class="textbox">
                    <input type="number" name="pay_destination_cd" id="pay_destination_cd" class="element"
                        data-pad-code="6" data-limit-len="6" data-limit-minus data-lwo="code" wire:model="code">
                </div>
            </div>
        </div>
        <div class="element-form">
            <div class="text_wrapper">名称(部分)</div>
            <div class="frame">
                <div class="textbox">
                    <input type="text" name="pay_destination_name" id="pay_destination_name" class="element"
                        minlength="0" maxlength="20" size="20" wire:model="name">
                </div>
            </div>
        </div>
    </div>
    <div class="element-form-rows">
        <div class="element-form">
            <div class="text_wrapper">支払先名カナ</div>
            <div class="frame">
                <div class="textbox">
                    <input type="text" name="pay_destination_name_kana" id="pay_destination_name_kana"
                        class="element" minlength="0" maxlength="10" size="10" wire:model="kana">
                </div>
            </div>
        </div>
        <div class="element-form">
            <div class="text_wrapper">TEL(部分)</div>
            <div class="frame">
                <div class="textbox">
                    <input type="text" name="pay_destination_tel" id="pay_destination_tel" class="element"
                        minlength="0" maxlength="11" size="11" wire:model="tel">
                </div>
            </div>
        </div>
    </div>
    @include('livewire.master_search.paginate_button', ['list' => $payDestinationData])
    <div class="grid">
        <table class="table_sticky">
            <thead class="grid_header">
                <tr>
                    <td class="grid_wrapper_center td_5p">支払先コード</td>
                    <td class="grid_wrapper_center td_10p">支払先名</td>
                    <td class="grid_wrapper_center td_10p">カナ</td>
                    <td class="grid_wrapper_center td_10p">電話番号</td>
                    <td class="grid_wrapper_center td_5p">締日</td>
                </tr>
            </thead>
            <tbody class="tbody_scroll" id="pay_destination_rec">
                @foreach ($payDestinationData as $data)
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
