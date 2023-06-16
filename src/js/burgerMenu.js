const burger = document.querySelector('.burger');
const menu = document.querySelector('.main-nav');
const body = document.querySelector('body');

burger.addEventListener('click', () => {
  burger.classList.toggle('active');
  menu.classList.toggle('active');
  body.classList.toggle('stop-scroll');
});