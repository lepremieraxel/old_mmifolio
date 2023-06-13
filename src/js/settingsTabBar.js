function changeTab(el){
  const currentActiveTab = document.querySelector('.tab-bar .active');
  currentActiveTab.classList.remove('active');
  el.classList.add('active');
  const currentActiveDiv = document.querySelector(`#setting-${currentActiveTab.getAttribute('data-tab')}`);
  currentActiveDiv.style.display = 'none';
  const selectTabDiv = document.querySelector(`#setting-${el.getAttribute('data-tab')}`);
  selectTabDiv.style.display = 'flex';
}