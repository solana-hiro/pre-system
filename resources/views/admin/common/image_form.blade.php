<div class="element-form-rows">
    <img src="{{ $path ?? '' }}" class="img_preview" data-image-preview="{{ $name }}"
        @if (empty($path)) style="display: none" @endif>
    <input type="hidden" name="{{ $name }}_src" value="{{ $data['image_file'] ?? '' }}"
        data-image-src="{{ $name }}">
</div>
<div class="element-form element-form-columns">
    <input type="file" name="{{ $name }}" class="display_none_all" accept="image/*" data-input-image>
    <button type="button" data-select-image="{{ $name }}">ファイルを選択</button>
    <span class="img_name" data-image-name="{{ $name }}">
        {{ isset($data) ? pathinfo($data['image_file'], PATHINFO_BASENAME) : null }}
    </span>
    <span class="a_link cursor-pointer" data-delete-image="{{ $name }}">削除</span>
</div>
