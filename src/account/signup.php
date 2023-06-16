<?php 
  require_once('../config/config.php');
  if(session_status() == 1){
    session_start();
  }
  if(isset($_SESSION['connected']) && $_SESSION['connected'] = true){
    $check = $db->prepare('SELECT * FROM users WHERE token = ?');
    $check->execute(array($_SESSION['user']));
    $user_data = $check->fetch();
    $count = $check->rowCount();
    if($count > 0){
      header('Location:/'); die();
    }
  }
?>
<!DOCTYPE html>
<html lang="fr">
  <head>
    <!-- META -->
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <!-- LINK -->
    <link rel="stylesheet" href="/src/css/style.css" />
    <link rel="stylesheet" href="/src/css/responsive.css" />
    <link
      href="https://cdn.jsdelivr.net/npm/remixicon@3.2.0/fonts/remixicon.css"
      rel="stylesheet"
    />
    <!-- TITLE -->
    <title>inscription — mmifolio</title>
  </head>
  <body class="account">
    <header>
      <a href="/"
        ><h1 class="logo">mmi<span>folio</span></h1></a
      >
    </header>
    <main>
      <h2>S'inscrire</h2>
      <?php 
        if(isset($_GET['e']) && !empty($_GET['e'])){
          $err = htmlspecialchars($_GET['e']);
          switch($err){
            case 'server_err':
              echo '<div class="form-alert form-error">
                <i class="ri-error-warning-line"></i>
                <p>Une erreur est survenue. Si le problème persiste, veuillez contacter un <a href="mailto:hello@axelmarcial.com">administrateur</a>.</p>
                <button onclick="this.parentElement.remove()"><i class="ri-close-line"></i></button>
              </div>';
              break;
            case 'fullname':
              echo '<div class="form-alert form-error">
                <i class="ri-error-warning-line"></i>
                <p>Veuillez indiquer vos nom et prénom.</p>
                <button onclick="this.parentElement.remove()"><i class="ri-close-line"></i></button>
              </div>';
              break;
            case 'promo':
              echo '<div class="form-alert form-error">
                <i class="ri-error-warning-line"></i>
                <p>Veuillez sélectionner une promo.</p>
                <button onclick="this.parentElement.remove()"><i class="ri-close-line"></i></button>
              </div>';
              break;
            case 'username':
              echo '<div class="form-alert form-error">
                <i class="ri-error-warning-line"></i>
                <p>Veuillez indiquer un nom d\'utilisateur.</p>
                <button onclick="this.parentElement.remove()"><i class="ri-close-line"></i></button>
              </div>';
              break;
            case 'email':
              echo '<div class="form-alert form-error">
                <i class="ri-error-warning-line"></i>
                <p>Veuillez indiquer une adresse email.</p>
                <button onclick="this.parentElement.remove()"><i class="ri-close-line"></i></button>
              </div>';
              break;
            case 'password':
              echo '<div class="form-alert form-error">
                <i class="ri-error-warning-line"></i>
                <p>Veuillez remplir les deux champs de mot de passe.</p>
                <button onclick="this.parentElement.remove()"><i class="ri-close-line"></i></button>
              </div>';
              break;
            case 'password_diff':
              echo '<div class="form-alert form-error">
                <i class="ri-error-warning-line"></i>
                <p>Les mots de passe ne correspondent pas.</p>
                <button onclick="this.parentElement.remove()"><i class="ri-close-line"></i></button>
              </div>';
              break;
            case 'username_invalid':
              echo '<div class="form-alert form-error">
                <i class="ri-error-warning-line"></i>
                <p>Le nom d\'utilisateur peut contenir de 1 à 30 caractères alphanumériques, ainsi que "." et "_".</p>
                <button onclick="this.parentElement.remove()"><i class="ri-close-line"></i></button>
              </div>';
              break;
            case 'email_invalid':
              echo '<div class="form-alert form-error">
                <i class="ri-error-warning-line"></i>
                <p>L\'adresse email doit contenir votre prénom et votre nom séparé par un point, et cela doit être une adresse de l\'IUT de Tarbes. (prenom.nom@iut-tarbes.fr)</p>
                <button onclick="this.parentElement.remove()"><i class="ri-close-line"></i></button>
              </div>';
              break;
            case 'password_invalid':
              echo '<div class="form-alert form-error">
                <i class="ri-error-warning-line"></i>
                <p>Votre mot de passe doit contenir de 8 à 30 caractères, au minimun 1 lettre majuscule, 1 lettre minuscule, 1 chiffre et 1 caractère spécial (@,?;.:-_!+=).</p>
                <button onclick="this.parentElement.remove()"><i class="ri-close-line"></i></button>
              </div>';
              break;
            case 'username_exist':
              echo '<div class="form-alert form-error">
                <i class="ri-error-warning-line"></i>
                <p>Le nom d\'utilisateur que vous avez choisi est déjà pris. Choisissez en un autre ou <a href="/account/login">connectez-vous</a> si c\'est le votre.</p>
                <button onclick="this.parentElement.remove()"><i class="ri-close-line"></i></button>
              </div>';
              break;
            case 'email_exist':
              echo '<div class="form-alert form-error">
                <i class="ri-error-warning-line"></i>
                <p>L\'adresse email que vous avez choisi est déjà utilisée. Choisissez en une autre ou <a href="/account/login">connectez-vous</a> si c\'est la votre.</p>
                <button onclick="this.parentElement.remove()"><i class="ri-close-line"></i></button>
              </div>';
              break;
            default:
              echo '';
              break;
          }
        }
      ?>
      <form action="/src/php/signup_form.php" id="signup" method="post" enctype="multipart/form-data">
        <div class="input-line">
          <div class="input-container">
            <label for="fullname">Nom & prénom*</label>
            <input
              type="text"
              name="fullname"
              id="fullname"
              required
              placeholder="Nom Prénom"
              minlength="3"
              maxlength="50"
            />
          </div>
          <div class="input-container">
            <label for="promo">Promo*</label>
            <select name="promo" id="promo" class="special-input" required>
              <option value="">Choisis ta promo</option>
              <?php
              foreach($db->query('SELECT * FROM promo') as $promo){
                echo '<option value="'.$promo['flat_name'].'">'.$promo['name'].'</option>';
              }
              ?>
            </select>
          </div>
        </div>
        <div class="input-line">
          <div class="input-container">
            <label for="username">Nom d'utilisateur*</label>
            <div class="special-input">
              <span>@</span>
              <input
                type="text"
                name="username"
                id="username"
                required
                placeholder="nomdutilisateur"
                minlength="1"
                maxlength="30"
              />
            </div>
            <small>De 1 à 30 caractères alphanumériques. (+ “.” et “_”)</small>
          </div>
          <div class="input-container">
            <label for="profile-picture">Photo de profil</label>
            <div class="special-input">
              <span><i class="ri-file-upload-line"></i></span>
              <label class="file-label" id="profile-label" for="profile-picture">Choisis un fichier</label>
              <input type="file" name="profile-picture" id="profile-picture" accept="image/png, image/jpeg" onchange="avatarSignupInput(this, 'profile-label');"/>
            </div>
            <small>Taille recommandé : 256x256 pixels. Max.: 5Mo.Seulement .png et .jpg.</small>
          </div>
        </div>
        <div class="input-container">
          <label for="email">Adresse email*</label>
          <input
            type="email"
            name="email"
            id="email"
            required
            placeholder="prenom.nom@iut-tarbes.fr"
            minlength="1"
            maxlength="254"
          />
        </div>
        <div class="input-line">
          <div class="input-container">
            <label for="passwd">Mot de passe*</label>
            <div class="special-input">
              <span><i class="ri-lock-password-line"></i></span>
              <input type="password" name="passwd" id="passwd" required placeholder="•••••••••••••••" minlength="8" maxlength="30"/>
            </div>
            <small>De 8 à 30 caractères. Minimum 1 minuscule, 1 majuscule, 1 chiffre et 1 symbole.</small>
          </div>
          <div class="input-container">
            <label for="repasswd">Confirmer*</label>
            <div class="special-input">
              <span><i class="ri-lock-password-line"></i></span>
              <input type="password" name="repasswd" id="repasswd" required placeholder="•••••••••••••••" minlength="8" maxlength="30"/>
            </div>
          </div>
        </div>
        <button class="form-btn">S'inscrire</button>
        <div class="link-line">
          <p>
            Tu as déjà un compte ?
            <a href="/account/login" class="gradient-text">Se connecter.</a>
          </p> 
        </div>
      </form>
    </main>
    <script src="/src/js/inputFilePreview.js"></script>
  </body>
</html>
