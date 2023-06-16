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
    <title>accueil — mmifolio</title>
  </head>
  <body>
    <?php include_once('../includes/header_include.php')?>
    <main id="contact">
    <?php 
        if(isset($_GET['e']) && !empty($_GET['e'])){
          $err = htmlspecialchars($_GET['e']);
          switch($err){
            case 'send':
              echo '<div class="form-alert form-success">
                <i class="ri-error-warning-line"></i>
                <p>Votre message a bien été envoyé. Il sera traité le plus rapidement possible.</p>
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
            case 'reason':
              echo '<div class="form-alert form-error">
                <i class="ri-error-warning-line"></i>
                <p>Veuillez sélectionner une raison.</p>
                <button onclick="this.parentElement.remove()"><i class="ri-close-line"></i></button>
              </div>';
              break;
            case 'message':
              echo '<div class="form-alert form-error">
                <i class="ri-error-warning-line"></i>
                <p>Veuillez indiquer un message.</p>
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
            default:
              echo '';
              break;
          }
        }

        require_once('../config/config.php');

        if($_SESSION['user'] !== ''){
          $select_user = $db->prepare('SELECT * FROM users WHERE token = ?');
          $select_user->execute(array($_SESSION['user']));
          $user_data = $select_user->fetch();
          $user_count = $select_user->rowCount();
        }
      ?>
      <h2>Contact</h2>
      <form action="/src/php/contact_form.php" method="post">
        <div class="input-line">
          <div class="input-container">
            <label for="fullname">Nom & prénom*</label>
            <input type="text" name="fullname" id="fullname" required placeholder="Nom Prénom" minlength="3" maxlength="50" value="<?php if($user_count > 0){
              echo $user_data['fullname'];
            } ?>">
          </div>
          <div class="input-container">
            <label for="reason">Raison*</label>
            <select name="reason" id="reason">
              <?php
                if(isset($_GET['r']) && !empty($_GET['r'])){
                  $r = htmlspecialchars($_GET['r']);
                  switch($r){
                    case 'contact':
                      echo '<option value="simple_message">Simple message</option>
                      <option value="question">Question</option>
                      <option value="bug_erreur">Bug ou erreur</option>
                      <option value="rejoindre">Rejoindre le projet</option>';
                      break;
                    case 'join':
                      echo '<option value="rejoindre">Rejoindre le projet</option>
                      <option value="simple_message">Simple message</option>
                      <option value="question">Question</option>
                      <option value="bug_erreur">Bug ou erreur</option>';
                      break;
                    default:
                      echo '<option value="question">Question</option>
                      <option value="simple_message">Simple message</option>
                      <option value="bug_erreur">Bug ou erreur</option>
                      <option value="rejoindre">Rejoindre le projet</option>';
                      break;
                  }
                } else echo '<option value="question">Question</option>
                <option value="simple_message">Simple message</option>
                <option value="bug_erreur">Bug ou erreur</option>
                <option value="rejoindre">Rejoindre le projet</option>';
              ?>
            </select>
          </div>
        </div>
        <div class="input-container">
          <label for="email">Adresse email*</label>
          <input type="email" name="email" id="email" required placeholder="prenom.nom@iut-tarbes.fr" value="<?php if($user_count > 0){
              echo $user_data['email'];
            } ?>">
        </div>
        <div class="input-container">
          <label for="message">Message*</label>
          <textarea name="message" id="message" required placeholder="J'ai remarqué que ..."></textarea>
        </div>
        <button class="form-btn">Envoyer&nbsp;<i class="ri-send-plane-line"></i></button>
      </form>
    </main>
    <?php include_once('../includes/footer.php');?>
  </body>
</html>
