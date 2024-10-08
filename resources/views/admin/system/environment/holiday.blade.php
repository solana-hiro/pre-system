@extends('layouts.admin.app')
@section('page_title', '休日マスタ')
@section('title', '休日マスタ')
@section('description', '')
@section('keywords', '')
@section('canonical', '')

@section('content')
    <div class="main-area">
        <form role="search" action="{{ route('system.environment.holiday.update') }}" method="post">
            @csrf
            <div class="button_area">
                <div class="div">
                    <button type="button" data-toggle="modal" data-target="#modal_cancel" data-value="" class="button" data-url="" name="cancel2"><div class="text_wrapper">キャンセル</div></button>
                    <button type="button" data-toggle="modal" data-target="#modal_confirm" data-value="" class="button-2" data-url="" name="update2"><div class="text_wrapper_3">登録する</div></button>
                </div>
            </div>
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @elseif (Session::has('sessionErrors'))
                <div class="alert alert-danger">
                    <ul>
                        @foreach (session('sessionErrors') as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @elseif (Session::has('flashmessage'))
                @include('components.modal.message', ['flashmessage' => session('flashmessage') ])
            @elseif (Session::has('errormessage'))
                @include('components.modal.error', ['errormessage' => session('errormessage') ])
            @endif
            <div class="alert alert-danger">
                <ul id="alert-danger-ul">
            </div>
            <div class="main_area">
                <div class="element-form element-form-columns">
                    <div class="element-form element-form-rows">
                        <label class="selectbox_label text-1-1 notosansjp-medium-outer-space-14px">表示年</label>
                        <div class="frame">
                            <select name="record_count" class="selectbox" onchange="createCalendar(this.value);">
                                <option value="{{ \Carbon\Carbon::now()->year }}" selected>{{ \Carbon\Carbon::now()->year }}</option>
                                <option value="{{ \Carbon\Carbon::now()->addYear(1)->year }}">{{ \Carbon\Carbon::now()->addYear(1)->year }}</option>
                                <option value="{{ \Carbon\Carbon::now()->addYear(2)->year }}">{{ \Carbon\Carbon::now()->addYear(2)->year }}</option>
                                <option value="{{ \Carbon\Carbon::now()->addYear(3)->year }}">{{ \Carbon\Carbon::now()->addYear(3)->year }}</option>
                                <option value="{{ \Carbon\Carbon::now()->addYear(4) ->year}}">{{ \Carbon\Carbon::now()->addYear(4)->year }}</option>

                            </select>
                        </div>
				    </div><br><br>
                    <div class="element-form element-form-columns">
                        <div id="calendar" class="calendar-wrap"></div>
                    </div>
                </div>
            </div>
            <button type="submit" id="cancel" name="cancel" class="display_none_all"></button>
            <button type="submit" id="update" name="update" class="display_none_all"></button>
            <button type="submit" id="delete" name="delete" class="display_none_all" value=""></button>
            <input type="hidden" id="delete_list" name="delete_list" class="display_none_all" value=""></input>
        </form>
    </div>


<script>
    const date = new Date();
    const today = date.getDate();
    const currentMonth = date.getMonth();
    const currentYear = date.getFullYear();

    function createCalendar(targetYear) {
        const holidays = @json($holidays);
        const initData = @json($initData);
        let allCalendarHTML = '';
        for (let mon = 0; mon < 12; mon++){
            const monthDays = ["日", "月", "火", "水", "木", "金", "土"];
            let calendarHTML = '<table class="calendar"><caption class="calender_caption">' + (mon+1) + '月</caption><thead><tr>';
            for (let i = 0; i < 7; i++) {
                if (i === 0) {
                    calendarHTML += `<th class="">${monthDays[i]}</th>`;
                } else if (i === 6) {
                    calendarHTML += `<th class="">${monthDays[i]}</th>`;
                } else {
                    calendarHTML += `<th>${monthDays[i]}</th>`;
                }
            }
            calendarHTML += '</tr></thead><tbody>';

            const daysInMonth = new Date(targetYear, mon + 1, 0).getDate();
            const firstDay = new Date(targetYear, mon, 1).getDay();
            const daysInPrevMonth = new Date(targetYear, mon, 0).getDate();
            let dayCount = 1;
            let prevDayCount = daysInPrevMonth - firstDay + 1;

            for (let i = 0; i < 6; i++) {
                calendarHTML += '<tr>';
                for (let j = 0; j < 7; j++) {
                    if (i === 0 && j < firstDay) {
                        calendarHTML += `<td class="mute">${prevDayCount}</td>`;
                        prevDayCount++;
                    } else if (dayCount > daysInMonth) {
                        let nextMonthDayCount = dayCount - daysInMonth;
                        calendarHTML += `<td class="mute">${nextMonthDayCount}</td>`;
                        dayCount++;
                    } else {
                        let nowMon = (mon+1);
                        let checkDate = targetYear + '-' + ( '00' + nowMon ).slice( -2 ) + '-' + ( '00' + dayCount ).slice( -2 )
                        // 土曜日にclassを付ける
                        if (j === 6) {
                            calendarHTML += `<td class="sat" id="${checkDate}">${dayCount}</td>`;
                        }
                        // 日曜日にclassを付ける
                        else if (j === 0) {
                            calendarHTML += `<td class="sun" id="${checkDate}">${dayCount}</td>`;
                        } else if(holidays.includes(checkDate)) {
                            // 休日・祝日にclassを付ける
                            calendarHTML += `<td class="sun" id="${checkDate}">${dayCount}</td>`;
                        } else if(initData.includes(checkDate)) {
                            // 休日・祝日にclassを付ける
                            calendarHTML += `<td class="holiday" id="${checkDate}" onclick="clickCalender(this);">${dayCount}</td>`;
                        } else {
                            calendarHTML += `<td id="${checkDate}" onclick="clickCalender(this);">${dayCount}</td>`;
                        }
                        dayCount++;
                    }
                }
                calendarHTML += '</tr>';
                if (dayCount - daysInMonth > 7) {
                    break;
                }
            }
            calendarHTML += '</tbody></table>';
            allCalendarHTML += calendarHTML;
        }
        document.getElementById('calendar').innerHTML = allCalendarHTML;
    }

    let delIds = [];
    let insIds = [];
    function clickCalender(elm) {
        // 削除
        if(elm.classList.contains('holiday')){
            elm.classList.remove('holiday');
            if(insIds.includes(elm.id)) {
                let index = insIds.indexOf(elm.id);
                insIds.splice(index, 1);
            } else {
                delIds.push(elm.id);
            }
        } else {
            elm.classList.add('holiday');
            if(delIds.includes(elm.id)) {
                let index = delIds.indexOf(elm.id);
                delIds.splice(index, 1);
            } else {
                insIds.push(elm.id);
            }
        }
        let deleteIds = Array.from(new Set(delIds));
        let updateIds = Array.from(new Set(insIds));
        document.getElementById('update').value = updateIds;
        document.getElementById('delete_list').value = deleteIds;
    }

</script>
<script>
window.onload = function() {
    createCalendar(date.getFullYear());
}
</script>
<style>
.calendar-wrap {
  margin: 0 auto;
  max-width: 100%;
  display: grid;
  grid-template-columns: repeat(4, 1fr);
  gap: 30px;
}

.calendar {
  width: 100%;
  border-collapse: collapse;
}

.calendar tr {
  color: #2d3842
}

.calendar th,
.calendar td {
  border: 1px solid #d4dde1;
  text-align: center;
  padding: 8px;
  font-size: 14px;
  font-weight: bold;
  color: #2d3842;
}
.calendar th {
  padding: 2px 2px;
  opacity: 0.6;
}
.calendar td {}

.calendar .sun {
  color: #e17f7e;
  background-color: #f8e4e2;
}
.calendar .holiday {
  color: #ff0000;
  background-color: #ff8484;
  opacity: 0.6;
}
.calendar .sat {
  color: #215ED2;
  background-color: rgba(33,94,210,0.1);
}
.calendar .mute {
  color: rgba(45,56,66,0.3);
  background-color: #eeeeee;
}
.calendar .today {
  background-color: #7d7d7d;
}
.calendar .off {
  background-color: #fadcdb;
}
.calender_caption {
  text-align: left;
  font-size: 14px;
}
.holiday {
  color: #e17f7e;
  background-color: #ff8484;
}

</style>
@endsection
