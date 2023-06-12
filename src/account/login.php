<?php 
  require_once('../config/config.php');
  session_start();
  if(isset($_SESSION)){
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
    <title>connexion — mmifolio</title>
  </head>
  <body class="account">
    <header>
      <a href="/"><h1 class="logo">mmi<span>folio</span></h1></a>
    </header>
    <main>
      <h2>Se connecter</h2>
      <?php 
        if(isset($_GET['e']) && !empty($_GET['e'])){
          $err = htmlspecialchars($_GET['e']);
          switch($err){
            case 'login':
              echo '<div class="form-alert form-error">
                <i class="ri-error-warning-line"></i>
                <p>Veuillez indiquer un nom d\'utilisateur ou une adresse email.</p>
              </div>';
              break;
            case 'passwd':
              echo '<div class="form-alert form-error">
                <i class="ri-error-warning-line"></i>
                <p>Veuillez indiquer un mot de passe.</p>
              </div>';
              break;
            case 'login_inexist':
              echo '<div class="form-alert form-error">
                <i class="ri-error-warning-line"></i>
                <p>Ce nom d\'utilisateur ou cette adresse email n\'est pas associé à un compte existant. <a href="/src/account/signup.php">Inscrivez-vous</a></p>
              </div>';
              break;
            case 'passwd_incorrect':
              echo '<div class="form-alert form-error">
                <i class="ri-error-warning-line"></i>
                <p>Le mot de passe est incorrect. Si vous l\'avez oublié, n\'hésitez pas à le <a href="/src/account/forgot-password.php">réinitialiser</a>.</p>
              </div>';
              break;
            default:
              echo '';
              break;
          }
        }
      ?>
      <form action="/src/php/login_form.php" method="post">
        <div class="input-container">
          <label for="login">Nom d'utilisateur ou adresse email*</label>
          <div class="special-input">
            <span>@</span>
            <input type="text" name="login" id="login" required placeholder="nomdutilisateur ou prenom.nom@iut-tarbes.fr">
          </div>
        </div>
        <div class="input-container">
          <label for="passwd">Mot de passe*</label>
          <div class="special-input">
            <span><i class="ri-lock-password-line"></i></span>
            <input type="password" name="passwd" id="passwd" required placeholder="••••••••••••••••••••••••••••••">
          </div>
        </div>
        <button class="form-btn">Se connecter</button>
        <div class="link-line">
          <p>Tu n'es pas encore membre ? <a href="/src/account/signup.php" class="gradient-text">S'inscrire</a></p>
          <a href="/src/account/forgot-password.php">Mot de passe oublié ?</a>
        </div>
      </form>
    </main>
  </body>
</html>
