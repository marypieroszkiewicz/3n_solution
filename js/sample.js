/* ---------------------------------------------------- */
/* ----- PARALLAX ----- */
/* ---------------------------------------------------- */


// window.addEventListener("scroll", (e) => {
//   const pos = window.scrollY;
//   document.body.style.setProperty('--scroll-pos', pos);
// })

// const parallax = document.querySelectorAll(".main__services-parallax__box-img");
//
// window.addEventListener("scroll", (e) => {
//   const pos = window.scrollY;
//
//   parallax.forEach (bg => {
//     // bg.style.setProperty('--scroll-pos', pos);
//     bg.style.backgroundPositionY  = `-${pos*0.4}px`;
//   })
//   // parallax.style.setProperty('--scroll-pos', pos);
// })


// const parallax = document.querySelectorAll('.main__services-parallax__box-img');
//
// window.addEventListener("scroll", (e) => {
//   const pos = window.scrollY;
//
//   parallax.forEach (bg => {
//     bg.style.backgroundPositionY  = `-${pos*0.4}px`;
//   })


// const getOffset = (element, horizontal = false) => {
//   if (!element) return 0;
//   return getOffset(element.offsetParent, horizontal) + (horizontal ? element.offsetLeft : element.offsetTop);
// }
//
// const checkOffset = document.querySelectorAll('.main__services-parallax__box-img');
// const Y = getOffset(checkOffset, true);
// const X = getOffset(checkOffset);
//
// console.log(checkOffset);





// window.addEventListener( 'scroll', ( evt ) => {
//   const pos = window.scrollY;
//   const offset = getOffset( document.querySelector( '.main__services-parallax' ) );
//   document.body.style.setProperty( '--scroll-pos', pos - offset );
//
//   function getOffset( element ) {
//     const offset = element.offsetTop;
//
//     if ( element.offsetParent ) {
//       return offset + getOffset( element.offsetParent );
//     }
//
//     return offset;
//   }
// });