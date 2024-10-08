<div data-lw="master-search.arrival-date">
    <div class="button_area">
        <button class="button" type="button" wire:click="search">
            <div class="button-text_wrapper">実行する</div>
        </button>
    </div>
    <div class="element-form-rows">
        <div class="element-form element-form-columns">
            <div class="text_wrapper">着日コード</div>
            <div class="frame">
                <div class="textbox">
                    <input type="number" name="arrival_date_cd" id="arrival_date_cd" class="element input_number_4"
                        data-pad-code="4" data-limit-len="4" data-limit-minus data-lwo="arrivalDateCd"
                        wire:model="arrivalDateCd">
                </div>
            </div>
        </div>
        <div class="element-form element-form-columns">
            <div class="text_wrapper">着日名(部分)</div>
            <div class="frame">
                <div class="textbox">
                    <input type="text" name="arrival_date_name" id="arrival_date_name" class="element" minlength="0"
                        maxlength="20" size="20" wire:model="arrivalDateName">
                </div>
            </div>
        </div>
    </div>
    @include('livewire.master_search.paginate_button', ['list' => $arrivalDateData])
    <div class="grid">
        <table class="table_sticky">
            <thead class="grid_header">
                <tr>
                    <td class="grid_wrapper_center td_5p">着日コード</td>
                    <td class="grid_wrapper_center td_10p">着日名</td>
                </tr>
            </thead>
            <tbody class="tbody_scroll" id="arrival_date_rec">
                @foreach ($arrivalDateData as $data)
                    <tr data-smm-dbclick="{{ $data->arrival_date_cd }}">
                        <td class="grid_wrapper_left">{{ $data['arrival_date_cd'] }}</td>
                        <td class="grid_wrapper_left">{{ $data['arrival_date_name'] }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
