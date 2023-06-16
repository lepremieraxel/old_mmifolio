const textareas = document.querySelectorAll('textarea');

textareas.forEach(el => {
  el.addEventListener('input', () => {
    let scroll_height = el.scrollHeight;
    el.style.height = scroll_height + 'px';
  });
});