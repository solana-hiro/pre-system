<tr>
    <input type="hidden" name="mt_catalog_items[{{ $i }}][id]" value="{{ $items[$i]->id ?? '' }}">
    <input type="hidden" name="mt_catalog_items[{{ $i }}][mt_member_site_items_id]"
        value="{{ old('mt_catalog_items.' . $i . '.mt_member_site_items_id', $items[$i]->mt_member_site_items_id ?? '') }}">
    <td class="grid_wrapper_left">
        <div class="flex">
            <input type="text" name="mt_catalog_items[{{ $i }}][ec_item_cd]" class="grid_textbox !w-full"
                minlength="0" maxlength="20" data-ac="msitem"
                value="{{ old('mt_catalog_items.' . $i . '.ec_item_cd', $items[$i]->ec_item_cd ?? '') }}">
            <img class="vector" src="/img/icon/vector.svg" data-smm-open="search_member_site_item_class" />
        </div>
    </td>
    <td class="grid_wrapper_left col_rec">
        <input type="text" name="mt_catalog_items[{{ $i }}][ec_item_name]" class="grid_textbox" readonly
            value="{{ old('mt_catalog_items.' . $i . '.ec_item_name', $items[$i]->ec_item_name ?? '') }}">
    </td>
    <td class="grid_wrapper_left col_rec">
        <img src="{{ old('mt_catalog_items.' . $i . '.item_image_file_1', $items[$i]->item_image_file_1 ?? '') }}"
            class="img_preview_small">
        <input type="hidden" name="mt_catalog_items[{{ $i }}][item_image_file_1]"
            value="{{ old('mt_catalog_items.' . $i . '.item_image_file_1', $items[$i]->item_image_file_1 ?? '') }}">
    </td>
    <td class="grid_wrapper_left col_rec">
        <input type="number" name="mt_catalog_items[{{ $i }}][display_sort_order]" class="grid_textbox"
            data-limit-len="3" data-limit-minus
            value="{{ old('mt_catalog_items.' . $i . '.display_sort_order', $items[$i]->display_sort_order ?? '') }}">
    </td>
    <td class="grid_wrapper_center col_rec">
        <button type="button" data-toggle="modal" data-target="#modal_sub_delete" class="display_none"
            data-value="{{ $i }}">
            <img class="grid_img_center" src="{{ asset('/img/icon/trash.svg') }}" />
        </button>
    </td>
</tr>
