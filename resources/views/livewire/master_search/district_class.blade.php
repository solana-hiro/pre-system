<div data-lw="master-search.district-class">
    <div class="button_area">
        <button class="button" type="button" wire:click="search">
            <div class="button-text_wrapper">実行する</div>
        </button>
    </div>
    <div class="element-form-rows">
        <div class="element-form">
            <div class="text_wrapper">地区分類コード</div>
            <div class="frame">
                <div class="textbox">
                    <input type="number" name="district_class_cd" id="district_class_cd" class="element input_number_4"
                        data-pad-code="4" data-limit-len="4" data-limit-minus data-lwo="code" wire:model="code">
                </div>
            </div>
        </div>
        <div class="element-form">
            <div class="text_wrapper">地区分類名(部分)</div>
            <div class="frame">
                <div class="textbox">
                    <input type="text" name="district_class_name" id="district_class_name" class="element"
                        minlength="0" maxlength="20" size="10" wire:model="name">
                </div>
            </div>
        </div>
    </div>
    @include('livewire.master_search.paginate_button', ['list' => $districtClassData])
    <div class="grid">
        <table class="table_sticky">
            <thead class="grid_header">
                <tr>
                    <td class="grid_wrapper_center td_5p">地区分類コード</td>
                    <td class="grid_wrapper_center td_15p">地区分類名</td>
                </tr>
            </thead>
            <tbody class="tbody_scroll" id="district_class_rec">
                @foreach ($districtClassData as $data)
                    <tr data-smm-dbclick="{{ $data->district_class_cd }}">
                        <td class="grid_wrapper_left">{{ $data['district_class_cd'] }}</td>
                        <td class="grid_wrapper_left">{{ $data['district_class_name'] }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
