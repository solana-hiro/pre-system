<div data-lw="master-search.bank">
    <div class="button_area">
        <button class="button" type="button" wire:click="search">
            <div class="button-text_wrapper">実行する</div>
        </button>
    </div>
    <div class="element-form-rows">
        <div class="element-form">
            <div class="text_wrapper">銀行コード</div>
            <div class="frame">
                <div class="textbox">
                    <input type="number" name="bank_cd" id="bank_cd" class="element input_number_4" data-pad-code="4"
                        data-limit-len="4" data-limit-minus data-lwo="bankCd" wire:model="bankCd">
                </div>
            </div>
        </div>
        <div class="element-form">
            <div class="text_wrapper">銀行名(部分)</div>
            <div class="frame">
                <div class="textbox">
                    <input type="text" name="bank_name" id="bank_name" class="element" minlength="0" maxlength="20"
                        size="10" wire:model="bankName">
                </div>
            </div>
        </div>
    </div>
    @include('livewire.master_search.paginate_button', ['list' => $bankData])
    <div class="grid">
        <table class="table_sticky">
            <thead class="grid_header">
                <tr>
                    <td class="grid_wrapper_center td_5p">銀行コード</td>
                    <td class="grid_wrapper_center td_10p">銀行名</td>
                </tr>
            </thead>
            <tbody class="tbody_scroll" id="bank_rec">
                @foreach ($bankData as $data)
                    <tr data-smm-dbclick="{{ $data->bank_cd }}">
                        <td class="grid_wrapper_left">{{ $data['bank_cd'] }}</td>
                        <td class="grid_wrapper_left">{{ $data['bank_name'] }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
