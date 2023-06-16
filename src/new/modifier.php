<?php 
  require_once('../config/config.php');
  if(session_status() == 1){
    session_start();
  }
  if($_GET['token_user'] !== $_SESSION['user']){
    header('Location:/account/login'); die();
  }
  ?>
<!DOCTYPE html>
<html lang="fr">
  <head>
    <?php include_once('../includes/head.php') ?>
    <title>modifier une création — mmifolio</title>
  </head>
  <body>
    <?php include_once('../includes/header_include.php')?>
    <?php 
      $check = $db->prepare('SELECT * FROM users WHERE token = ?');
      $check->execute(array($_GET['token_user']));
      $user_data = $check->fetch();
      $count_user = $check->rowCount();
      
      if($count_user > 0){
        if ($user_data['avatar'] !== '') {
          $avatar = 'data:' . $user_data['avatar_type'] . ';base64,' . base64_encode($user_data['avatar']);
        } else $avatar = '/assets/img/avatar.png';

        $select = $db->prepare('SELECT * FROM creations WHERE token = ?');
        $select->execute(array($_GET['token_creation']));
        $creation_data = $select->fetch();
        $count_creation = $select->rowCount();
      }
    ?>
    <main id="update">
      <?php 
        if(isset($_GET['e']) && !empty($_GET['e'])){
          $err = htmlspecialchars($_GET['e']);
          switch($err){
            case 'server_err':
              echo '<div class="form-alert form-error">
                <i class="ri-error-warning-line"></i>
                <p>Une erreur s\'est produite. Veuillez réessayer. Si le problème persiste, <a href="mailto:heloo@axelmarcial.com">contactez un administrateur</a>.</p>
                <button onclick="this.parentElement.remove()"><i class="ri-close-line"></i></button>
              </div>';
              break;
            case 'description':
              echo '<div class="form-alert form-error">
                <i class="ri-error-warning-line"></i>
                <p>Veuillez indiquer une description.</p>
                <button onclick="this.parentElement.remove()"><i class="ri-close-line"></i></button>
              </div>';
              break;
            case 'date':
              echo '<div class="form-alert form-error">
                <i class="ri-error-warning-line"></i>
                <p>Veuillez choisir une année.</p>
                <button onclick="this.parentElement.remove()"><i class="ri-close-line"></i></button>
              </div>';
              break;
            case 'category':
              echo '<div class="form-alert form-error">
                <i class="ri-error-warning-line"></i>
                <p>Veuillez choisir une catégorie.</p>
                <button onclick="this.parentElement.remove()"><i class="ri-close-line"></i></button>
              </div>';
              break;
            case 'title':
              echo '<div class="form-alert form-error">
                <i class="ri-error-warning-line"></i>
                <p>Veuillez indiquer un titre.</p>
                <button onclick="this.parentElement.remove()"><i class="ri-close-line"></i></button>
              </div>';
              break;
            default:
              echo '';
              break;
          }
        }
      ?>
      <form action="/src/php/modifier_form.php" method="post" enctype="multipart/form-data">
        <input type="hidden" name="token_creation" value="<?php echo $_GET['token_creation'];?>">
        <input type="hidden" name="old_title" value="<?php echo $_GET['title'];?>">
        <a href="<?php echo $_SESSION['last_page'];?>" class="close-btn"><i class="ri-close-line"></i>&nbsp;Fermer</a>
        <div class="input-container">
          <label for="link">Lien vers le projet</label>
          <input type="url" name="link" id="link" value="<?php echo $creation_data['link'];?>">
        </div>
        <div class="user-infos">
          <a href="/profil/<?php echo $user_data['username'];?>-<?php echo $user_data['token'];?>" class="user">
            <img src="<?php echo $avatar;?>" alt="photo de profil de <?php echo $user_data['fullname'];?>">
            <p>•&nbsp;<?php echo $user_data['fullname'];?> •&nbsp;<span>@<?php echo $user_data['username'];?></span></p>
          </a>
          <button class="cta gradient-cta" name="update_creation"><a>Valider les modifications&nbsp;<i class="ri-save-3-line"></i></a></button>
        </div>
        <div class="input-line">
          <div class="input-container">
            <label for="title">Titre de la création*</label>
            <input type="text" name="title" id="title" value="<?php echo $creation_data['title'];?>" required maxlength="100">
          </div>
          <div class="input-container">
            <label for="category">Catégorie*</label>
            <select name="category" id="category" required>
              <option value="<?php echo $creation_data['category_flat'];?>"><?php echo $creation_data['category'];?></option>
              <?php 
                foreach($db->query('SELECT * FROM categories') as $category){
                  if($category['flat_name'] != $creation_data['category_flat']){
                    echo '<option value="'.$category['flat_name'].'">'.$category['name'].'</option>';
                  }
                }
              ?>
            </select>
          </div>
          <div class="input-container">
            <label for="date">Année*</label>
            <input type="number" name="date" id="date" required min="2000" max="2100" inputmode="numeric" value="<?php echo $creation_data['date'];?>">
          </div>
        </div>
        <?php 
          $select_apercu = $db->prepare('SELECT * FROM medias WHERE token = ?');
          $select_apercu->execute(array($creation_data['apercu']));
          $apercu_data = $select_apercu->fetch();
          $apercu_count = $select_apercu->rowCount();
          if($apercu_count > 0){
            $apercu_type = explode('/', $apercu_data['type']);
            $apercu_type = $apercu_type[0];
            if($apercu_type == "image"){
              $apercu = '<img src="data:'.$apercu_data['type'].';base64,'.base64_encode($apercu_data['data']).'" alt="img apercu"/>';
            }
            if($apercu_type == "video"){
              $apercu = '<video src="data:'.$apercu_data['type'].';base64,'.base64_encode($apercu_data['data']).'" autoplay loop muted webkit-playsinline playsinline></video>';
            }
          } else $apercu = '<img src="/assets/img/default_img.png" alt="img apercu"/>';
        ?>
        <div class="apercu-preview" id="apercu-preview">
        <?php echo $apercu;?>
        </div>
        <div class="input-file">
          <div class="special-input">
            <input type="file" name="apercu" id="apercu" accept="image/png, image/jpeg, video/mp4, video/avi, video/mov, video/webm" onchange="apercuInput(this, 'apercu-preview', 'apercu-label', 'apercu');">
            <span><i class="ri-file-upload-line"></i></span>
            <label class="file-label" for="apercu" id="apercu-label">Changer d'apercu</label>
          </div>
          <small>Tu peux choisir une image ou une courte vidéo. Affiché en 4:3. Max.: 5Mo. Seulement .png, .jpg, .mp4, .avi, .mov et .webm.</small>
        </div>
        <div class="input-container"><label for="description">Description*</label><small>Texte de présentation de la création. (max.: 1000 caractères)</small><textarea name="description" id="description" required><?php echo $creation_data['description'];?></textarea></div>
        <div class="galery-container input-container">
          <label for="">Galerie d'images et vidéos*</label>
          <small>Tu peux choisir de 1 à 5 images ou courtes vidéos. Affiché en 4:3. Max.: 5Mo par fichier. Seulement .png, .jpg, .mp4, .avi, .mov et .webm.</small>
          <div class="input-file-line">
          <?php 
          $select_galery1 = $db->prepare('SELECT * FROM medias WHERE token = ?');
          $select_galery1->execute(array($creation_data['galery1']));
          $galery1_data = $select_galery1->fetch();
          $galery1_count = $select_galery1->rowCount();
          if($galery1_count > 0){
            $galery1_type = explode('/', $galery1_data['type']);
            $galery1_type = $galery1_type[0];
            if($galery1_type == "image"){
              $galery1 = '<div class="galery-preview" id="galery4-preview"><img src="data:'.$galery1_data['type'].';base64,'.base64_encode($galery1_data['data']).'" alt="img galery 1"/></div>';
              $galery1_btn = 'Changer de fichier';
              $galery1_filename = 'galery1.'.explode('/', $galery1_data['type'])[1].'';
            }
            if($galery1_type == "video"){
              $galery1 = '<div class="galery-preview" id="galery4-preview"><video src="data:'.$galery1_data['type'].';base64,'.base64_encode($galery1_data['data']).'" autoplay loop muted webkit-playsinline playsinline></video></div>';
              $galery1_btn = 'Changer de fichier';
              $galery1_filename = 'galery1.'.explode('/', $galery1_data['type'])[1].'';
            }
          } else {
            $galery1 = '<div class="galery-preview" id="galery4-preview"><img src="/assets/img/default_img.png" alt="img galery 1"/></div>';
            $galery1_btn = 'Choisis un fichier';
            $galery1_filename = '';
          }
        ?>
            <div class="input-file">
              <div class="special-input">
                <input type="file" name="galery1" id="galery1" accept="image/png, image/jpeg, video/mp4, video/avi, video/mov, video/webm" onchange="apercuInput(this, 'galery1-preview', 'galery1-filename', 'galery1');">
                <span><i class="ri-file-upload-line"></i></span>
                <label class="file-label" for="galery1"><?php echo $galery1_btn;?></label>
              </div>
              <small>Tu peux choisir une image ou une courte vidéo. Affiché en 4:3. Max.: 5Mo. Seulement .png, .jpg, .mp4, .avi, .mov et .webm.</small>
            </div>
            <p class="galery-filename" id="galery1-filename"><?php echo $galery1_filename;?></p>
            <?php echo $galery1;?>
          </div>
          <div class="input-file-line">
          <?php 
          $select_galery2 = $db->prepare('SELECT * FROM medias WHERE token = ?');
          $select_galery2->execute(array($creation_data['galery2']));
          $galery2_data = $select_galery2->fetch();
          $galery2_count = $select_galery2->rowCount();
          if($galery2_count > 0){
            $galery2_type = explode('/', $galery2_data['type']);
            $galery2_type = $galery2_type[0];
            if($galery2_type == "image"){
              $galery2 = '<div class="galery-preview" id="galery4-preview"><img src="data:'.$galery2_data['type'].';base64,'.base64_encode($galery2_data['data']).'" alt="img galery 2"/></div>';
              $galery2_btn = 'Changer de fichier';
              $galery2_filename = 'galery2.'.explode('/', $galery2_data['type'])[1].'';
            }
            if($galery2_type == "video"){
              $galery2 = '<div class="galery-preview" id="galery4-preview"><video src="data:'.$galery2_data['type'].';base64,'.base64_encode($galery2_data['data']).'" autoplay loop muted webkit-playsinline playsinline></video></div>';
              $galery2_btn = 'Changer de fichier';
              $galery2_filename = 'galery2.'.explode('/', $galery2_data['type'])[1].'';
            }
          } else {
            $galery2 = '';
            $galery2_btn = 'Choisis un fichier';
            $galery2_filename = '';
          }
        ?>
            <div class="input-file">
              <div class="input-group">
                <div class="special-input">
                  <input type="file" name="galery2" id="galery2" accept="image/png, image/jpeg, video/mp4, video/avi, video/mov, video/webm" onchange="apercuInput(this, 'galery2-preview', 'galery2-filename', 'galery2');">
                  <span><i class="ri-file-upload-line"></i></span>
                  <label class="file-label" for="galery2"><?php echo $galery2_btn;?></label>
                </div>
                <label class="checkbox" for="delete_galery2">
                <?php
                  if($galery2 !== ''){
                    echo '<input type="checkbox" name="delete_galery2" id="delete_galery2">
                    &emsp;Supprimer l\'image de galerie 2';
                  }
                ?>
                </label>
              </div>
              <small>Tu peux choisir une image ou une courte vidéo. Affiché en 4:3. Max.: 5Mo. Seulement .png, .jpg, .mp4, .avi, .mov et .webm.</small>
            </div>
            <p class="galery-filename" id="galery2-filename"><?php echo $galery2_filename;?></p>
            <?php echo $galery2;?>
          </div>
          <div class="input-file-line">
          <?php 
          $select_galery3 = $db->prepare('SELECT * FROM medias WHERE token = ?');
          $select_galery3->execute(array($creation_data['galery3']));
          $galery3_data = $select_galery3->fetch();
          $galery3_count = $select_galery3->rowCount();
          if($galery3_count > 0){
            $galery3_type = explode('/', $galery3_data['type']);
            $galery3_type = $galery3_type[0];
            if($galery3_type == "image"){
              $galery3 = '<div class="galery-preview" id="galery4-preview"><img src="data:'.$galery3_data['type'].';base64,'.base64_encode($galery3_data['data']).'" alt="img galery 3"/></div>';
              $galery3_btn = 'Changer de fichier';
              $galery3_filename = 'galery3.'.explode('/', $galery3_data['type'])[1].'';
            }
            if($galery3_type == "video"){
              $galery3 = '<div class="galery-preview" id="galery4-preview"><video src="data:'.$galery3_data['type'].';base64,'.base64_encode($galery3_data['data']).'" autoplay loop muted webkit-playsinline playsinline></video></div>';
              $galery3_btn = 'Changer de fichier';
              $galery3_filename = 'galery3.'.explode('/', $galery3_data['type'])[1].'';
            }
          } else {
            $galery3 = '';
            $galery3_btn = 'Choisis un fichier';
            $galery3_filename = '';
          }
        ?>
            <div class="input-file">
              <div class="input-group">
                <div class="special-input">
                  <input type="file" name="galery3" id="galery3" accept="image/png, image/jpeg, video/mp4, video/avi, video/mov, video/webm" onchange="apercuInput(this, 'galery3-preview', 'galery3-filename', 'galery3');">
                  <span><i class="ri-file-upload-line"></i></span>
                  <label class="file-label" for="galery3"><?php echo $galery3_btn;?></label>
                </div>
                <label class="checkbox" for="delete_galery3">
                <?php
                  if($galery3 !== ''){
                    echo '<input type="checkbox" name="delete_galery3" id="delete_galery3">
                    &emsp;Supprimer l\'image de galerie 3';
                  }
                ?>
                </label>
              </div>
              <small>Tu peux choisir une image ou une courte vidéo. Affiché en 4:3. Max.: 5Mo. Seulement .png, .jpg, .mp4, .avi, .mov et .webm.</small>
            </div>
            <p class="galery-filename" id="galery3-filename"><?php echo $galery3_filename;?></p>
            <?php echo $galery3;?>
          </div>
          <div class="input-file-line">
          <?php 
          $select_galery4 = $db->prepare('SELECT * FROM medias WHERE token = ?');
          $select_galery4->execute(array($creation_data['galery4']));
          $galery4_data = $select_galery4->fetch();
          $galery4_count = $select_galery4->rowCount();
          if($galery4_count > 0){
            $galery4_type = explode('/', $galery4_data['type']);
            $galery4_type = $galery4_type[0];
            if($galery4_type == "image"){
              $galery4 = '<div class="galery-preview" id="galery4-preview"><img src="data:'.$galery4_data['type'].';base64,'.base64_encode($galery4_data['data']).'" alt="img galery 4"/></div>';
              $galery4_btn = 'Changer de fichier';
              $galery4_filename = 'galery4.'.explode('/', $galery4_data['type'])[1].'';
            }
            if($galery4_type == "video"){
              $galery4 = '<div class="galery-preview" id="galery4-preview"><video src="data:'.$galery4_data['type'].';base64,'.base64_encode($galery4_data['data']).'" autoplay loop muted webkit-playsinline playsinline></video></div>';
              $galery4_btn = 'Changer de fichier';
              $galery4_filename = 'galery4.'.explode('/', $galery4_data['type'])[1].'';
            }
          } else {
            $galery4 = '';
            $galery4_btn = 'Choisis un fichier';
            $galery4_filename = '';
          }
        ?>
            <div class="input-file">
              <div class="input-group">
                <div class="special-input">
                  <input type="file" name="galery4" id="galery4" accept="image/png, image/jpeg, video/mp4, video/avi, video/mov, video/webm" onchange="apercuInput(this, 'galery4-preview', 'galery4-filename', 'galery4');">
                  <span><i class="ri-file-upload-line"></i></span>
                  <label class="file-label" for="galery4"><?php echo $galery4_btn;?></label>
                </div>
                <label class="checkbox" for="delete_galery4">
                <?php
                  if($galery4 !== ''){
                    echo '<input type="checkbox" name="delete_galery4" id="delete_galery4">
                    &emsp;Supprimer l\'image de galerie 4';
                  }
                ?>
                </label>
              </div>
              <small>Tu peux choisir une image ou une courte vidéo. Affiché en 4:3. Max.: 5Mo. Seulement .png, .jpg, .mp4, .avi, .mov et .webm.</small>
            </div>
            <p class="galery-filename" id="galery4-filename"><?php echo $galery4_filename;?></p>
            <?php echo $galery4;?>
          </div>
          <div class="input-file-line">
          <?php 
          $select_galery5 = $db->prepare('SELECT * FROM medias WHERE token = ?');
          $select_galery5->execute(array($creation_data['galery5']));
          $galery5_data = $select_galery5->fetch();
          $galery5_count = $select_galery5->rowCount();
          if($galery5_count > 0){
            $galery5_type = explode('/', $galery5_data['type']);
            $galery5_type = $galery5_type[0];
            if($galery5_type == "image"){
              $galery5 = '<div class="galery-preview" id="galery4-preview"><img src="data:'.$galery5_data['type'].';base64,'.base64_encode($galery5_data['data']).'" alt="img galery 5"/></div>';
              $galery5_btn = 'Changer de fichier';
              $galery5_filename = 'galery5.'.explode('/', $galery5_data['type'])[1].'';
            }
            if($galery5_type == "video"){
              $galery5 = '<div class="galery-preview" id="galery4-preview"><video src="data:'.$galery5_data['type'].';base64,'.base64_encode($galery5_data['data']).'" autoplay loop muted webkit-playsinline playsinline></video></div>';
              $galery5_btn = 'Changer de fichier';
              $galery5_filename = 'galery5.'.explode('/', $galery5_data['type'])[1].'';
            }
          } else {
            $galery5 = '';
            $galery5_btn = 'Choisis un fichier';
            $galery5_filename = '';
          }
        ?>
            <div class="input-file">
              <div class="input-group">
                <div class="special-input">
                  <input type="file" name="galery5" id="galery5" accept="image/png, image/jpeg, video/mp4, video/avi, video/mov, video/webm" onchange="apercuInput(this, 'galery5-preview', 'galery5-filename', 'galery5');">
                  <span><i class="ri-file-upload-line"></i></span>
                  <label class="file-label" for="galery5"><?php echo $galery5_btn;?></label>
                </div>
                <label class="checkbox" for="delete_galery5">
                <?php
                  if($galery5 !== ''){
                    echo '<input type="checkbox" name="delete_galery5" id="delete_galery5">
                    &emsp;Supprimer l\'image de galerie 5';
                  }
                ?>
                </label>
              </div>
              <small>Tu peux choisir une image ou une courte vidéo. Affiché en 4:3. Max.: 5Mo. Seulement .png, .jpg, .mp4, .avi, .mov et .webm.</small>
            </div>
            <p class="galery-filename" id="galery5-filename"><?php echo $galery5_filename;?></p>
            <?php echo $galery5;?>
          </div>
        </div>
        <div class="btn-line">
          <button class="cta gradient-cta" name="update_creation"><a>Valider&nbsp;les modifications&nbsp;<i class="ri-save-3-line"></i></a></button>
          <button class="delete-data-cta" type="button" onclick="openModal('creation');">Supprimer&nbsp;<i class="ri-delete-bin-line"></i></button>
        </div>
      </form>
      <div class="setting-data-modal" data-modal="creation" style="display: none;">
        <div class="modal-inner">
          <p class="title">Es-tu sûr de vouloir supprimer cette création ?</p>
          <div class="separator"></div>
          <p>Si tu acceptes, elle sera supprimée définitivement.<br><br><span>Cette action est irréversible.</span></p>
          <div class="separator"></div>
          <div class="btn-line">
            <button class="cta" onclick="closeModal(this);"><a>Annuler&nbsp;<i class="ri-close-line"></i></a></button>
            <form action="/src/php/modifier_form.php" method="post" class="modal-form">
              <?php echo '<input type="hidden" name="delete_creation_redirect" value="'.$_GET['user'].'-'.$_SESSION['user'].'"><input type="hidden" name="delete_token_creation" value="'.$_GET['token_creation'].'">';?>
              <button class="delete-btn" name="delete_creation">Supprimer&nbsp;<i class="ri-delete-bin-line"></i></button>
            </form>
          </div>
        </div>
      </div>
    </main>
    <?php include_once('../includes/footer.php');?>
    <script src="/src/js/inputFilePreview.js"></script>
    <script src="/src/js/openModalDelete.js"></script>
  </body>
</html>
