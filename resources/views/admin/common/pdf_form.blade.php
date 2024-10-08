<div class="element-form-columns">
    <div class="element-form-rows">
        <!-- <img src="{{ $path ?? '' }}" class="img_preview" data-image-preview="{{ $name }}"
            @if (empty($path)) style="display: none" @endif> -->
        <input type="hidden" name="{{ $name }}_src" value="{{ $data ?? '' }}"
            data-image-src="{{ $name }}">
    </div>
    <div class="element-form element-form-columns">
        <input type="file" name="{{ $name }}" class="display_none_all" accept=".pdf" data-input-image>
        <button type="button" class="file_select_button" data-select-image="{{ $name }}">ファイルを選択</button>
        <div  name="{{ $name }}_img_name" class="img_name" data-image-name="{{ $name }}">
            {{ isset($data) ? pathinfo($data, PATHINFO_BASENAME) : null }}
        </div>
        <span class="a_link cursor-pointer" data-delete-image="{{ $name }}">削除</span>
    </div>
</div>