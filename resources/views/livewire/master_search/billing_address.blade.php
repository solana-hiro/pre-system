<div data-lw="master-search.billing-address">
    <div class="button_area">
        <button class="button" type="button" id="" wire:click="search">
            <div class="button-text_wrapper">実行する</div>
        </button>
    </div>
    <div class="element-form-rows">
        <div class="element-form">
            <div class="text_wrapper">請求先コード</div>
            <div class="frame">
                <div class="textbox">
                    <input type="number" name="code" id="billing_address_code" class="element input_number_6"
                        data-pad-code="6" data-limit-len="6" data-limit-minus size="6" data-lwo="billingAddressCd"
                        wire:model="billingAddressCd">
                </div>
            </div>
        </div>
        <div class="element-form">
            <div class="text_wrapper">名称(部分)</div>
            <div class="frame">
                <div class="textbox">
                    <input type="text" name="name" id="name" class="element" minlength="0" maxlength="20"
                        size="20" wire:model="name">
                </div>
            </div>
        </div>
    </div>
    <div class="element-form-rows">
        <div class="element-form">
            <div class="text_wrapper">請求先名カナ</div>
            <div class="frame">
                <div class="textbox">
                    <input type="text" name="kana" id="kana" class="element" minlength="0" maxlength="20"
                        size="20" wire:model="kana">
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
    @include('livewire.master_search.paginate_button', ['list' => $billingAddressData])
    <div class="grid">
        <table class="table_sticky">
            <thead class="grid_header">
                <tr>
                    <td class="grid_wrapper_center td_5p">請求先コード</td>
                    <td class="grid_wrapper_center td_10p">請求先名</td>
                    <td class="grid_wrapper_center td_10p">カナ</td>
                    <td class="grid_wrapper_center td_10p">電話番号</td>
                    <td class="grid_wrapper_center td_10p">締日1</td>
                    <td class="grid_wrapper_center td_10p">締日2</td>
                    <td class="grid_wrapper_center td_10p">締日3</td>
                </tr>
            </thead>
            <tbody class="tbody_scroll" id="billing_address_rec">
                @foreach ($billingAddressData as $data)
                    <tr data-smm-dbclick="{{ $data->customer_cd }}">
                        <td class="grid_wrapper_left">{{ $data['customer_cd'] }}</td>
                        <td class="grid_wrapper_left">{{ $data['customer_name'] }}</td>
                        <td class="grid_wrapper_left">{{ $data['customer_name_kana'] }}</td>
                        <td class="grid_wrapper_left">{{ $data['tel'] }}</td>
                        <td class="grid_wrapper_left">
                            @if ($data['sequentially_kbn'] == 0 && '' != trim($data['closing_date_1']))
                                {{ $data['closing_date_1'] . '/' . $data['collect_month_1'] . '/' . $data['collect_date_1'] }}
                            @endif
                        </td>
                        <td class="grid_wrapper_left">
                            @if ($data['sequentially_kbn'] == 0 && '' != trim($data['closing_date_2']))
                                {{ $data['closing_date_2'] . '/' . $data['collect_month_2'] . '/' . $data['collect_date_2'] }}
                            @endif
                        </td>
                        <td class="grid_wrapper_left">
                            @if ($data['sequentially_kbn'] == 0 && '' != trim($data['closing_date_3']))
                                {{ $data['closing_date_3'] . '/' . $data['collect_month_3'] . '/' . $data['collect_date_3'] }}
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
