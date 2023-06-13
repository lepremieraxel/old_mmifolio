function changeImg(el) {
  const mainContainer = document.querySelector('#mainGaleryContainer');
  const activeGalery = document.querySelector('.galery-active');

  let mediaType = el.src;
  mediaType = mediaType.split('/');
  mediaType = mediaType[0];

  mainContainer.removeChild(mainContainer.children[0]);

  switch (mediaType) {
    case 'data:image':
      const newMainImg = document.createElement('img');
      newMainImg.classList.add('apercu');
      newMainImg.alt = 'image d\'apercu';
      newMainImg.src = el.src;
      mainContainer.appendChild(newMainImg);
      break;
      case 'data:video':
        const newMainVideo = document.createElement('video');
        newMainVideo.classList.add('apercu');
        newMainVideo.src = el.src;
        newMainVideo.autoplay = true;
        newMainVideo.loop = true;
        newMainVideo.muted = true;
        mainContainer.appendChild(newMainVideo);
      break;
    default:
      break;
  }
  activeGalery.classList.remove('galery-active');
  el.classList.add('galery-active');
}
