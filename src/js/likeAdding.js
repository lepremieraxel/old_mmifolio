const likeForm = document.querySelectorAll('.like-form');

likeForm.forEach(el => {
  let nbDiv = el.children[2];
  let btnDiv = el.children[3];
  const params = {
    method: 'post',
    body: JSON.stringify({
      token_user: el.token_user.value,
      token_creation: el.token_creation.value
    }),
    headers: {"Content-Type": "application/json"}
  };
  el.addEventListener('submit', function (e) {
    window.fetch('/src/php/like.php', params)
    .then(response => response.json())
    .then(data => {
      if(data['error'] == 'liked'){
        nbDiv.innerText = data['likes'];
        btnDiv.classList.add('liked');
      }
      if(data['error'] == 'unliked'){
        nbDiv.innerText = data['likes'];
        btnDiv.classList.remove('liked');
      }
      if(data['error'] == 'server_err'){
        alert('Une erreur est survenue. Veuillez réessayer. Si le problème persiste, contactez un administrateur. (hello@axelmarcial.com)');
      }
      if(data['error'] == 'user_not_verif'){
        alert('Vous devez avoir un compte vérifié pour liker.');
      }
      if(data['error'] == 'user_not_connected'){
        alert('Vous devez être connecté pour liker.');
      }
      if(data['error'] == 'user_inexist'){
        alert('Vous devez avoir un compte pour liker.');
      }
    })
    e.preventDefault();
  });
});
