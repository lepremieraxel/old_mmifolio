<?php 
  require_once('../config/config.php');
  if(session_status() == 1){
    session_start();
  }
  if(isset($_SESSION)){
    $check = $db->prepare('SELECT * FROM users WHERE token = ?');
    $check->execute(array($_SESSION['user']));
    $user_data = $check->fetch();
    $count = $check->rowCount();
    if($count <= 0){
      header('Location:/src/account/login.php'); die();
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
    <title>ajouter une création — mmifolio</title>
  </head>
  <body>
    <?php include_once('../includes/header.php')?>
    <main id="add">
      <h2 class="main-title">Ajouter une création</h2>
      <form action="/src/php/ajouter_form.php" method="post" enctype="multipart/form-data">
        <div class="input-line">
          <div class="input-container">
            <label for="title">Pour commencer, il lui faut un titre* :</label>
            <input type="text" name="title"
            id="title" required placeholder="Titre de la création (max.: 100 caractères)">
          </div>
          <div class="input-container">
            <label for="category">Et une catégorie* :</label>
            <select name="category" id="category">
              <option value="">Choisis une catégorie</option>
              <?php 
                foreach($db->query('SELECT * FROM categories') as $category){
                  echo '<option value="'.$category['name'].'">'.$category['name'].'</option>';
                }
              ?>
            </select>
          </div>
        </div>
        <div class="input-container">
          <label for="description">Ensuite, il faut un texte qui décrit le projet* :</label>
          <textarea name="description" id="description" required placeholder="Description de la création (max.: 1000 caractères)"></textarea>
        </div>
        <div class="input-line">
          <div class="input-container">
            <label for="url">Peut-être un lien vers le projet initial :</label>
            <input type="text" name="url" id="url" placeholder="https://lien-vers-le-projet.mmi">
          </div>
          <div class="input-container">
            <label for="date">Et une date* :</label>
            <input type="month" name="date" id="date" required>
          </div>
        </div>
        <div class="input-file">
          <div class="line">
            <div class="input-container">
              <label for="apercu">Maintenant, il lui faut un aperçu* :</label>
              <div class="special-input">
                <input type="file" name="apercu" id="apercu" required accept="image/png, image/jpeg">
                <span><i class="ri-file-upload-line"></i></span>
                <label class="file-label" for="apercu">Choisis un fichier</label>
              </div>
            </div>
            <small>Tu peux choisir une image ou une courte vidéo.
              Affiché en 4:3. Max.: 5Mo.</small>
          </div>
          <div class="input-file-preview"><img src="/assets/img_dev/img3.jpg" alt="image d'aperçu sélectionnée"></div>
        </div>
        <div class="input-file">
          <div class="line">
            <div class="input-container">
              <label for="galery">Et pour finir, il faudrait une belle galerie d'images et de courtes vidéos* :</label>
              <div class="special-input">
                <input type="file" name="galery[]" id="galery" required multiple accept="image/png,image/jpeg,video/mp4,video/avi,video/mov,video/webm">
                <span><i class="ri-file-upload-line"></i></span>
                <label for="galery" class="file-label">Choisis des fichiers</label>
              </div>
            </div>
            <small>Tu peux choisir jusqu'à cinq images et courtes vidéos. Affiché en 4:3. Max.: 5Mo par fichier. Seulement .png, .jpg, .mp4, .avi, .mov et .webm.</small>
          </div>
          <div class="file-preview-grid">
            <img src="/assets/img_dev/img1.png" alt="image de galerie 1">
            <img src="/assets/img_dev/img2.png" alt="image de galerie 2">
            <img src="/assets/img_dev/img3.jpg" alt="image de galerie 3">
            <img src="/assets/img_dev/img4.png" alt="image de galerie 4">
            <video src="/assets/img_dev/Crosswire Launch Video animation web web design website.mp4" autoplay loop muted></video>
          </div>
        </div>
        <button class="form-btn">Ajouter <i class="ri-send-plane-fill"></i></button>
      </form>
    </main>
    <?php include_once('../includes/footer.php');?>
  </body>
</html>
