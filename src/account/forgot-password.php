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
    <title>mot de passe oublié — mmifolio</title>
  </head>
  <body class="account">
    <header>
      <a href="/"><h1 class="logo">mmi<span>folio</span></h1></a>
    </header>
    <main>
    <?php 
        if(isset($_GET['e']) && !empty($_GET['e'])){
          $err = htmlspecialchars($_GET['e']);
          switch($err){
            case 'email':
              echo '<div class="form-alert form-error">
                <i class="ri-error-warning-line"></i>
                <p>Veuillez indiquer votre adresse email.</p>
                <button onclick="this.parentElement.remove()"><i class="ri-close-line"></i></button>
              </div>';
              break;
            case 'email_invalid':
              echo '<div class="form-alert form-error">
                <i class="ri-error-warning-line"></i>
                <p>Votre email n\'est pas valide.</p>
                <button onclick="this.parentElement.remove()"><i class="ri-close-line"></i></button>
              </div>';
              break;
            case 'email_inexist':
              echo '<div class="form-alert form-error">
                <i class="ri-error-warning-line"></i>
                <p>Cette adresse email ne correspond à aucun compte existant.</p>
                <button onclick="this.parentElement.remove()"><i class="ri-close-line"></i></button>
              </div>';
              break;
            case 'server_err':
              echo '<div class="form-alert form-error">
                <i class="ri-error-warning-line"></i>
                <p>Une erreur est survenue. Si le problème persiste, veuillez contacter un <a href="mailto:hello@axelmarcial.com">administrateur</a>.</p>
                <button onclick="this.parentElement.remove()"><i class="ri-close-line"></i></button>
              </div>';
              break;
            case 'send':
              echo '<div class="form-alert form-success">
                <i class="ri-error-warning-line"></i>
                <p>Le mail a bien été envoyé.</p>
                <button onclick="this.parentElement.remove()"><i class="ri-close-line"></i></button>
              </div>';
              break;
            default:
              echo '';
              break;
          }
        }
      ?>
      <h2>Mot de passe oublié</h2>
      <p>Tu vas recevoir un mail avec un lien qui te renverra sur une page pour réinitialiser ton mot de passe et en définir un nouveau.</p>
      <form action="/src/php/forgot_form.php" method="post">
        <div class="input-container">
          <label for="forgot">Adresse email*</label>
          <input type="email" name="email" id="email" required placeholder="prenom.nom@iut-tarbes.fr">
        </div>
        <button class="form-btn">Recevoir</button>
        <div class="link-line">
          <p>Tu n'es pas encore membre ? <a href="/account/signup" class="gradient-text">S'inscrire</a></p>
          <a href="/account/login" class="gradient-text">Se connecter.</a>
        </div>
      </form>
    </main>
  </body>
</html>
