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
    if($count <= 0){
      header('Location:/src/account/login.php'); die();
    }
    if($_SESSION['user'] !== $_GET['token_user']){
      header('Location:'.$_SESSION['last_page'].''); die();
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
    <title>modifier une création — mmifolio</title>
  </head>
  <body>
    <?php include_once('../includes/header.php')?>
    <?php 
      $check = $db->prepare('SELECT * FROM users WHERE token = ?');
      $check->execute(array($_GET['token_user']));
      $user_data = $check->fetch();
      $count_user = $check->rowCount();

      $select = $db->prepare('SELECT * FROM creations WHERE token = ?');
      $select->execute(array($_GET['token_creation']));
      $creation_data = $select->fetch();
      $count_creation = $select->rowCount();

      if($count > 0){
        if ($user_data['avatar'] !== '') {
          $avatar = 'data:' . $user_data['avatar_type'] . ';base64,' . base64_encode($user_data['avatar']);
        } else $avatar = '/assets/img/avatar.png';
      }
    ?>
    <main id="update">
      <form action="/src/php/modifier_form.php" method="post" enctype="multipart/form-data">
        <a href="<?php echo $_SESSION['last_page'];?>" class="close-btn"><i class="ri-close-line"></i>&nbsp;Fermer</a>
        <div class="user-infos">
          <a href="/src/profil/profil.php?user=<?php echo $user_data['username'];?>&token=<?php echo $user_data['token'];?>" class="user">
            <img src="<?php echo $avatar;?>" alt="photo de profil de <?php echo $user_data['fullname'];?>">
            <p>• <?php echo $user_data['fullname'];?> • <span>@<?php echo $user_data['username'];?></span></p>
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
            <input type="number" name="date" id="date" required min="2000" max="2100" value="<?php echo $creation_data['date'];?>">
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
              $apercu = '<video src="data:'.$apercu_data['type'].';base64,'.base64_encode($apercu_data['data']).'" autoplay loop muted></video>';
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
              $galery1 = '<img src="data:'.$galery1_data['type'].';base64,'.base64_encode($galery1_data['data']).'" alt="img galery 1"/>';
              $galery1_btn = 'Changer d\'apercu';
              $galery1_filename = 'galery1.'.explode('/', $galery1_data['type'])[1].'';
            }
            if($galery1_type == "video"){
              $galery1 = '<video src="data:'.$galery1_data['type'].';base64,'.base64_encode($galery1_data['data']).'" autoplay loop muted></video>';
              $galery1_btn = 'Changer d\'apercu';
              $galery1_filename = 'galery1.'.explode('/', $galery1_data['type'])[1].'';
            }
          } else {
            $galery1 = '<img src="/assets/img/default_img.png" alt="img galery 1"/>';
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
            <div class="galery-preview" id="galery1-preview">
            <?php echo $galery1;?>
            </div>
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
              $galery2 = '<img src="data:'.$galery2_data['type'].';base64,'.base64_encode($galery2_data['data']).'" alt="img galery 2"/>';
              $galery2_btn = 'Changer d\'apercu';
              $galery2_filename = 'galery2.'.explode('/', $galery2_data['type'])[1].'';
            }
            if($galery2_type == "video"){
              $galery2 = '<video src="data:'.$galery2_data['type'].';base64,'.base64_encode($galery2_data['data']).'" autoplay loop muted></video>';
              $galery2_btn = 'Changer d\'apercu';
              $galery2_filename = 'galery2.'.explode('/', $galery2_data['type'])[1].'';
            }
          } else {
            $galery2 = '';
            $galery2_btn = 'Choisis un fichier';
            $galery2_filename = '';
          }
        ?>
            <div class="input-file">
              <div class="special-input">
                <input type="file" name="galery2" id="galery2" accept="image/png, image/jpeg, video/mp4, video/avi, video/mov, video/webm" onchange="apercuInput(this, 'galery2-preview', 'galery2-filename', 'galery2');">
                <span><i class="ri-file-upload-line"></i></span>
                <label class="file-label" for="galery2"><?php echo $galery2_btn;?></label>
              </div>
              <small>Tu peux choisir une image ou une courte vidéo. Affiché en 4:3. Max.: 5Mo. Seulement .png, .jpg, .mp4, .avi, .mov et .webm.</small>
            </div>
            <p class="galery-filename" id="galery2-filename"><?php echo $galery2_filename;?></p>
            <div class="galery-preview" id="galery2-preview">
            <?php echo $galery2;?>
            </div>
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
              $galery3 = '<img src="data:'.$galery3_data['type'].';base64,'.base64_encode($galery3_data['data']).'" alt="img galery 3"/>';
              $galery3_btn = 'Changer d\'apercu';
              $galery3_filename = 'galery3.'.explode('/', $galery3_data['type'])[1].'';
            }
            if($galery3_type == "video"){
              $galery3 = '<video src="data:'.$galery3_data['type'].';base64,'.base64_encode($galery3_data['data']).'" autoplay loop muted></video>';
              $galery3_btn = 'Changer d\'apercu';
              $galery3_filename = 'galery3.'.explode('/', $galery3_data['type'])[1].'';
            }
          } else {
            $galery3 = '';
            $galery3_btn = 'Choisis un fichier';
            $galery3_filename = '';
          }
        ?>
            <div class="input-file">
              <div class="special-input">
                <input type="file" name="galery3" id="galery3" accept="image/png, image/jpeg, video/mp4, video/avi, video/mov, video/webm" onchange="apercuInput(this, 'galery3-preview', 'galery3-filename', 'galery3');">
                <span><i class="ri-file-upload-line"></i></span>
                <label class="file-label" for="galery3"><?php echo $galery3_btn;?></label>
              </div>
              <small>Tu peux choisir une image ou une courte vidéo. Affiché en 4:3. Max.: 5Mo. Seulement .png, .jpg, .mp4, .avi, .mov et .webm.</small>
            </div>
            <p class="galery-filename" id="galery3-filename"><?php echo $galery3_filename;?></p>
            <div class="galery-preview" id="galery3-preview">
            <?php echo $galery3;?>
            </div>
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
              $galery4 = '<img src="data:'.$galery4_data['type'].';base64,'.base64_encode($galery4_data['data']).'" alt="img galery 4"/>';
              $galery4_btn = 'Changer d\'apercu';
              $galery4_filename = 'galery4.'.explode('/', $galery4_data['type'])[1].'';
            }
            if($galery4_type == "video"){
              $galery4 = '<video src="data:'.$galery4_data['type'].';base64,'.base64_encode($galery4_data['data']).'" autoplay loop muted></video>';
              $galery4_btn = 'Changer d\'apercu';
              $galery4_filename = 'galery4.'.explode('/', $galery4_data['type'])[1].'';
            }
          } else {
            $galery4 = '';
            $galery4_btn = 'Choisis un fichier';
            $galery4_filename = '';
          }
        ?>
            <div class="input-file">
              <div class="special-input">
                <input type="file" name="galery4" id="galery4" accept="image/png, image/jpeg, video/mp4, video/avi, video/mov, video/webm" onchange="apercuInput(this, 'galery4-preview', 'galery4-filename', 'galery4');">
                <span><i class="ri-file-upload-line"></i></span>
                <label class="file-label" for="galery4"><?php echo $galery4_btn;?></label>
              </div>
              <small>Tu peux choisir une image ou une courte vidéo. Affiché en 4:3. Max.: 5Mo. Seulement .png, .jpg, .mp4, .avi, .mov et .webm.</small>
            </div>
            <p class="galery-filename" id="galery4-filename"><?php echo $galery4_filename;?></p>
            <div class="galery-preview" id="galery4-preview">
            <?php echo $galery4;?>
            </div>
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
              $galery5 = '<img src="data:'.$galery5_data['type'].';base65,'.base64_encode($galery5_data['data']).'" alt="img galery 5"/>';
              $galery5_btn = 'Changer d\'apercu';
              $galery5_filename = 'galery5.'.explode('/', $galery5_data['type'])[1].'';
            }
            if($galery5_type == "video"){
              $galery5 = '<video src="data:'.$galery5_data['type'].';base65,'.base64_encode($galery5_data['data']).'" autoplay loop muted></video>';
              $galery5_btn = 'Changer d\'apercu';
              $galery5_filename = 'galery5.'.explode('/', $galery5_data['type'])[1].'';
            }
          } else {
            $galery5 = '';
            $galery5_btn = 'Choisis un fichier';
            $galery5_filename = '';
          }
        ?>
            <div class="input-file">
              <div class="special-input">
                <input type="file" name="galery5" id="galery5" accept="image/png, image/jpeg, video/mp4, video/avi, video/mov, video/webm" onchange="apercuInput(this, 'galery5-preview', 'galery5-filename', 'galery5');">
                <span><i class="ri-file-upload-line"></i></span>
                <label class="file-label" for="galery5"><?php echo $galery5_btn;?></label>
              </div>
              <small>Tu peux choisir une image ou une courte vidéo. Affiché en 4:3. Max.: 5Mo. Seulement .png, .jpg, .mp4, .avi, .mov et .webm.</small>
            </div>
            <p class="galery-filename" id="galery5-filename"><?php echo $galery5_filename;?></p>
            <div class="galery-preview" id="galery5-preview">
            <?php echo $galery5;?>
            </div>
          </div>
        </div>
        <div class="btn-line">
          <button class="cta gradient-cta" name="update_creation"><a>Valider les modifications&nbsp;<i class="ri-save-3-line"></i></a></button>
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
              <input type="hidden" name="delete_creation">
              <?php echo '<input type="hidden" name="delete_creation_redirect" value="user='.$_GET['user'].'&token='.$_SESSION['user'].'"><input type="hidden" name="delete_creation_user_token" value="'.$_SESSION['user'].'">';?>
              <button class="delete-btn">Supprimer&nbsp;<i class="ri-delete-bin-line"></i></button>
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
