$('.hamburger-toggle').on('click', function(){
  $(this).toggleClass('open');
  $('.mobile-menu').toggleClass('hidden').toggleClass('z-2');
  $('body').toggleClass('overflow-hidden');
});

const scriptURL = 'https://script.google.com/macros/s/AKfycbwF3vB_9iEmE6OoHFOTuZJPKqPsp2uhNwuzC73GzH9rISH-EXKP/exec';
const order_form = document.forms['form_order'];
let orderSuccess = document.querySelector('.form_order_success');
let formOrderButton = document.querySelector('.form_order_button');

if (order_form) {
  order_form.addEventListener('submit', e => {
    e.preventDefault()
    let this_form = order_form
    let data = new FormData(order_form)
    formOrderButton.disabled = true
    fetch(scriptURL, { method: 'POST', mode: 'cors', body: data})
      .then(response => showSuccessOrderMessage(data, this_form))
      .catch(error => console.error('Error!', error.message))
  })  
}

function showSuccessOrderMessage(data, this_form){
  console.log(data);
  this_form.reset();
  formOrderButton.disabled = false;
  orderSuccess.classList.remove('hidden');
}

console.log('2');