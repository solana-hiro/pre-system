<div data-lw="master-search.slip-kind">
    <div class="button_area">
        <button class="button" type="button" wire:click="search">
            <div class="button-text_wrapper">実行する</div>
        </button>
    </div>
    <div class="element-form-rows">
        <div class="element-form">
            <div class="text_wrapper">伝票種別</div>
            <div class="frame">
                <div class="textbox">
                    <input type="number" name="slip_kind_cd" id="slip_kind_cd" class="element input_number_3"
                        data-pad-code="3" data-limit-len="3" data-limit-minus data-lwo="slipKindCd"
                        wire:model="slipKindCd">
                </div>
            </div>
        </div>
    </div>
    @include('livewire.master_search.paginate_button', ['list' => $slipKindData])
    <div class="grid">
        <table class="table_sticky">
            <thead class="grid_header">
                <tr>
                    <td class="grid_wrapper_center td_5p">伝票種別</td>
                    <td class="grid_wrapper_center td_10p">伝票名</td>
                    <td class="grid_wrapper_center td_5p">伝票桁数</td>
                </tr>
            </thead>
            <tbody class="tbody_scroll" id="slip_kind_rec">
                @foreach ($slipKindData as $data)
                    <tr data-smm-dbclick="{{ $data->slip_kind_cd }}">
                        <td class="grid_wrapper_left">{{ $data['slip_kind_cd'] }}</td>
                        <td class="grid_wrapper_left">{{ $data['slip_kind_name'] }}</td>
                        <td class="grid_wrapper_left">{{ $data['slip_row'] }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
