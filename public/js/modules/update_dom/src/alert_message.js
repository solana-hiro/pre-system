const alertArea = document.getElementById("alert-danger-ul");

export const clear = () => {
  alertArea.innerHTML = "";
}

export const insert = (messageLi) => {
  alertArea.insertAdjacentHTML('beforeend', messageLi);
}