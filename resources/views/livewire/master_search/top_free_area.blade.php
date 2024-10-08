<div data-lw="master-search.top-free-area">
    <div class="button_area">
        <button class="button" type="button" wire:click="search">
            <div class="button-text_wrapper">実行する</div>
        </button>
    </div>
    <div class="element-form-rows">
        <div class="element-form">
            <div class="text_wrapper">コード</div>
            <div class="frame">
                <div class="textbox">
                    <input type="number" id="area_cd" name="area_cd" class="element input_number_4" data-pad-code="4"
                        data-limit-len="4" data-limit-minus data-lwo="areaCd" wire:model="areaCd">
                </div>
            </div>
        </div>
        <div class="element-form">
            <div class="text_wrapper">タイトル(部分)</div>
            <div class="frame">
                <div class="textbox">
                    <input type="text" id="area_title" name="area_title" class="element" minlength="0"
                        maxlength="20" size="20" wire:model="areaTitle">
                </div>
            </div>
        </div>
    </div>
    @include('livewire.master_search.paginate_button', ['list' => $topFreeAreaData])
    <div class="grid">
        <table class="table_sticky">
            <thead class="grid_header">
                <tr>
                    <td class="grid_wrapper_center td_5p">コード</td>
                    <td class="grid_wrapper_center td_10p">設定位置</td>
                    <td class="grid_wrapper_center td_10p">タイトル</td>
                    <td class="grid_wrapper_center td_10p">公開開始日時</td>
                    <td class="grid_wrapper_center td_10p">表示</td>
                    <td class="grid_wrapper_center td_10p">表示順</td>
                </tr>
            </thead>
            <tbody class="tbody_scroll" id="top_free_area_rec">
                @foreach ($topFreeAreaData as $data)
                    <tr data-smm-dbclick="{{ $data->area_cd }}">
                        <td class="grid_wrapper_left">{{ $data['area_cd'] }}</td>
                        <td class="grid_wrapper_left">{{ $data['setting_position'] }}</td>
                        <td class="grid_wrapper_left">{{ $data['area_title'] }}</td>
                        <td class="grid_wrapper_left">{{ $data['release_start_datetime'] }}</td>
                        <td class="grid_wrapper_left">{{ $data['display_flg'] }}</td>
                        <td class="grid_wrapper_left">{{ $data['display_sort_order'] }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
