<div data-lw="master-search.shipping-company">
    <div class="button_area">
        <button class="button" type="button" wire:click="search">
            <div class="button-text_wrapper">実行する</div>
        </button>
    </div>
    <div class="element-form-rows">
        <div class="element-form">
            <div class="text_wrapper">運送会社コード</div>
            <div class="frame">
                <div class="textbox">
                    <input type="number" name="shipping_company_cd" id="shipping_company_cd"
                        class="element input_number_4" data-pad-code="4" data-limit-len="4" data-limit-minus
                        data-lwo="shippingCompanyCd" wire:model="shippingCompanyCd">
                </div>
            </div>
        </div>
        <div class="element-form">
            <div class="text_wrapper">運送会社名(部分)</div>
            <div class="frame">
                <div class="textbox">
                    <input type="text" name="shipping_company_name" id="shipping_company_name" class="element"
                        minlength="0" maxlength="20" size="10" wire:model="shippingCompanyName">
                </div>
            </div>
        </div>
    </div>
    @include('livewire.master_search.paginate_button', ['list' => $shippingCompanyData])
    <div class="grid">
        <table class="table_sticky">
            <thead class="grid_header">
                <tr>
                    <td class="grid_wrapper_center td_5p">運送会社コード</td>
                    <td class="grid_wrapper_center td_10p">運送会社名</td>
                </tr>
            </thead>
            <tbody class="tbody_scroll" id="shipping_company_rec">
                @foreach ($shippingCompanyData as $data)
                    <tr data-smm-dbclick="{{ $data->shipping_company_cd }}">
                        <td class="grid_wrapper_left">{{ $data['shipping_company_cd'] }}</td>
                        <td class="grid_wrapper_left">{{ $data['shipping_company_name'] }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
