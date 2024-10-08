<div data-lw="master-search.pioneer">
    <div class="button_area">
        <button class="button" type="button" wire:click="search">
            <div class="button-text_wrapper">実行する</div>
        </button>
    </div>
    <div class="element-form-rows">
        <div class="element-form">
            <div class="text_wrapper">開拓年分類コード</div>
            <div class="frame">
                <div class="textbox">
                    <input type="number" name="pioneer_year_cd" id="pioneer_year_cd" class="element input_number_4"
                        data-pad-code="4" data-limit-len="4" data-limit-minus data-lwo="pioneerYearCd"
                        wire:model="pioneerYearCd">
                </div>
            </div>
        </div>
        <div class="element-form">
            <div class="text_wrapper">開拓年分類名(部分)</div>
            <div class="frame">
                <div class="textbox">
                    <input type="text" name="pioneer_year_name" id="pioneer_year_name" class="element" minlength="0"
                        maxlength="20" size="10" wire:model="pioneerYearName">
                </div>
            </div>
        </div>
    </div>
    @include('livewire.master_search.paginate_button', ['list' => $pioneerData])
    <div class="grid">
        <table class="table_sticky">
            <thead class="grid_header">
                <tr>
                    <td class="grid_wrapper_center td_5p">開拓年分類コード</td>
                    <td class="grid_wrapper_center td_10p">開拓年分類名</td>
                </tr>
            </thead>
            <tbody class="tbody_scroll" id="pioneer_rec">
                @foreach ($pioneerData as $data)
                    <tr data-smm-dbclick="{{ $data->pioneer_year_cd }}">
                        <td class="grid_wrapper_left">{{ $data['pioneer_year_cd'] }}</td>
                        <td class="grid_wrapper_left">{{ $data['pioneer_year_name'] }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
