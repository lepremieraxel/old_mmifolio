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
    <title>paramètres — mmifolio</title>
  </head>
  <body>
  <?php include_once('../includes/header.php')?>
    <main id="setting">
      <h2>Paramètres</h2>
      <div class="tab-bar">
        <p data-tab="general" class="active" onclick="changeTab(this)">Général</p>
        <p data-tab="profil" onclick="changeTab(this)">Modifier le profil</p>
        <p data-tab="password" onclick="changeTab(this)">Mot de passe</p>
        <p data-tab="data" onclick="changeTab(this)">Données</p>
      </div>
      <div class="setting-container" id="setting-general">
        <form action="/src/php/settings_form.php" method="post">
          <?php 
            require_once('../config/config.php');
            $select_user = $db->prepare('SELECT * FROM users WHERE token = ?');
            $select_user->execute(array($_SESSION['user']));
            $user_data = $select_user->fetch();
            $user_count = $select_user->rowCount();
            if($user_count < 1){
              header('Location:/');
            }
            if($user_data['avatar'] !== ''){
              $avatar = 'data:'.$user_data['avatar_type'].';base64,'.base64_encode($user_data['avatar']);
            } else $avatar = '/assets/img/avatar.png';
          ?>
          <div class="input-container">
            <label for="username">Nom d'utilisateur*</label>
            <div class="special-input">
              <span>@</span>
              <input type="text" name="username" id="username" required value="<?php echo $user_data['username'];?>">
            </div>
            <small>De 1 à 30 caractères alphanumériques. (+ "." et "_")</small>
          </div>
          <div class="input-container">
            <label for="email">Adresse email*</label>
            <input type="email" name="email" id="email" required value="<?php echo $user_data['email'];?>">
          </div>
          <button class="cta gradient-cta" name="general-form"><a>Sauvegarder&nbsp;<i class="ri-save-3-line"></i></a></button>
        </form>
      </div>
      <div class="setting-container" id="setting-profil" style="display: none;">
        <form method="post" id="delete-profil-photo"></form>
        <form action="/src/php/settings_form.php" method="post" enctype="multipart/form-data">
          <div class="input-file">
            <img src="<?php echo $avatar;?>" alt="photo de profil" id="current-avatar">
            <div class="input-file-container">
              <div class="input-file-btn-container">
                <div class="input-file-btn file-btn">
                  <input type="file" name="photo" id="photo" accept="image/png, image/jpeg" onchange="avatarInput(this, 'current-avatar');">
                  <label for="photo">Changer&nbsp;<i class="ri-pencil-fill"></i></label>
                </div>
                <div class="input-file-btn delete-btn">
                  <input type="submit" name="delete-photo" id="delete-photo" value="" form="delete-profil-photo">
                  <label for="delete-photo">Supprimer&nbsp;<i class="ri-delete-bin-line"></i></label>
                </div>
              </div>
              <small>Taille recommandé: 256x256 pixels. Max.: 3Mo. Seulement .png et .jpg.<br>Le bouton supprimer permet de supprimer la photo de profil actuelle.</small>
            </div>
          </div>
          <div class="input-container">
            <label for="fullname">Nom d'affichage*</label>
            <input type="text" name="fullname" id="fullname" required value="<?php echo $user_data['fullname'];?>">
          </div>
          <div class="input-container">
            <label for="bio">Bio</label>
            <textarea name="bio" id="bio" maxlength="500"><?php echo $user_data['bio'];?></textarea>
            <small>Jusqu'à 500 caractères.</small>
          </div>
          <div class="separator"></div>
          <div class="input-container">
            <label for="website">Site web</label>
            <input type="url" name="website" id="website" placeholder="https://lien-vers-le-site.com" value="<?php echo $user_data['website'];?>">
          </div>
          <div class="input-container">
            <label for="portfolio">Portfolio</label>
            <input type="url" name="portfolio" id="portfolio" placeholder="https://lien-vers-le-portfolio.com" value="<?php echo $user_data['portfolio'];?>">
          </div>
          <div class="input-container">
            <label for="instagram">Instagram</label>
            <div class="special-input">
              <span><i class="ri-instagram-line"></i></span>
              <input type="text" name="instagram" id="instagram" placeholder="nomdutilisateur" value="<?php echo $user_data['instagram'];?>">
            </div>
          </div>
          <div class="input-container">
            <label for="github">Github</label>
            <div class="special-input">
              <span><i class="ri-github-fill"></i></span>
              <input type="text" name="github" id="github" placeholder="nomdutilisateur" value="<?php echo $user_data['github'];?>">
            </div>
          </div>
          <div class="input-container">
            <label for="dribbble">Dribbble</label>
            <div class="special-input">
              <span><i class="ri-dribbble-line"></i></span>
              <input type="text" name="dribbble" id="dribbble" placeholder="nomdutilisateur" value="<?php echo $user_data['dribbble'];?>">
            </div>
          </div>
          <div class="input-container">
            <label for="behance">Behance</label>
            <div class="special-input">
              <span><i class="ri-behance-fill"></i></span>
              <input type="text" name="behance" id="behance" placeholder="nomdutilisateur" value="<?php echo $user_data['behance'];?>">
            </div>
          </div>
          <button class="cta gradient-cta" name="profil-form"><a>Sauvegarder&nbsp;<i class="ri-save-3-line"></i></a></button>
        </form>
      </div>
      <div class="setting-container" id="setting-password" style="display: none;">
        <form action="/src/php/settings_form.php" method="post">
          <div class="input-container">
            <label for="oldpasswd">Ancien mot de passe*</label>
            <div class="special-input">
              <span><i class="ri-lock-password-line"></i></span>
              <input type="password" name="oldpasswd" id="oldpasswd" required placeholder="•••••••••••••••">
            </div>
          </div>
          <div class="input-container">
            <label for="newpasswd">Nouveau mot de passe*</label>
            <div class="special-input">
              <span><i class="ri-lock-password-line"></i></span>
              <input type="password" name="newpasswd" id="newpasswd" required placeholder="•••••••••••••••">
            </div>
            <small>De 8 à 30 caractères. Minimum 1 minuscule, 1 majuscule, 1 chiffre et 1 caractère spécial. (@,?;.:\!-_+=)</small>
          </div>
          <div class="input-container">
            <label for="renewpasswd">Confirmer*</label>
            <div class="special-input">
              <span><i class="ri-lock-password-line"></i></span>
              <input type="password" name="renewpasswd" id="renewpasswd" required placeholder="•••••••••••••••">
            </div>
          </div>
          <button class="cta gradient-cta" name="password-form"><a>Sauvegarder&nbsp;<i class="ri-save-3-line"></i></a></button>
        </form>
      </div>
      <div class="setting-container" id="setting-data" style="display: none;">
        <div class="delete-data-container">
          <div class="delete-data-text">
            <p class="title">Supprimer toutes les créations</p>
            <p>A pour effet de supprimer toutes les créations que tu as posté. <span>Cette action est irréversible.</span></p>
          </div>
          <button class="delete-data-cta">Supprimer&nbsp;<i class="ri-delete-bin-line"></i></button>
        </div>
        <div class="delete-data-container">
          <div class="delete-data-text">
            <p class="title">Supprimer tous les likes</p>
            <p>A pour effet de supprimer tous les likes que tu as laissé derrière toi. <span>Cette action est irréversible.</span></p>
          </div>
          <button class="delete-data-cta">Supprimer&nbsp;<i class="ri-delete-bin-line"></i></button>
        </div>
        <div class="delete-data-container">
          <div class="delete-data-text">
            <p class="title">Supprimer le compte</p>
            <p>A pour effet de supprimer ton compte ainsi que toutes tes créations et tes likes. <span>Cette action est irréversible.</span></p>
          </div>
          <button class="delete-data-cta">Supprimer&nbsp;<i class="ri-delete-bin-line"></i></button>
        </div>
      </div>
    </main>
    <?php include_once('../includes/footer.php');?>
    <script src="/src/js/settingsTabBar.js"></script>
    <script src="/src/js/inputFilePreview.js"></script>
  </body>
</html>
