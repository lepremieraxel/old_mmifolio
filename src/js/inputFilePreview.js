function avatarInput(el, id){
  const imageDiv = document.querySelector(`#${id}`);
  const [picture] = el.files;
  if(picture){
    const reader = new FileReader();
    reader.onload = function (ev) {
      imageDiv.src = ev.target.result;
    }
    reader.readAsDataURL(picture);
  }
}

function apercuInput(el, div, label){
  const previewDiv = document.querySelector(`#${div}`);
  while(previewDiv.firstChild) {
    previewDiv.removeChild(previewDiv.firstChild);
  }
  const labelEl = document.querySelector(`#${label}`);
  const [file] = el.files;
  if(file){
    if(file.size <= 5000000){
      const reader = new FileReader();
      const filetype = file.type;
      if(filetype == 'image/png' || filetype == 'image/jpeg'){
        reader.onload = (ev) => {
          const img = document.createElement('img');
          img.src = ev.target.result;
          img.alt = 'image de galerie';
          img.title = file.name;
          previewDiv.appendChild(img)
          labelEl.innerText = file.name;
        }
        reader.readAsDataURL(file);
      }
      if(filetype == 'video/mp4' || filetype == 'video/avi' || filetype == 'video/mov' || filetype == 'video/webm'){
        reader.onload = (ev) => {
          const video = document.createElement('video');
          video.src = ev.target.result;
          video.autoplay = true;
          video.loop = true;
          video.muted = true;
          video.title = file.name;
          previewDiv.appendChild(video)
          labelEl.innerText = file.name;
        }
        reader.readAsDataURL(file);
      }
    } else{
      alert('Vous ne pouvez pas upload des fichiers supérieur à 5Mo.');
      document.querySelector('#apercu').value='';
      labelEl.innerText = 'Choisis un fichier';
    }
  }
}

function galeryInput(el, div, label){
  const previewDiv = document.querySelector(`#${div}`);
  while(previewDiv.firstChild) {
    previewDiv.removeChild(previewDiv.firstChild);
  }
  const labelEl = document.querySelector(`#${label}`);
  if(el.files.length <= 5){
    if(el.files[0].size <= 5000000){
      labelEl.innerText = '';
      for(const file of el.files){
        const reader = new FileReader();
        labelEl.innerText += ` ${file.name},`;
        const filetype = file.type;
        if(filetype == 'image/png' || filetype == 'image/jpeg'){
          reader.onload = (ev) => {
            const img = document.createElement('img');
            img.src = ev.target.result;
            img.alt = 'image de galerie';
            img.title = file.name;
            previewDiv.appendChild(img)
          }
          reader.readAsDataURL(file);
        }
        if(filetype == 'video/mp4' || filetype == 'video/avi' || filetype == 'video/mov' || filetype == 'video/webm'){
          reader.onload = (ev) => {
            const video = document.createElement('video');
            video.src = ev.target.result;
            video.autoplay = true;
            video.loop = true;
            video.muted = true;
            video.title = file.name;
            previewDiv.appendChild(video)
          }
          reader.readAsDataURL(file);
        }
      }
    } else{
      alert('Vous ne pouvez pas upload des fichiers supérieur à 5Mo.');
      document.querySelector('#galery').value='';
      return;
    }
  } else alert('Vous ne pouvez sélectionner que 5 fichiers.');
}