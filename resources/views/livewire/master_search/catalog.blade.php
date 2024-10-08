<div data-lw="master-search.catalog">
    <div class="button_area">
        <button class="button" type="button" wire:click="search">
            <div class="button-text_wrapper">実行する</div>
        </button>
    </div>
    <div class="element-form-rows">
        <div class="element-form">
            <div class="text_wrapper">カタログコード</div>
            <div class="frame">
                <div class="textbox">
                    <input type="number" id="catalog_cd" name="catalog_cd" class="element input_number_4"
                        data-pad-code="4" data-limit-len="4" data-limit-minus data-lwo="catalogCd"
                        wire:model="catalogCd">
                </div>
            </div>
        </div>
        <div class="element-form">
            <div class="text_wrapper">カタログ名(部分)</div>
            <div class="frame">
                <div class="textbox">
                    <input type="text" id="catalog_name" name="catalog_name" class="element" minlength="0"
                        maxlength="20" size="20" wire:model="catalogName">
                </div>
            </div>
        </div>
    </div>
    @include('livewire.master_search.paginate_button', ['list' => $catalogData])
    <div class="grid">
        <table class="table_sticky">
            <thead class="grid_header">
                <tr>
                    <td class="grid_wrapper_center td_5p">カタログコード</td>
                    <td class="grid_wrapper_center td_10p">カタログ名</td>
                    <td class="grid_wrapper_center td_10p">公開開始日時</td>
                    <td class="grid_wrapper_center td_10p">公開終了日時</td>
                    <td class="grid_wrapper_center td_10p">表示</td>
                    <td class="grid_wrapper_center td_10p">表示順</td>
                </tr>
            </thead>
            <tbody class="tbody_scroll" id="catalog_rec">
                @foreach ($catalogData as $data)
                    <tr data-smm-dbclick="{{ $data->catalog_cd }}">
                        <td class="grid_wrapper_left">{{ $data['catalog_cd'] }}</td>
                        <td class="grid_wrapper_left">{{ $data['catalog_name'] }}</td>
                        <td class="grid_wrapper_left">{{ $data['release_start_datetime'] }}</td>
                        <td class="grid_wrapper_left">{{ $data['release_end_datetime'] }}</td>
                        <td class="grid_wrapper_left">{{ $data['display_flg'] }}</td>
                        <td class="grid_wrapper_left">{{ $data['display_sort_order'] }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
