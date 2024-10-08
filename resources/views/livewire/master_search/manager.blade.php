<div data-lw="master-search.manager">
    <div class="button_area">
        <button class="button" type="button" id="execute_search_manager" wire:click="search">
            <div class="button-text_wrapper">実行する</div>
        </button>
    </div>
    <div class="element-form-rows">
        <div class="element-form">
            <div class="text_wrapper">担当者コード</div>
            <div class="frame">
                <div class="textbox">
                    <input type="number" name="manager_cd" id="manager_cd" class="element input_number_4"
                        data-pad-code="4" data-limit-len="4" data-limit-minus data-lwo="managerCd"
                        wire:model="managerCd">
                </div>
            </div>
        </div>
        <div class="element-form">
            <div class="text_wrapper">名カナ</div>
            <div class="frame">
                <div class="textbox">
                    <input type="text" name="manager_name_kana" id="manager_name_kana" class="element" minlength="0"
                        maxlength="20" size="10" wire:model="managerNameKana">
                </div>
            </div>
        </div>
    </div>
    @include('livewire.master_search.paginate_button', ['list' => $managerData])
    <div class="grid">
        <table class="table_sticky">
            <thead class="grid_header">
                <tr>
                    <td class="grid_wrapper_center td_5p">担当者コード</td>
                    <td class="grid_wrapper_center td_15p">担当者名</td>
                    <td class="grid_wrapper_center td_10p">名カナ</td>
                </tr>
            </thead>
            <tbody class="tbody_scroll" id="manager_rec">
                @foreach ($managerData as $data)
                    <tr data-smm-dbclick="{{ $data->user_cd }}">
                        <td class="grid_wrapper_left">{{ $data['user_cd'] }}</td>
                        <td class="grid_wrapper_left">{{ $data['user_name'] }}</td>
                        <td class="grid_wrapper_left">{{ $data['user_name_kana'] }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
