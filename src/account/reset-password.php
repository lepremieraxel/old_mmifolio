<?php
  if(!isset($_GET['t']) && empty($_GET['t'])){
    header('Location:/');
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
    <title>réinitialiser le mot de passe — mmifolio</title>
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
            case 'passwd':
              echo '<div class="form-alert form-error">
                <i class="ri-error-warning-line"></i>
                <p>Veuillez indiquer un mot de passe.</p>
                <button onclick="this.parentElement.remove()"><i class="ri-close-line"></i></button>
              </div>';
              break;
            case 'repasswd':
              echo '<div class="form-alert form-error">
                <i class="ri-error-warning-line"></i>
                <p>Veuillez confirmer le mot de passe.</p>
                <button onclick="this.parentElement.remove()"><i class="ri-close-line"></i></button>
              </div>';
              break;
            case 'passwd_diff':
              echo '<div class="form-alert form-error">
                <i class="ri-error-warning-line"></i>
                <p>Les mots de passe ne correspondent pas.</p>
                <button onclick="this.parentElement.remove()"><i class="ri-close-line"></i></button>
              </div>';
              break;
            case 'passwd_invalid':
              echo '<div class="form-alert form-error">
                <i class="ri-error-warning-line"></i>
                <p>Le mot de passe n\'est pas valide.</p>
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
            default:
              echo '';
              break;
          }
        }
      ?>
      <h2>Réinitialiser le mot de passe</h2>
      <form action="/src/php/reset_form.php" method="post" id="reset">
        <input type="hidden" name="token" value="<?php echo $_GET['t']?>">
        <div class="input-line">
          <div class="input-container">
            <label for="passwd">Mot de passe*</label>
            <input type="password" name="passwd" id="passwd" required placeholder="•••••••••••••••">
            <small>De 8 à 30 caractères. Minimum 1 minuscule, 1 majuscule, 1 chiffre et 1 symbole.</small>
          </div>
          <div class="input-container">
            <label for="repasswd">Confirmer*</label>
            <input type="password" name="repasswd" id="repasswd" required placeholder="•••••••••••••••">
          </div>
        </div>
        <button class="form-btn">Changer</button>
        <div class="link-line">
          <p>Tu n'es pas encore membre ? <a href="/account/signup" class="gradient-text">S'inscrire</a></p>
          <a href="/account/login" class="gradient-text">Se connecter.</a>
        </div>
      </form>
    </main>
  </body>
</html>
