<?php 
  require_once('../config/config.php');
  if(!isset($_GET['token']) && empty($_GET['token'])){
    header('Location:/'); die();
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
    <title>vérification — mmifolio</title>
  </head>
  <body class="account">
    <header>
      <a href="/"
        ><h1 class="logo">mmi<span>folio</span></h1></a
      >
    </header>
    <main>
      <h2>Vérification de l'email</h2>
      <p>Tu vas recevoir un mail avec un code qui te permet de valider la création de ton compte. Si tu ne reçois pas le mail, <a id="resendBtn" href="#" data-btn="<?php echo $_GET['token'];?>">clique ici</a>.</p>
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
            default:
              echo '';
              break;
          }
        }
      ?>
      <form action="/src/php/verification_form.php" method="post">
        <input type="hidden" name="token" value="<?php echo $_GET['token']?>">
        <div class="input-container">
          <label for="otp1">Code de vérification*</label>
          <div id="otp">
            <input type="text" name="otp1" id="first" required maxlength="1"/>
            <input type="text" name="otp2" id="second" required maxlength="1"/>
            <input type="text" name="otp3" id="thirst" required maxlength="1"/>
            <p>-</p>
            <input type="text" name="otp4" id="fourth" required maxlength="1"/>
            <input type="text" name="otp5" id="fifth" required maxlength="1"/>
            <input type="text" name="otp6" id="sixth" required maxlength="1"/>
          </div>
        </div>
        <button class="form-btn">Valider</button>
        <div class="link-line">
          <p>
            Tu as déjà un compte ?
            <a href="/account/login" class="gradient-text">Se connecter.</a>
          </p> 
        </div>
      </form>
    </main>
    <script src="/src/js/inputFilePreview.js"></script>
    <script src="/src/js/verifOTP.js"></script>
    <script src="/src/js/resendCode.js"></script>
  </body>
</html>
