<div>
    <div class="button_area">
        <button class="button" type="button" id="execute_search_ps_kbn" wire:click="search">
            <div class="button-text_wrapper">実行する</div>
        </button>
    </div>
    <div class="element-form-rows">
        <div class="element-form">
            <div class="text_wrapper">PS区分コード</div>
            <div class="frame">
                <div class="textbox">
                    <input type="text" id="ps_kbn_cd" name="ps_kbn_cd" class="element" minlength="0" maxlength="1"
                        size="1" wire:model="psKbnCd">
                </div>
            </div>
        </div>
    </div>
    @include('livewire.master_search.paginate_button', ['list' => $psKbnData])
    <div class="grid" id="grid_ps_kbn">
        <table class="table_sticky">
            <thead class="grid_header">
                <tr>
                    <td class="sort grid_wrapper_center td_5p" data-sort="kbn">PS区分コード</td>
                    <td class="sort grid_wrapper_center td_10p" data-sort="name">PS区分名</td>
                </tr>
            </thead>
            <tbody class="list tbody_scroll" id="ps_kbn_rec">
                @foreach ($psKbnData as $data)
                    <tr data-smm-dbclick="{{ $data->ps_kbn_cd }}">
                        <td class="kbn">{{ $data['ps_kbn_cd'] }}</td>
                        <td class="name">{{ $data['ps_kbn_name'] }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
