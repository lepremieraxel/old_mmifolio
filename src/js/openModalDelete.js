function openModal(data){
  const allModal = document.querySelectorAll('.setting-data-modal');
  allModal.forEach(modal => {
    if(modal.getAttribute('data-modal') == data){
      modal.style.display = 'flex';
    }
  });
}

function closeModal(el){
  el.parentElement.parentElement.parentElement.style.display = 'none';
}