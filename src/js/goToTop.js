const gototop = document.querySelector('.gototop');

gototop.onclick = () => {
  window.scrollTo(0,0);
}

window.onscroll = () => {
  if(window.scrollY > screen.height/2){
    gototop.style.opacity = '1';
  } else {
    gototop.style.opacity = '0';
  }
}