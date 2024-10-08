<div data-lw="master-search.notice">
    <div class="button_area">
        <button class="button" type="button" wire:click="search">
            <div class="button-text_wrapper">実行する</div>
        </button>
    </div>
    <div class="element-form-rows">
        <div class="element-form">
            <div class="text_wrapper">お知らせコード</div>
            <div class="frame">
                <div class="textbox">
                    <input type="number" id="notice_cd" name="notice_cd" class="element input_number_4"
                        data-pad-code="4" data-limit-len="4" data-limit-minus data-lwo="noticeCd" wire:model="noticeCd">
                </div>
            </div>
        </div>
        <div class="element-form">
            <div class="text_wrapper">タイトル(部分)</div>
            <div class="frame">
                <div class="textbox">
                    <input type="text" id="title" name="title" class="element" minlength="0" maxlength="100"
                        size="20" wire:model="title">
                </div>
            </div>
        </div>
    </div>
    <div class="element-form element-form-rows">
        <div class="text_wrapper">表示フラグ</div>
        <div class="frame">
            <div class="div">
                <label class="text_wrapper_2">
                    <input type="radio" name="wire_display_flg" value="" wire:model="displayFlg" />
                    条件なし
                </label>
            </div>
            <div class="div">
                <label class="text_wrapper_2">
                    <input type="radio" name="wire_display_flg" value="0" wire:model="displayFlg" />
                    表示
                </label>
            </div>
            <div class="div">
                <label class="text_wrapper_2">
                    <input type="radio" name="wire_display_flg" value="1" wire:model="displayFlg" />
                    非表示
                </label>
            </div>
        </div>
    </div><br>
    <div class="element-form element-form-rows">
        <div class="text_wrapper">ニュース種別</div>
        <div class="frame">
            <div class="div">
                <label class="text_wrapper_2">
                    <input type="radio" name="wire_news_kind" value="" wire:model="newsKind" />
                    条件なし
                </label>
            </div>
            <div class="div">
                <label class="text_wrapper_2">
                    <input type="radio" name="wire_news_kind" value="0" wire:model="newsKind" />
                    通常のお知らせ
                </label>
            </div>
            <div class="div">
                <label class="text_wrapper_2">
                    <input type="radio" name="wire_news_kind" value="1" wire:model="newsKind" />
                    キャンペーン
                </label>
            </div>
        </div>
    </div><br>

    @include('livewire.master_search.paginate_button', ['list' => $noticeData])
    <div class="grid">
        <table class="table_sticky">
            <thead class="grid_header">
                <tr>
                    <td class="grid_wrapper_center td_5p">お知らせコード</td>
                    <td class="grid_wrapper_center td_10p">タイトル</td>
                    <td class="grid_wrapper_center td_10p">公開開始日時</td>
                    <td class="grid_wrapper_center td_10p">公開終了日時</td>
                    <td class="grid_wrapper_center td_10p">表示</td>
                    <td class="grid_wrapper_center td_10p">表示順</td>
                </tr>
            </thead>
            <tbody class="tbody_scroll" id="notice_rec">
                @foreach ($noticeData as $data)
                    <tr data-smm-dbclick="{{ $data->notice_cd }}">
                        <td class="grid_wrapper_left">{{ $data['notice_cd'] }}</td>
                        <td class="grid_wrapper_left">{{ $data['title'] }}</td>
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
</div>
