/* ---------------------------------------------------- */
/* ----- PARALLAX ----- */
/* ---------------------------------------------------- */

window.addEventListener("DOMContentLoaded", scrollLoop,  false);


const parallax = document.querySelector('.main__services-parallax');
const parallax1 = parallax.querySelector('.main__services-parallax__box-img--first');
const parallax2 = document.querySelector('.main__services-parallax__box-img--second');
const parallax3 = document.querySelector('.main__services-parallax__box-img--third');
const parallax4 = document.querySelector('.main__services-parallax__box-img--fourth');
const parallax5 = document.querySelector('.main__services-parallax__box-img--fifth');

let xScrollPosition;
let yScrollPosition;

function scrollLoop(e) {
  xScrollPosition = window.scrollX;
  yScrollPosition = window.scrollY;

  setTranslate(0, yScrollPosition * -0.08, parallax1);
  setTranslate(0, yScrollPosition * -0.08, parallax2);
  setTranslate(0, yScrollPosition * -0.08, parallax3);
  setTranslate(0, yScrollPosition * -0.08, parallax4);
  setTranslate(0, yScrollPosition * -0.08, parallax5);

  requestAnimationFrame(scrollLoop);
}

function setTranslate(xPos, yPos, el) {
  el.style.transform = `translate3d(${xPos}px, ${yPos}px, 0)`;
}