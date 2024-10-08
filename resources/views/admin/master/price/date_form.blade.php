<div class="flex">
    <input type="number" @if ($calendarIndex ?? null) id="calendar{{ $calendarIndex }}-year" @endif
        name="{{ $paramName }}[year]" class="grid_textbox {{ $width['year'] ?? '' }}" data-limit-len="4"
        data-limit-minus value="{{ old("$oldParamName.year", explode('-', $initialDate ?? '--')[0]) }}"
        @if ($readonly) readonly @endif>
    <span>年</span>
    <input type="text" @if ($calendarIndex ?? null) id="calendar{{ $calendarIndex }}-month" @endif
        name="{{ $paramName }}[month]" class="grid_textbox {{ $width['month'] ?? '' }}" data-limit-len="2"
        data-limit-minus value="{{ old("$oldParamName.month", explode('-', $initialDate ?? '--')[1]) }}"
        @if ($readonly) readonly @endif>
    <span>月</span>
    <input type="text" @if ($calendarIndex ?? null) id="calendar{{ $calendarIndex }}-date" @endif
        name="{{ $paramName }}[day]" class="grid_textbox {{ $width['day'] ?? '' }}" data-limit-len="2"
        data-limit-minus value="{{ old("$oldParamName.day", explode('-', $initialDate ?? '--')[2]) }}"
        @if ($readonly) readonly @endif>
    <span>日</span>
    @if (!$readonly)
        <img src="/img/icon/calender.svg" onclick='onOpenCalendar("calendar{{ $calendarIndex }}")'>
    @endif
</div>
