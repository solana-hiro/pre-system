<div class="calendar-modal" id={{ $calendarId }}>
    <div class="modal-content">
        <header class="header">
            <div>
                <img src="/img/icon/prev-year.svg" onClick="onPrevYearClick('{{ $calendarId }}')" />
            </div>
            <div>
                <img src="/img/icon/prev-month.svg" onClick="onPrevMonthClick('{{ $calendarId }}')" />
            </div>
            <div>
                <spna id="{{ $calendarId }}-calendar-year"></spna>年
                <spna id="{{ $calendarId }}-calendar-month"></spna>月
            </div>
            <div>
                <img src="/img/icon/next-month.svg" onClick="onNextMonthClick('{{ $calendarId }}')" />
            </div>
            <div>
                <img src="/img/icon/next-year.svg" onClick="onNextYearClick('{{ $calendarId }}')" />
            </div>
        </header>
        <div id="{{ $calendarId }}-area"></div>
    </div>
</div>
