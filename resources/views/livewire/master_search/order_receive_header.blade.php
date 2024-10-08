<div>
    <div class="button_area">
        <button class="button" type="button" wire:click="search">
            <div class="button-text_wrapper">実行する</div>
        </button>
    </div>
    <div class="element-form-rows">
        <div class="element-form">
            <div class="text_wrapper">受注伝票No.</div>
            <div class="frame">
                <div class="textbox">
                    <input type="number" name="order_receive_number" id="order_receive_number" class="element w-[88px]"
                           data-pad-code="8" data-limit-len="8" data-limit-minus data-lwo="orderReceiveNumber"
                           wire:model="orderReceiveNumber">
                </div>
            </div>
        </div>
        <div class="element-form">
            <div class="text_wrapper">得意先コード</div>
            <div class="frame">
                <div class="textbox">
                    <input type="text" name="customer_cd" id="customer_cd" class="element w-[70px]" minlength="0"
                           maxlength="6" size="6" wire:model="customerCd">
                </div>
            </div>
        </div>
        <div class="element-form">
            <div class="text_wrapper">オーダーNo.</div>
            <div class="frame">
                <div class="textbox">
                    <input type="text" name="order_number" id="order_number" class="element w-[150px]" minlength="0"
                           maxlength="15" size="15" wire:model="orderNumber">
                </div>
            </div>
        </div>
    </div>
    @include('livewire.master_search.paginate_button', ['list' => $orderReceiveHeaderData])
    <div class="grid">
        <table class="table_sticky">
            <thead class="grid_header">
            <tr>
                <td class="grid_wrapper_center td_15p">受注No.</td>
                <td class="grid_wrapper_center td_15p">伝票日付</td>
                <td class="grid_wrapper_center td_15p">得意先コード</td>
                <td class="grid_wrapper_center td_20p">得意先略称</td>
                <td class="grid_wrapper_center td_15p">伝票合計<br/>受注数量</td>
                <td class="grid_wrapper_center td_20p">オーダーNo.</td>
                <td class="grid_wrapper_center td_20p">EC注文番号</td>
            </tr>
            </thead>
            <tbody class="tbody_scroll">
            @foreach ($orderReceiveHeaderData as $data)
            <tr data-smm-dbclick="{{ $data->order_receive_number }}">
                <td class="grid_wrapper_left">{{ $data['order_receive_number'] }}</td>
                <td class="grid_wrapper_left">{{ $data['order_receive_date'] }}</td>
                <td class="grid_wrapper_left">{{ $data['customer_cd'] }}</td>
                <td class="grid_wrapper_left">{{ $data['customer_name'] }}</td>
                <td class="grid_wrapper_left">{{ $data['quantity_total'] }}</td>
                <td class="grid_wrapper_left">{{ $data['order_number'] }}</td>
                <td class="grid_wrapper_left">{{ $data['ec_order_receive_number'] }}</td>
            </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>
