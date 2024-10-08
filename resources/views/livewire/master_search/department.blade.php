<div data-lw="master-search.department">
    <div class="button_area">
        <button class="button" type="button" id="execute_search_department" wire:click="search">
            <div class="button-text_wrapper">実行する</div>
        </button>
    </div>
    <div class="element-form-rows">
        <div class="element-form">
            <div class="text_wrapper">部門コード</div>
            <div class="frame">
                <div class="textbox">
                    <input type="number" name="department_cd" id="department_cd" class="element input_number_4"
                        data-pad-code="4" data-limit-len="4" data-limit-minus data-lwo="departmentCd"
                        wire:model="departmentCd">
                </div>
            </div>
        </div>
        <div class="element-form">
            <div class="text_wrapper">部門名(部分)</div>
            <div class="frame">
                <div class="textbox">
                    <input type="text" name="department_name" id="department_name" class="element" minlength="0"
                        maxlength="20" size="10" wire:model="departmentName">
                </div>
            </div>
        </div>
    </div>
    @include('livewire.master_search.paginate_button', ['list' => $departmentData])
    <div class="grid">
        <table class="table_sticky">
            <thead class="grid_header">
                <tr>
                    <td class="grid_wrapper_center td_5p">部門コード</td>
                    <td class="grid_wrapper_center td_10p">部門名</td>
                </tr>
            </thead>
            <tbody class="tbody_scroll" id="department_rec">
                @foreach ($departmentData as $data)
                    <tr data-smm-dbclick="{{ $data->department_cd }}">
                        <td class="grid_wrapper_left">{{ $data['department_cd'] }}</td>
                        <td class="grid_wrapper_left">{{ $data['department_name'] }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
