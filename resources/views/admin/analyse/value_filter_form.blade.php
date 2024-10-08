<tr class="tr_32px">
    <td class="col_rec td_440px">
        <div class="element-form-rows element_100p">
            <div class="element-form element_100p">
                <div class="text_wrapper">{{ $title }}</div>
                <div class="frame" style="margin-left: auto">
                    <select name="{{ $column }}_filter_condition" class="large_selectbox">
                        @if (old("{$column}_filter_condition", 'empty') === 'empty')
                            <option value="none" @if ($defaultCondition === 'none') selected @endif>（指定しない）</option>
                            <option value="eq" @if ($defaultCondition === 'eq') selected @endif>指定の値に等しい</option>
                            <option value="ne" @if ($defaultCondition === 'ne') selected @endif>指定の値に等しくない</option>
                            <option value="gt" @if ($defaultCondition === 'gt') selected @endif>指定の値より大きい</option>
                            <option value="lt" @if ($defaultCondition === 'lt') selected @endif>指定の値より小さい</option>
                            <option value="ge" @if ($defaultCondition === 'ge') selected @endif>指定の値以上</option>
                            <option value="le" @if ($defaultCondition === 'le') selected @endif>指定の値以下</option>
                            <option value="like" @if ($defaultCondition === 'like') selected @endif>指定の値を含む</option>
                            <option value="not_like" @if ($defaultCondition === 'not_like') selected @endif>指定の値を含まない
                            </option>
                            <option value="sw" @if ($defaultCondition === 'sw') selected @endif>指定の値で始まる</option>
                            <option value="ew" @if ($defaultCondition === 'ew') selected @endif>指定の値で終わる</option>
                            <option value="between" @if ($defaultCondition === 'between') selected @endif>指定の値の間</option>
                        @else
                            <option value="none" @if (old("{$column}_filter_condition") === 'none') selected @endif>（指定しない）</option>
                            <option value="eq" @if (old("{$column}_filter_condition") === 'eq') selected @endif>指定の値に等しい</option>
                            <option value="ne" @if (old("{$column}_filter_condition") === 'ne') selected @endif>指定の値に等しくない
                            </option>
                            <option value="gt" @if (old("{$column}_filter_condition") === 'gt') selected @endif>指定の値より大きい
                            </option>
                            <option value="lt" @if (old("{$column}_filter_condition") === 'lt') selected @endif>指定の値より小さい
                            </option>
                            <option value="ge" @if (old("{$column}_filter_condition") === 'ge') selected @endif>指定の値以上</option>
                            <option value="le" @if (old("{$column}_filter_condition") === 'le') selected @endif>指定の値以下</option>
                            <option value="like" @if (old("{$column}_filter_condition") === 'like') selected @endif>指定の値を含む</option>
                            <option value="not_like" @if (old("{$column}_filter_condition") === 'not_like') selected @endif>指定の値を含まない
                            </option>
                            <option value="sw" @if (old("{$column}_filter_condition") === 'sw') selected @endif>指定の値で始まる</option>
                            <option value="ew" @if (old("{$column}_filter_condition") === 'ew') selected @endif>指定の値で終わる</option>
                            <option value="between" @if (old("{$column}_filter_condition") === 'between') selected @endif>指定の値の間</option>
                        @endif
                    </select>
                </div>
            </div>
        </div>
    </td>
    <td class="col_rec td_240px">
        <input type="text" class="grid_textbox grid_textbox_100p" name="{{ $column }}_filter_first"
            value="{{ old("{$column}_filter_first", $defaultValueFirst) }}">
    </td>
    <td class="col_rec td_240px">
        <input type="text" class="grid_textbox grid_textbox_100p" name="{{ $column }}_filter_second"
            value="{{ old("{$column}_filter_second", $defaultValueSecond) }}">
    </td>
</tr>
