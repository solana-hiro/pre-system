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
                            <option value="between" @if (old("{$column}_filter_condition") === 'between') selected @endif>指定の値の間</option>
                        @endif
                    </select>
                </div>
            </div>
        </div>
    </td>
    <td class="col_rec td_240px">
        <div class="textbox">
            <input type="checkbox" name="{{ $column }}_filter_first_monthly_flag"
                @if (old("{$column}_filter_first_monthly_flag") === 'on') checked @endif>
            <input id="{{ $calendarId1 }}-year" type="text" name="{{ $column }}_filter_first_year"
                class="element" style="width: 40px" minlength="0" maxlength="4"
                value="{{ old("{$column}_filter_first_year") }}">年
            <input id="{{ $calendarId1 }}-month" type="text" name="{{ $column }}_filter_first_month"
                class="element" style="width: 24px" minlength="0" maxlength="2"
                value="{{ old("{$column}_filter_first_month") }}">月
            <input id="{{ $calendarId1 }}-date" type="text" name="{{ $column }}_filter_first_day"
                class="element" style="width: 24px" minlength="0" maxlength="2"
                value="{{ old("{$column}_filter_first_day") }}">日
            <img src="/img/icon/calender.svg" onclick="onOpenCalendar('{{ $calendarId1 }}')">
        </div>
    </td>
    <td class="col_rec td_240px">
        <div class="textbox">
            <input type="checkbox" name="{{ $column }}_filter_second_monthly_flag"
                @if (old("{$column}_filter_second_monthly_flag") === 'on') checked @endif>
            <input id="{{ $calendarId2 }}-year" type="text" name="{{ $column }}_filter_second_year"
                class="element" style="width: 40px" minlength="0" maxlength="4"
                value="{{ old("{$column}_filter_second_year") }}">年
            <input id="{{ $calendarId2 }}-month" type="text" name="{{ $column }}_filter_second_month"
                class="element" style="width: 24px" minlength="0" maxlength="2"
                value="{{ old("{$column}_filter_second_month") }}">月
            <input id="{{ $calendarId2 }}-date" type="text" name="{{ $column }}_filter_second_day"
                class="element" style="width: 24px" minlength="0" maxlength="2"
                value="{{ old("{$column}_filter_second_day") }}">日
            <img src="/img/icon/calender.svg" onclick="onOpenCalendar('{{ $calendarId2 }}')">
        </div>
    </td>
</tr>
