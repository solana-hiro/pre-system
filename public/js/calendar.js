const weeks = ['日', '月', '火', '水', '木', '金', '土'];
const modalClassList = ['is-active', 'zindex_9003']

const modalOutside = document.createElement('div');
modalOutside.classList.add('overlay_gray');

function onOpenCalendar(calendarId) {
  const year = getInputYear(calendarId) || new Date().getFullYear();
  const month = getInputMonth(calendarId) || new Date().getMonth() + 1;
  clearCalendar(calendarId)
  showCalendar(calendarId, year, month);
  openCalendarModal(calendarId);
};

function onCloseCalendar(e) {
  const calendar = document.getElementById(this.calendarId);
  calendar.classList.remove(...modalClassList);
  document.body.removeChild(modalOutside);
  e.currentTarget.removeEventListener('click', this);
};

function onSelect(calendarId, date) {
  setInputYear(calendarId);
  setInputMonth(calendarId);
  setInputDate(calendarId, date);
  modalOutside.dispatchEvent(new Event('click'));
};

function onPrevMonthClick(calendarId) {
  const [year, month] = getPrevMonth(calendarId);
  clearCalendar(calendarId);
  showCalendar(calendarId, year, month);
};

function onPrevYearClick(calendarId) {
  const [year, month] = getPrevYear(calendarId);
  clearCalendar(calendarId);
  showCalendar(calendarId, year, month);
};

function onNextMonthClick(calendarId) {
  const [year, month] = getNextMonth(calendarId);
  clearCalendar(calendarId);
  showCalendar(calendarId, year, month);
};

function onNextYearClick(calendarId) {
  const [year, month] = getNextYear(calendarId);
  clearCalendar(calendarId);
  showCalendar(calendarId, year, month);
};

function openCalendarModal(calendarId) {
  const calendar = document.getElementById(calendarId);
  calendar.classList.add(...modalClassList);
  modalOutside.addEventListener('click', {
    calendarId: calendarId,
    handleEvent: onCloseCalendar
  });
  document.body.appendChild(modalOutside);
};

function showCalendar(calendarId, year, month) {
  const calendarArea = getCalendarArea(calendarId);
  const calendarHtml = createCalendar(calendarId, year, month);
  const calendarSection = document.createElement('section');
  calendarSection.innerHTML = calendarHtml;
  calendarArea.appendChild(calendarSection);
  setCalendarYear(calendarId, year);
  setCalendarMonth(calendarId, month);
};

function headerHtml() {
  return weeks.map((el) => `<th>${el}</th>`).join('');
};

function prevMonthCell(endOfPrevMonthDate, biginningOfMonthDay, position) {
  const date = endOfPrevMonthDate - biginningOfMonthDay + position;
  return `<td class="calendar-date-is-disabled">${date}</td>`
};

function nextMonthCell(endOfMonthDate, nextMonthDate) {
  const date = nextMonthDate - endOfMonthDate;
  return `<td class="calendar-date-is-disabled">${date}</td>`
};

function thisMonthCell(calendarId, year, month, date) {
  return isSelected(calendarId, year, month, date)
    ? `<td onClick="onSelect('${calendarId}','${date}')" class="calendar-date-is-selected">${date}</td>`
    : `<td onClick="onSelect('${calendarId}','${date}')">${date}</td>`
};

function bodyHtml(calendarId, year, month, endOfMonthDate, endOfPrevMonthDate, biginningOfMonthDay) {
  return [...Array(6)].map((_, row) => {
    const cells = [...Array(7)].map((_, col) => {
      const position = (row * 7) + (col + 1);
      if (row == 0 && col < biginningOfMonthDay) {
        return prevMonthCell(endOfPrevMonthDate, biginningOfMonthDay, position);
      }
      const date = position - biginningOfMonthDay;
      if (date > endOfMonthDate) {
        return nextMonthCell(endOfMonthDate, date);
      }
      return thisMonthCell(calendarId, year, month, date);
    }).join('');
    return `<tr>${cells}</tr>`;
  }).join('');
};

function createCalendar(calendarId, year, month) {
  const [endOfMonthDate, endOfPrevMonthDate, biginningOfMonthDay] = getDaysInfo(year, month);
  return [
    '<table class="calendar-table">',
    '<thead>',
    '<tr>',
    headerHtml(),
    '</tr>',
    '</thead>',
    '<tbody>',
    bodyHtml(calendarId, year, month, endOfMonthDate, endOfPrevMonthDate, biginningOfMonthDay),
    '</tbody>',
    '</table>',
  ].join('');
};

function ocreateCalendar(calendarId, year, month) {
  const [endOfMonthDate, endOfPrevMonthDate, biginningOfMonthDay] = getDaysInfo(year, month);
  let dayCount = 1;
  let calendarHtml = '';
  calendarHtml += '<table class="calendar-table">';
  calendarHtml += '<thead>';
  calendarHtml += '<tr>';
  weeks.forEach((el) => { calendarHtml += `<th>${el}</th>`; });
  calendarHtml += '</tr>';
  calendarHtml += '</thead>';
  calendarHtml += '<tbody>';
  for (let row = 0; row < 6; row++) {
    calendarHtml += '<tr>';
    for (let col = 0; col < 7; col++) {
      if (row == 0 && col < biginningOfMonthDay) { // 1行目前月分
        let num = endOfPrevMonthDate - biginningOfMonthDay + col + 1;
        calendarHtml += '<td class="calendar-date-is-disabled">' + num + '</td>';
      } else if (dayCount > endOfMonthDate) { // 最終行翌月分
        let num = dayCount - endOfMonthDate;
        calendarHtml += '<td class="calendar-date-is-disabled">' + num + '</td>';
        dayCount++;
      } else { // 当月分
        if (isSelected(calendarId, year, month, dayCount)) {
          calendarHtml += `<td class="calendar-date-is-selected" data-date="${year}/${month}/${dayCount}">${dayCount}</td>`;
        } else {
          calendarHtml += `<td data-date="${year}/${month}/${dayCount}" onClick="onSelect('${calendarId}','${dayCount}')">${dayCount}</td>`;
        }
        dayCount++;
      }
    }
    calendarHtml += '</tr>';
  }
  calendarHtml += '</tbody>';
  calendarHtml += '</table>';
  return calendarHtml;
};

function clearCalendar(calendarId) {
  getCalendarArea(calendarId).innerHTML = '';
};

function isSelected(calendarId, year, month, date) {
  const inputYear = getInputYear(calendarId);
  const inputMonth = getInputMonth(calendarId);
  const inputDate = getInputDate(calendarId);
  return (year == inputYear && month == inputMonth && date == inputDate)
};

function getDaysInfo(year, month) {
  const biginningOfMonth = new Date(year, month - 1, 1);
  const endOfMonth = new Date(year, month, 0);
  const endOfPrevMonth = new Date(year, month - 1, 0);
  const endOfMonthDate = endOfMonth.getDate();
  const endOfPrevMonthDate = endOfPrevMonth.getDate();
  const biginningOfMonthDay = biginningOfMonth.getDay();
  return [endOfMonthDate, endOfPrevMonthDate, biginningOfMonthDay];
};

function getCalendarArea(calendarId) {
  return document.getElementById(`${calendarId}-area`);
};

function getPrevMonth(calendarId) {
  const year = getCalendarYear(calendarId);
  const month = getCalendarMonth(calendarId) - 1;
  return [
    month < 1 ? year - 1 : year,
    month < 1 ? 12 : month,
  ]
};

function getPrevYear(calendarId) {
  const year = getCalendarYear(calendarId) - 1;
  const month = getCalendarMonth(calendarId);
  return [year, month];
};

function getNextMonth(calendarId) {
  const year = getCalendarYear(calendarId);
  const month = getCalendarMonth(calendarId) + 1;
  return [
    month > 12 ? year + 1 : year,
    month > 12 ? 1 : month,
  ]
};

function getNextYear(calendarId) {
  const year = getCalendarYear(calendarId) + 1;
  const month = getCalendarMonth(calendarId);
  return [year, month];
};

function getInputYear(calendarId) {
  return Number(document.getElementById(`${calendarId}-year`).value);
};

function getInputMonth(calendarId) {
  return Number(document.getElementById(`${calendarId}-month`).value);
};

function getInputDate(calendarId) {
  return Number(document.getElementById(`${calendarId}-date`).value);
};

function setInputYear(calendarId) {
  const inputYear = document.getElementById(`${calendarId}-year`);
  inputYear.value = getCalendarYear(calendarId);
};

function setInputMonth(calendarId) {
  const inputMonth = document.getElementById(`${calendarId}-month`);
  inputMonth.value = String(getCalendarMonth(calendarId)).padStart(2, '0');
};

function setInputDate(calendarId, date) {
  const inputDate = document.getElementById(`${calendarId}-date`);
  inputDate.value = String(date).padStart(2, '0');
};

function getCalendarYear(calendarId) {
  return Number(document.getElementById(`${calendarId}-calendar-year`).innerText);
};

function getCalendarMonth(calendarId) {
  return Number(document.getElementById(`${calendarId}-calendar-month`).innerText);
};

function setCalendarYear(calendarId, year) {
  const calendarYear = document.getElementById(`${calendarId}-calendar-year`);
  calendarYear.innerText = year;
};

function setCalendarMonth(calendarId, month) {
  const calendarMonth = document.getElementById(`${calendarId}-calendar-month`);
  calendarMonth.innerText = month > 12 ? new Date().getMonth() + 1 : month;
};
