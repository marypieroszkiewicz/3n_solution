function recaptcha {

}


function onClick(e) {
  e.preventDefault();
  grecaptcha.ready(function() {
    grecaptcha.execute('reCAPTCHA_site_key', {action: 'submit'}).then(function(token) {
      // Add your logic to submit to your backend server here.
    });
  });
}



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

//
//
// // when form is submit
// $('#contactForm').submit(function() {
//   // we stoped it
//   event.preventDefault();
//   var email = $('#email').val();
//   var message = $("#message").val();
//   // needs for recaptacha ready
//   grecaptcha.ready(function() {
//     // do request for recaptcha token
//     // response is promise with passed token
//     grecaptcha.execute('6LfYcf8UAAAAAHiC72XsuF_WQ6tF0EyJvvJ7nFWL', {action: 'create_message'}).then(function(token) {
//       // add token to form
//       $('#contactForm').prepend('<input type="hidden" name="g-recaptcha-response" value="' + token + '">');
//       $.post("send-script.php",{email: email, message: message, token: token}, function(result) {
//         console.log(result);
//         if(result.success) {
//           alert('Thanks for send message.')
//         } else {
//           alert('You are spammer ! Get the @$%K out.')
//         }
//       });
//     });;
//   });
// });
