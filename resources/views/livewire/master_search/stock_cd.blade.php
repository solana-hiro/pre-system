<div>
    <div class="button_area">
        <button class="button" type="button" id="">
            <div class="button-text_wrapper" wire:click="search">実行する</div>
        </button>
    </div>
    <div class="element-form-rows">
        <div class="element-form">
            <div class="text_wrapper">入出庫伝票No.</div>
            <div class="frame">
                <div class="textbox">
                    <input type="number" name="inOutCd" id="inOutCd" class="element input_number_6" data-pad-code="8"
                        data-limit-len="8" data-limit-minus data-lwo="inOutC0de" wire:model="inOutCode">
                </div>
            </div>
        </div>
        <div class="element-form">
            <div class="text_wrapper">商品コード</div>
            <div class="frame">
                <div class="textbox">
                    <input type="text" name="itemCode" id="itemCode" class="element" minlength="0" maxlength="8"
                        size="8" wire:model="itemCode">
                </div>
            </div>
        </div>
    </div>
    @include('livewire.master_search.paginate_button', ['list' => $inoutData])
    <div class="grid">
        <table class="table_sticky">
            <thead class="grid_header">
                <tr>
                    <td class="grid_wrapper_center td_5p">伝票No.</td>
                    <td class="grid_wrapper_center td_5p">伝票日付</td>
                    <td class="grid_wrapper_center td_5p">商品コード</td>
                    <td class="grid_wrapper_center td_5p">商品名</td>
                    <td class="grid_wrapper_center td_5p">入出庫数量</td>
                </tr>
            </thead>
            <tbody class="tbody_scroll" id="item_cd_rec">
                @foreach ($inoutData as $data)
                    @foreach ($data->trnInOutDetails as $item)
                        {{-- @php
                            dd($data->trnInOutDetails);
                        @endphp --}}
                        <tr data-smm-dbclick="{{ $data->in_out_number }}">
                            <td class="grid_wrapper_left">{{ $data['in_out_number'] }}</td>
                            <td class="grid_wrapper_left">{{ $data['slip_date'] }}</td>
                            <td class="grid_wrapper_left">{{ $item->mtItem['item_cd'] }}</td>
                            <td class="grid_wrapper_left">{{ $item->mtItem['item_name'] }}</td>
                            <td class="grid_wrapper_left">{{ $item['total_quantity'] }}</td>
                        </tr>
                    @endforeach
                @endforeach
            </tbody>
        </table>
    </div>
</div>
