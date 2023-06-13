const today = new Date();
const currentYear = today.getFullYear();
window.onload = () => {
  const yearInput = document.querySelector('#date');
  yearInput.setAttribute('max', currentYear);
  yearInput.setAttribute('value', currentYear);
}