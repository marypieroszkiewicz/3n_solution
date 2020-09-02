const popup = document.querySelector('.popup');
const button = document.querySelector('.js-popup-close');
button.addEventListener('click', closePopup)

function closePopup() {
  let popup= document.querySelector('.popup');
  popup.classList.add('popupClose');
  localStorage.setItem('popupDay', day);
}

// const day = new Date().getDay();
const day = Math.floor(Date.now() / 1000 / 60 / 60 / 24);
const saved_day = localStorage.getItem('popupDay');

if (!saved_day || day > +saved_day) {
  popup.classList.remove('popupClose');
}
