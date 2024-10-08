<div>
    <div class="button_area">
        <button class="button" type="button" id="" wire:click="search">
            <div class="button-text_wrapper">実行する</div>
        </button>
    </div>
    <div class="element-form-rows">
        <div class="element-form">
            <div class="text_wrapper">サイズコード</div>
            <div class="frame">
                <div class="textbox">
                    <input type="text" name="size_cd" id="size_cd" class="element" minlength="0" maxlength="6"
                        size="4" wire:model="sizeCd">
                </div>
            </div>
        </div>
        <div class="element-form">
            <div class="text_wrapper">サイズ名(部分)</div>
            <div class="frame">
                <div class="textbox">
                    <input type="text" name="size_name" id="size_name" class="element" minlength="0" maxlength="10"
                        size="10" wire:model="sizeName">
                </div>
            </div>
        </div>
    </div>
    @include('livewire.master_search.paginate_button', ['list' => $sizeData])
    <div class="grid">
        <table class="table_sticky">
            <thead class="grid_header">
                <tr>
                    <td class="grid_wrapper_center td_5p">サイズコード</td>
                    <td class="grid_wrapper_center td_10p">サイズ名</td>
                </tr>
            </thead>
            <tbody class="tbody_scroll" id="size_rec">
                @foreach ($sizeData as $data)
                    <tr data-smm-dbclick="{{ $data->size_cd }}">
                        <td class="grid_wrapper_left">{{ $data['size_cd'] }}</td>
                        <td class="grid_wrapper_left">{{ $data['size_name'] }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
