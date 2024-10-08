<div>
    <div class="button_area">
        <button class="button" type="button" id="" wire:click="search">
            <div class="button-text_wrapper">実行する</div>
        </button>
    </div>
    <div class="element-form-rows">
        <div class="element-form">
            <div class="text_wrapper">カラーコード</div>
            <div class="frame">
                <div class="textbox">
                    <input type="text" name="color_cd" id="color_cd" class="element" minlength="0" maxlength="6"
                        size="4" wire:model="colorCd">
                </div>
            </div>
        </div>
        <div class="element-form">
            <div class="text_wrapper">カラー名(部分)</div>
            <div class="frame">
                <div class="textbox">
                    <input type="text" name="color_name" id="color_name" class="element" minlength="0"
                        maxlength="10" size="10" wire:model="colorName">
                </div>
            </div>
        </div>
    </div>
    @include('livewire.master_search.paginate_button', ['list' => $colorData])
    <div class="grid">
        <table class="table_sticky">
            <thead class="grid_header">
                <tr>
                    <td class="grid_wrapper_center td_5p">カラーコード</td>
                    <td class="grid_wrapper_center td_10p">カラー名</td>
                </tr>
            </thead>
            <tbody class="tbody_scroll" id="color_rec">
                @foreach ($colorData as $data)
                    <tr data-smm-dbclick="{{ $data->color_cd }}">
                        <td class="grid_wrapper_left">{{ $data['color_cd'] }}</td>
                        <td class="grid_wrapper_left">{{ $data['color_name'] }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
