const resendBtn = document.querySelector('#resendBtn');

const params = {
  method: 'post',
  body: JSON.stringify({
    token_user: resendBtn.getAttribute('data-btn')
  }),
  headers: {"Content-Type": "application/json"}
};
resendBtn.addEventListener('click', function (e) {
  window.fetch('/src/php/resend_code.php', params)
  .then(response => response.json())
  .then(data => {
    if(data['error'] == 'sent'){
      resendBtn.parentElement.textContent += 'Mail envoyé.';
    }
    if(data['error'] == 'server_err'){
      alert('Une erreur est survenue. Veuillez réessayer. Si le problème persiste, contactez un administrateur. (hello@axelmarcial.com)');
    }
    if(data['error'] == 'user_already_verif'){
      alert('Vous devez avoir un compte non vérifié.');
    }
    if(data['error'] == 'user_not_connected'){
      alert('Vous devez être connecté pour vérifier votre compte.');
    }
    if(data['error'] == 'user_inexist'){
      alert('Vous devez avoir un compte.');
    }
  })
  e.preventDefault();
});
