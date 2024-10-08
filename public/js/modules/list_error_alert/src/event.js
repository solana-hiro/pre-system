const alertListener = ([old, errorMessages, sessionErrorMessages]) => {
  if (!old || !old.hasOwnProperty('preview')) return;
  if (errorMessages.length === 0 && !sessionErrorMessages) return;

  let alertMessage = [];
  errorMessages.map((el) => { alertMessage.push(el) });
  if (!!sessionErrorMessages) sessionErrorMessages.map((el) => { alertMessage.push(el) });
  alert(alertMessage);
  window.close();
}

export const start = () => {
  if (typeof laravelResponse === 'undefined') return;

  window.addEventListener('DOMContentLoaded', alertListener(laravelResponse));
}