<div data-lw="master-search.color-pattern">
    <div class="button_area">
        <button class="button" type="button" wire:click="search">
            <div class="button-text_wrapper">実行する</div>
        </button>
    </div>
    <div class="element-form-rows">
        <div class="element-form">
            <div class="text_wrapper">カラーパターンコード</div>
            <div class="frame">
                <div class="textbox">
                    <input type="number" name="color_pattern_cd" id="color_pattern_cd" class="element input_number_4"
                        data-pad-code="4" data-limit-len="4" data-limit-minus data-lwo="colorPatternCd"
                        wire:model="colorPatternCd">
                </div>
            </div>
        </div>
    </div>
    @include('livewire.master_search.paginate_button', ['list' => $colorPatternData])
    <div class="grid">
        <table class="table_sticky">
            <thead class="grid_header">
                <tr>
                    <td class="grid_wrapper_center td_10p">カラーパターン</td>
                    <td class="grid_wrapper_center td_5p">カラー名1</td>
                    <td class="grid_wrapper_center td_5p">カラー名2</td>
                    <td class="grid_wrapper_center td_5p">カラー名3</td>
                    <td class="grid_wrapper_center td_5p">カラー名4</td>
                    <td class="grid_wrapper_center td_5p">カラー名5</td>
                    <td class="grid_wrapper_center td_5p">カラー名6</td>
                    <td class="grid_wrapper_center td_5p">カラー名7</td>
                    <td class="grid_wrapper_center td_5p">カラー名8</td>
                    <td class="grid_wrapper_center td_5p">カラー名9</td>
                    <td class="grid_wrapper_center td_5p">カラー名10</td>
                    <td class="grid_wrapper_center td_5p">カラー名11</td>
                    <td class="grid_wrapper_center td_5p">カラー名12</td>
                    <td class="grid_wrapper_center td_5p">カラー名13</td>
                    <td class="grid_wrapper_center td_5p">カラー名14</td>
                    <td class="grid_wrapper_center td_5p">カラー名15</td>
                    <td class="grid_wrapper_center td_5p">カラー名16</td>
                    <td class="grid_wrapper_center td_5p">カラー名17</td>
                    <td class="grid_wrapper_center td_5p">カラー名18</td>
                    <td class="grid_wrapper_center td_5p">カラー名19</td>
                    <td class="grid_wrapper_center td_5p">カラー名20</td>
                </tr>
            </thead>
            <tbody class="tbody_scroll" id="color_pattern_rec">
                @foreach ($colorPatternData as $data)
                    <tr data-smm-dbclick="{{ $data->color_pattern_cd }}">
                        <td class="grid_wrapper_left">{{ $data['color_pattern_cd'] }}</td>
                        <td class="grid_wrapper_left">{{ $data['color_name1'] }}</td>
                        <td class="grid_wrapper_left">{{ $data['color_name2'] }}</td>
                        <td class="grid_wrapper_left">{{ $data['color_name3'] }}</td>
                        <td class="grid_wrapper_left">{{ $data['color_name4'] }}</td>
                        <td class="grid_wrapper_left">{{ $data['color_name5'] }}</td>
                        <td class="grid_wrapper_left">{{ $data['color_name6'] }}</td>
                        <td class="grid_wrapper_left">{{ $data['color_name7'] }}</td>
                        <td class="grid_wrapper_left">{{ $data['color_name8'] }}</td>
                        <td class="grid_wrapper_left">{{ $data['color_name9'] }}</td>
                        <td class="grid_wrapper_left">{{ $data['color_name10'] }}</td>
                        <td class="grid_wrapper_left">{{ $data['color_name11'] }}</td>
                        <td class="grid_wrapper_left">{{ $data['color_name12'] }}</td>
                        <td class="grid_wrapper_left">{{ $data['color_name13'] }}</td>
                        <td class="grid_wrapper_left">{{ $data['color_name14'] }}</td>
                        <td class="grid_wrapper_left">{{ $data['color_name15'] }}</td>
                        <td class="grid_wrapper_left">{{ $data['color_name16'] }}</td>
                        <td class="grid_wrapper_left">{{ $data['color_name17'] }}</td>
                        <td class="grid_wrapper_left">{{ $data['color_name18'] }}</td>
                        <td class="grid_wrapper_left">{{ $data['color_name19'] }}</td>
                        <td class="grid_wrapper_left">{{ $data['color_name20'] }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
