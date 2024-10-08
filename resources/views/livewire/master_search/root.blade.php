<div data-lw="master-search.root">
    <div class="button_area">
        <button class="button" type="button" wire:click="search">
            <div class="button-text_wrapper">実行する</div>
        </button>
    </div>
    <div class="element-form-rows">
        <div class="element-form element-form-columns">
            <div class="text_wrapper">ルートコード</div>
            <div class="frame">
                <div class="textbox">
                    <input type="number" name="root_cd" id="root_cd" class="element input_number_4" data-pad-code="4"
                        data-limit-len="4" data-limit-minus data-lwo="rootCd" wire:model="rootCd">
                </div>
            </div>
        </div>
        <div class="element-form element-form-columns">
            <div class="text_wrapper">ルート名(部分)</div>
            <div class="frame">
                <div class="textbox">
                    <input type="text" name="root_name" id="root_name" class="element" minlength="0" maxlength="20"
                        size="20" wire:model="rootName">
                </div>
            </div>
        </div>
    </div>
    @include('livewire.master_search.paginate_button', ['list' => $rootData])
    <div class="grid">
        <table class="table_sticky">
            <thead class="grid_header">
                <tr>
                    <td class="grid_wrapper_center td_5p">ルートコード</td>
                    <td class="grid_wrapper_center td_10p">ルート名</td>
                </tr>
            </thead>
            <tbody class="tbody_scroll" id="root_rec">
                @foreach ($rootData as $data)
                    <tr data-smm-dbclick="{{ $data->root_cd }}">
                        <td class="grid_wrapper_left">{{ $data['root_cd'] }}</td>
                        <td class="grid_wrapper_left">{{ $data['root_name'] }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
<script>
    const search_root_cd = document.getElementById("root_cd");
    search_root_cd.onblur = function() {
        if ("" !== search_root_cd.value) {
            search_root_cd.value = search_root_cd.value.toString().padStart(4, '0');
            const component = Livewire.getByName("master-search.root")[0];
            if (component) {
                component.set('rootCd', String(search_root_cd.value), false);
            }
        }
    };
</script>
