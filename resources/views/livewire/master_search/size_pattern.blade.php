<div data-lw="master-search.size-pattern">
    <div class="button_area">
        <button class="button" type="button" wire:click="search">
            <div class="button-text_wrapper">実行する</div>
        </button>
    </div>
    <div class="element-form-rows">
        <div class="element-form">
            <div class="text_wrapper">サイズパターンコード</div>
            <div class="frame">
                <div class="textbox">
                    <input type="number" name="size_pattern_cd" id="size_pattern_cd" class="element input_number_4"
                        data-pad-code="4" data-limit-len="4" data-limit-minus data-lwo="sizePatternCd"
                        wire:model="sizePatternCd">
                </div>
            </div>
        </div>
    </div>
    @include('livewire.master_search.paginate_button', ['list' => $sizePatternData])
    <div class="grid">
        <table class="table_sticky">
            <thead class="grid_header">
                <tr>
                    <td class="grid_wrapper_center td_10p">サイズパターン</td>
                    <td class="grid_wrapper_center td_5p">サイズ名1</td>
                    <td class="grid_wrapper_center td_5p">サイズ名2</td>
                    <td class="grid_wrapper_center td_5p">サイズ名3</td>
                    <td class="grid_wrapper_center td_5p">サイズ名4</td>
                    <td class="grid_wrapper_center td_5p">サイズ名5</td>
                    <td class="grid_wrapper_center td_5p">サイズ名6</td>
                    <td class="grid_wrapper_center td_5p">サイズ名7</td>
                    <td class="grid_wrapper_center td_5p">サイズ名8</td>
                    <td class="grid_wrapper_center td_5p">サイズ名9</td>
                    <td class="grid_wrapper_center td_5p">サイズ名10</td>
                </tr>
            </thead>
            <tbody class="tbody_scroll" id="size_pattern_rec">
                @foreach ($sizePatternData as $data)
                    <tr data-smm-dbclick="{{ $data->size_pattern_cd }}">
                        <td class="grid_wrapper_left">{{ $data['size_pattern_cd'] }}</td>
                        <td class="grid_wrapper_left">{{ $data['size_name1'] }}</td>
                        <td class="grid_wrapper_left">{{ $data['size_name2'] }}</td>
                        <td class="grid_wrapper_left">{{ $data['size_name3'] }}</td>
                        <td class="grid_wrapper_left">{{ $data['size_name4'] }}</td>
                        <td class="grid_wrapper_left">{{ $data['size_name5'] }}</td>
                        <td class="grid_wrapper_left">{{ $data['size_name6'] }}</td>
                        <td class="grid_wrapper_left">{{ $data['size_name7'] }}</td>
                        <td class="grid_wrapper_left">{{ $data['size_name8'] }}</td>
                        <td class="grid_wrapper_left">{{ $data['size_name9'] }}</td>
                        <td class="grid_wrapper_left">{{ $data['size_name10'] }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
<script>
    const search_size_pattern_cd = document.getElementById("size_pattern_cd");
    search_size_pattern_cd.onblur = function() {
        if ("" !== search_size_pattern_cd.value) {
            search_size_pattern_cd.value = search_size_pattern_cd.value.toString().padStart(4, '0');
            const component = Livewire.getByName("master-search.size-pattern")[0];
            if (component) {
                component.set('sizePatternCd', String(search_size_pattern_cd.value), false);
            }
        }
    };
</script>
