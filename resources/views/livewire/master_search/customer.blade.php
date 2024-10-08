<div data-lw="master-search.customer">
    <div class="button_area">
        <button class="button" type="button" wire:click="search">
            <div class="button-text_wrapper">実行する</div>
        </button>
    </div>
    <div class="element-form-rows">
        <div class="element-form">
            <div class="text_wrapper">得意先コード</div>
            <div class="frame">
                <div class="textbox">
                    <input type="number" name="customer_cd" id="customer_cd" class="element input_number_6"
                        data-pad-code="6" data-limit-len="6" data-limit-minus data-lwo="customerCd"
                        wire:model="customerCd">
                </div>
            </div>
        </div>
        <div class="element-form">
            <div class="text_wrapper">名称(部分)</div>
            <div class="frame">
                <div class="textbox">
                    <input type="text" name="customer_name" id="customer_name" class="element" minlength="0"
                        maxlength="20" size="20" wire:model="customerName">
                </div>
            </div>
        </div>
    </div>
    <div class="element-form-rows">
        <div class="element-form">
            <div class="text_wrapper">得意先名カナ</div>
            <div class="frame">
                <div class="textbox">
                    <input type="text" name="customer_name_kana" id="customer_name_kana" class="element"
                        minlength="0" maxlength="10" size="10" wire:model="customerNameKana">
                </div>
            </div>
        </div>
        <div class="element-form">
            <div class="text_wrapper">TEL(部分)</div>
            <div class="frame">
                <div class="textbox">
                    <input type="text" name="customer_tel" id="customer_tel" class="element" minlength="0"
                        maxlength="11" size="11" wire:model="tel">
                </div>
            </div>
        </div>
    </div>
    @include('livewire.master_search.paginate_button', ['list' => $customerData])
    <div class="grid">
        <table class="table_sticky">
            <thead class="grid_header">
                <tr>
                    <td class="grid_wrapper_center td_5p">得意先コード</td>
                    <td class="grid_wrapper_center td_10p">得意先名</td>
                    <td class="grid_wrapper_center td_10p">カナ</td>
                    <td class="grid_wrapper_center td_10p">電話番号</td>
                    <td class="grid_wrapper_center td_5p">締日1</td>
                    <td class="grid_wrapper_center td_5p">締日2</td>
                    <td class="grid_wrapper_center td_5p">締日3</td>
                </tr>
            </thead>
            <tbody class="tbody_scroll" id="customer_rec">
                @foreach ($customerData as $data)
                    <tr data-smm-dbclick="{{ $data->customer_cd }}" data-record-id="{{ $data->id }}"
                        @if (!is_null($option)) data-smm-option="{{ $option }}" @endif
                        @if (!is_null($target)) data-smm-option-target="{{ $target }}" @endif
                        @if (!is_null($oValue)) data-smm-option-value="{{ $oValue }}" @endif>
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
