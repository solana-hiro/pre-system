<div data-lw="master-search.delivery-destination">
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
                    <input type="number" name="delivery_customer_cd" id="delivery_customer_cd"
                        class="element input_number_6" data-pad-code="6" data-limit-len="6" data-limit-minus
                        data-lwo="customerCd" wire:model="customerCd">
                </div>
            </div>
        </div>
        <div class="element-form">
            <div class="text_wrapper">納品先コード</div>
            <div class="frame">
                <div class="textbox">
                    <input type="number" name="delivery_cd" id="delivery_cd" class="element input_number_6"
                        data-pad-code="6" data-limit-len="6" data-limit-minus data-lwo="deliveryDestinationCd"
                        wire:model="deliveryDestinationCd">
                </div>
            </div>
        </div>
        <div class="element-form">
            <div class="text_wrapper">名称(部分)</div>
            <div class="frame">
                <div class="textbox">
                    <input type="text" name="delivery_name" id="delivery_name" class="element" minlength="0"
                        maxlength="20" size="20" wire:model="deliveryDestinationName">
                </div>
            </div>
        </div>
    </div>
    <div class="element-form-rows">
        <div class="element-form">
            <div class="text_wrapper">納品先名カナ</div>
            <div class="frame">
                <div class="textbox">
                    <input type="text" name="delivery_name_kana" id="delivery_name_kana" class="element"
                        minlength="0" maxlength="20" size="20" wire:model="deliveryDestinationNameKana">
                </div>
            </div>
        </div>
        <div class="element-form">
            <div class="text_wrapper">TEL(部分)</div>
            <div class="frame">
                <div class="textbox">
                    <input type="text" name="delivery_tel" id="delivery_tel" class="element" minlength="0"
                        maxlength="11" size="11" wire:model="tel">
                </div>
            </div>
        </div>
    </div>
    @include('livewire.master_search.paginate_button', ['list' => $deliveryDestinationData])
    <div class="grid">
        <table class="table_sticky">
            <thead class="grid_header">
                <tr>
                    <td class="grid_wrapper_center td_5p">得意先コード</td>
                    <td class="grid_wrapper_center td_10p">得意先名</td>
                    <td class="grid_wrapper_center td_5p">納品先コード</td>
                    <td class="grid_wrapper_center td_10p">納品先名</td>
                    <td class="grid_wrapper_center td_10p">カナ</td>
                    <td class="grid_wrapper_center td_10p">電話番号</td>
                </tr>
            </thead>
            <tbody class="tbody_scroll" id="delivery_destination_rec">
                @foreach ($deliveryDestinationData as $data)
                    <tr data-smm-dbclick="{{ $data->delivery_destination_id }}">
                        <td class="grid_wrapper_left">{{ $data['customer_cd'] }}</td>
                        <td class="grid_wrapper_left">{{ $data['customer_name'] }}</td>
                        <td class="grid_wrapper_left">{{ $data['delivery_destination_id'] }}</td>
                        <td class="grid_wrapper_left">{{ $data['delivery_destination_name'] }}</td>
                        <td class="grid_wrapper_left">{{ $data['delivery_destination_name_kana'] }}</td>
                        <td class="grid_wrapper_left">{{ $data['tel'] }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
