const popup = document.querySelector('.popup');
const button = document.querySelector('.js-popup-close');
button.addEventListener('click', closePopup)

function closePopup() {
  let popup = document.querySelector('.popup');
  popup.classList.add('popupClose');
}
const factor = 1000 * 24 * 60 * 60;
function get_day(date) {
  return Math.floor(+date / factor);
}

const day = get_day(new Date());
const last = get_day(new Date(2020, 09, 18));

const delay = function(){
  if (day <= last) {
    popup.classList.remove('popupClose');
  }
};
setTimeout(delay, 1000);
