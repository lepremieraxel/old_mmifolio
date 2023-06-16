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
  <link href="https://cdn.jsdelivr.net/npm/remixicon@3.2.0/fonts/remixicon.css" rel="stylesheet" />
  <!-- TITLE -->
  <title>profil — mmifolio</title>
</head>

<body>
  <?php include_once('../includes/header_include.php') ?>
  <?php
  $_SESSION['last_page'] = $_SERVER['REQUEST_URI'];
  require_once('../config/config.php');
  $check = $db->prepare('SELECT * FROM users WHERE token = ?');
  $check->execute(array($_GET['token']));
  $user_data = $check->fetch();
  $count = $check->rowCount();

  $select = $db->prepare('SELECT * FROM creations WHERE token_user = ?');
  $select->execute(array($user_data['token']));
  $user_creations = $select->fetchAll();
  $nbCreations = $select->rowCount();

  if ($count > 0) {
    if ($user_data['avatar'] !== '') {
      $avatar = 'data:' . $user_data['avatar_type'] . ';base64,' . base64_encode($user_data['avatar']);
    } else $avatar = '/assets/img/avatar.png';
    echo '<main id="profil">';
    if(isset($_GET['e']) && !empty($_GET['e'])){
      $err = htmlspecialchars($_GET['e']);
      switch($err){
        case 'delete':
          echo '<div class="form-alert form-success">
            <i class="ri-error-warning-line"></i>
            <p>Votre création a bien été supprimé.</p>
            <button onclick="this.parentElement.remove()"><i class="ri-close-line"></i></button>
          </div>';
          break;
        case 'general':
          echo '<div class="form-alert form-success">
            <i class="ri-error-warning-line"></i>
            <p>Vos paramètres généraux ont bien été mis à jour.</p>
            <button onclick="this.parentElement.remove()"><i class="ri-close-line"></i></button>
          </div>';
          break;
        case 'profil':
          echo '<div class="form-alert form-success">
            <i class="ri-error-warning-line"></i>
            <p>Votre profil a bien été mis à jour.</p>
            <button onclick="this.parentElement.remove()"><i class="ri-close-line"></i></button>
          </div>';
          break;
        case 'delete_photo':
          echo '<div class="form-alert form-success">
            <i class="ri-error-warning-line"></i>
            <p>Votre photo de profil a bien été supprimé.</p>
            <button onclick="this.parentElement.remove()"><i class="ri-close-line"></i></button>
          </div>';
          break;
        case 'passwd':
          echo '<div class="form-alert form-success">
            <i class="ri-error-warning-line"></i>
            <p>Votre mot de passe a bien été mis à jour.</p>
            <button onclick="this.parentElement.remove()"><i class="ri-close-line"></i></button>
          </div>';
          break;
        case 'delete_creations':
          echo '<div class="form-alert form-success">
            <i class="ri-error-warning-line"></i>
            <p>Toutes vos créations ont bien été supprimé.</p>
            <button onclick="this.parentElement.remove()"><i class="ri-close-line"></i></button>
          </div>';
          break;
      case 'delete':
      echo '<div class="form-alert form-success">
        <i class="ri-error-warning-line"></i>
        <p>Votre création a bien été supprimé.</p>
        <button onclick="this.parentElement.remove()"><i class="ri-close-line"></i></button>
      </div>';
      break;
        case 'delete_likes':
          echo '<div class="form-alert form-success">
            <i class="ri-error-warning-line"></i>
            <p>Tous vos likes ont bien été supprimé.</p>
            <button onclick="this.parentElement.remove()"><i class="ri-close-line"></i></button>
          </div>';
          break;
        default:
          echo '';
          break;
      }
    }
      echo '<div class="user-container">
        <div class="user-avatar">
          <img src="' . $avatar . '" alt="photo de profil de ' . $user_data['fullname'] . '">
        </div>
        <div class="user-infos">
          <div class="user-line">
            <div class="user-name">
              <p class="fullname">' . $user_data['fullname'] . '</p>
              <p class="username">@' . $user_data['username'] . '</p>
            </div><div class="user-btn">
            ';
    if ($_SESSION['user'] == $_GET['token']) {
        if($user_data['is_verif'] == 0){
            echo '<button class="cta"><a href="/account/verification?token=' . $user_data['token'] . '">Vérifier le compte</a></button>';
          }
      echo '<button class="cta"><a href="/settings/' . $user_data['username'] . '-' . $user_data['token'] . '">Paramètres <i class="ri-settings-3-line"></i></a></button>';
    } else echo '';
    echo '</div></div>
          <div class="user-bio">
            <p class="user-bio-title">Bio</p>
            <p class="user-bio-text">' . $user_data['bio'] . '</p>
          </div>';
          
          if(isset($user_data['website']) || isset($user_data['portfolio']) || isset($user_data['instagram']) || isset($user_data['github']) || isset($user_data['dribbble']) || isset($user_data['behance'])){
            echo '<div class="user-social">';
            if($user_data['website'] !== ''){
              $website_name = explode("://", $user_data['website']);
              echo '<a target="_blank" href="'.$user_data['website'].'"><i class="ri-global-line"></i>&nbsp;'.$website_name[1].'</a>';
            }
            if($user_data['portfolio'] !== ''){
              $portfolio_name = explode("://", $user_data['portfolio']);
              echo '<a target="_blank" href="'.$user_data['portfolio'].'"><i class="ri-pages-line"></i>&nbsp;'.$portfolio_name[1].'</a>';
            }
            if($user_data['instagram'] !== ''){
              echo '<a target="_blank" href="https://instagram.com/'.$user_data['instagram'].'"><i class="ri-instagram-line"></i>&nbsp;'.$user_data['instagram'].'</a>';
            }
            if($user_data['github'] !== ''){
              echo '<a target="_blank" href="https://github.com/'.$user_data['github'].'"><i class="ri-github-fill"></i>&nbsp;'.$user_data['github'].'</a>';
            }
            if($user_data['dribbble'] !== ''){
              echo '<a target="_blank" href="https://dribbble.com/'.$user_data['dribbble'].'"><i class="ri-dribbble-line"></i>&nbsp;'.$user_data['dribbble'].'</a>';
            }
            if($user_data['behance'] !== ''){
              echo '<a target="_blank" href="https://behance.com/'.$user_data['behance'].'"><i class="ri-behance-line"></i>&nbsp;'.$user_data['behance'].'</a>';
            }
            echo '</div>';
          }

        echo '</div>
      </div>
      <div class="creations-container">
        <div class="tab-bar">';
    if ($_SESSION['user'] == $_GET['token']) {
      $select_likes = $db->prepare('SELECT COUNT(*) FROM likes WHERE token_user = ?');
      $select_likes->execute(array($_SESSION['user']));
      $nbLikes = $select_likes->fetchColumn();
      echo '<p class="active" data-tab="creations" onclick="changeTab(this)">Tes&nbsp;créations&nbsp;•&nbsp;' . $nbCreations . '</p><p data-tab="likes" onclick="changeTab(this)">Créations&nbsp;likés&nbsp;•&nbsp;'.$nbLikes.'</p>';
    } else {
      echo '<p class="active">Ses&nbsp;créations&nbsp;•&nbsp;' . $nbCreations . '</p>';
    }
    echo '</div>
        <div class="grid-galery grid-profil" id="profil-creations">';
    if ($_SESSION['user'] == $_GET['token']) {
      echo '<div class="grid-item add">
            <button class="gradient-cta cta"><a href="/add/">Déposer une création <i class="ri-add-box-line"></i></a></button>
          </div>';
    } else echo '';
    if ($nbCreations > 0) {
      foreach ($user_creations as $line_creation) {

        $like_select = $db->prepare('SELECT COUNT(*) FROM likes WHERE token_creation = ?');
        $like_select->execute(array($line_creation['token']));
        $nbLikes = $like_select->fetchColumn();

        $isLiked_select = $db->prepare('SELECT * FROM likes WHERE token_user = ? AND token_creation = ?');
        $isLiked_select->execute(array($_SESSION['user'], $line_creation['token']));
        $isLiked_data = $isLiked_select->rowCount();
    
        if($nbLikes > 0){
          if($isLiked_data > 0){
            $likeBtn = '<button class="liked">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
              <path
                d="M16.5 3C19.5376 3 22 5.5 22 9C22 16 14.5 20 12 21.5C9.5 20 2 16 2 9C2 5.5 4.5 3 7.5 3C9.35997 3 11 4 12 5C13 4 14.64 3 16.5 3Z"
              ></path>
            </svg>
          </button>';
          } else {
            $likeBtn = '<button>
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
              <path
                d="M16.5 3C19.5376 3 22 5.5 22 9C22 16 14.5 20 12 21.5C9.5 20 2 16 2 9C2 5.5 4.5 3 7.5 3C9.35997 3 11 4 12 5C13 4 14.64 3 16.5 3Z"
              ></path>
            </svg>
          </button>';
          }
        } else {
          $likeBtn = '<button>
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
            <path
              d="M16.5 3C19.5376 3 22 5.5 22 9C22 16 14.5 20 12 21.5C9.5 20 2 16 2 9C2 5.5 4.5 3 7.5 3C9.35997 3 11 4 12 5C13 4 14.64 3 16.5 3Z"
            ></path>
          </svg>
        </button>';
        }


        $media = $db->prepare('SELECT * FROM medias WHERE token = ?');
        $media->execute(array($line_creation['apercu']));
        $media_data = $media->fetch();
        $media_count = $media->rowCount();
        if($media_count > 0){
          $apercu_type = explode('/', $media_data['type']);
          $apercu_type = $apercu_type[0];
          if($apercu_type == "image"){
            $apercu = '<img class="grid-item-img" src="data:'.$media_data['type'].';base64,'.base64_encode($media_data['data']).'" alt="img apercu"/>';
          }
          if($apercu_type == "video"){
            $apercu = '<video class="grid-item-img" src="data:'.$media_data['type'].';base64,'.base64_encode($media_data['data']).'" autoplay loop muted webkit-playsinline playsinline></video>';
          }
        } else $apercu = '<img class="grid-item-img" src="/assets/img/default_img.png" alt="img apercu"/>';

        echo '<div class="grid-item">
            ' . $apercu . '
            <div class="grid-item-overlay overlay-user">
              <a href="/creations/' . $line_creation['title'] . '-' . $line_creation['token'] . '">
                <img src="' . $avatar . '" alt="profile picture de ' . $user_data['fullname'] . '" />
                <p>• ' . $user_data['fullname'] . '</p>
              </a>';
        if ($_SESSION['user'] == $_GET['token']) {
          echo '<a href="/update/'.$line_creation['title'].'-'.$line_creation['token'].'-'.$user_data['token'].'" class="edit-btn"><i class="ri-edit-fill"></i></a>';
        } else echo '';
        echo '</div>
            <div class="grid-item-overlay overlay-infos">
              <div class="overlay-line">
                <a href="/creations/' . $line_creation['title'] . '-' . $line_creation['token'] . '">' . $line_creation['title'] . ' • ' . $line_creation['category'] . '</a>
                <div class="overlay-like">
                <form class="like-form" name="like">
                <input type="hidden" value="'.$_SESSION['user'].'" name="token_user"/>
                <input type="hidden" value="'.$line_creation['token'].'" name="token_creation"/>
                <p class="nbLikes">'.$nbLikes.'</p>
                '.$likeBtn.'
                </form>
                </div>
              </div>
            </div>
          </div>';
      }
    }
    if ($_SESSION['user'] !== $_GET['token'] && $nbCreations <= 0) {
      echo '<div class="grid-item add">
          <p>Aucune création pour le moment</p>
        </div>';
    }
    $select = $db->prepare('SELECT * FROM likes WHERE token_user = ?');
    $select->execute(array($_SESSION['user']));
    $allLikes = $select->fetchAll();
    $count_likes = $select->rowCount();
    echo '</div>
    <div class="grid-galery grid-profil" id="profil-likes" style="display:none;">';
    if($count_likes > 0){
      foreach ($allLikes as $like) {
        $select_creation = $db->prepare('SELECT * FROM creations WHERE token = ?');
        $select_creation->execute(array($like['token_creation']));
        $creation_data = $select_creation->fetch();
        $count_data = $select_creation->rowCount();

        $select_likes = $db->prepare('SELECT COUNT(*) FROM likes WHERE token_creation = ?');
        $select_likes->execute(array($creation_data['token']));
        $nbLikes = $select_likes->fetchColumn();

        if($count_data > 0){
          $select_user = $db->prepare('SELECT * FROM users WHERE token = ?');
          $select_user->execute(array($creation_data['token_user']));
          $user_data = $select_user->fetch();

          $like_select = $db->prepare('SELECT COUNT(*) FROM likes WHERE token_creation = ?');
          $like_select->execute(array($creation_data['token']));
          $nbLikes = $like_select->fetchColumn();

          $isLiked_select = $db->prepare('SELECT * FROM likes WHERE token_user = ? AND token_creation = ?');
          $isLiked_select->execute(array($_SESSION['user'], $creation_data['token']));
          $isLiked_data = $isLiked_select->rowCount();
      
          if($nbLikes > 0){
            if($isLiked_data > 0){
              $likeBtn = '<button class="liked">
              <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                <path
                  d="M16.5 3C19.5376 3 22 5.5 22 9C22 16 14.5 20 12 21.5C9.5 20 2 16 2 9C2 5.5 4.5 3 7.5 3C9.35997 3 11 4 12 5C13 4 14.64 3 16.5 3Z"
                ></path>
              </svg>
            </button>';
            } else {
              $likeBtn = '<button>
              <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                <path
                  d="M16.5 3C19.5376 3 22 5.5 22 9C22 16 14.5 20 12 21.5C9.5 20 2 16 2 9C2 5.5 4.5 3 7.5 3C9.35997 3 11 4 12 5C13 4 14.64 3 16.5 3Z"
                ></path>
              </svg>
            </button>';
            }
          } else {
            $likeBtn = '<button>
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
              <path
                d="M16.5 3C19.5376 3 22 5.5 22 9C22 16 14.5 20 12 21.5C9.5 20 2 16 2 9C2 5.5 4.5 3 7.5 3C9.35997 3 11 4 12 5C13 4 14.64 3 16.5 3Z"
              ></path>
            </svg>
          </button>';
          }

          $media = $db->prepare('SELECT * FROM medias WHERE token = ?');
          $media->execute(array($creation_data['apercu']));
          $media_data = $media->fetch();
          $media_count = $media->rowCount();
          if($media_count > 0){
            $apercu_type = explode('/', $media_data['type']);
            $apercu_type = $apercu_type[0];
            if($apercu_type == "image"){
              $apercu = '<img class="grid-item-img" src="data:'.$media_data['type'].';base64,'.base64_encode($media_data['data']).'" alt="img apercu"/>';
            }
            if($apercu_type == "video"){
              $apercu = '<video class="grid-item-img" src="data:'.$media_data['type'].';base64,'.base64_encode($media_data['data']).'" autoplay loop muted webkit-playsinline playsinline></video>';
            }
          } else $apercu = '<img class="grid-item-img" src="/assets/img/default_img.png" alt="img apercu"/>';
          
          if ($user_data['avatar'] !== '') {
              $avatarUser = 'data:' . $user_data['avatar_type'] . ';base64,' . base64_encode($user_data['avatar']);
            } else $avatarUser = '/assets/img/avatar.png';

          echo '<div class="grid-item">
              ' . $apercu . '
              <div class="grid-item-overlay overlay-user">
                <a href="/profil/' . $user_data['username'] . '-' . $user_data['token'] . '">
                  <img src="' . $avatarUser . '" alt="profile picture de ' . $user_data['fullname'] . '" />
                  <p>• ' . $user_data['fullname'] . '</p>
                </a>';
          if ($_SESSION['user'] == $creation_data['token_user']) {
            echo '<a href="/update/'.$creation_data['title'].'-'.$creation_data['token'].'-'.$creation_data['token_user'].'" class="edit-btn"><i class="ri-edit-fill"></i></a>';
          } else echo '';
          echo '</div>
              <div class="grid-item-overlay overlay-infos">
                <div class="overlay-line">
                  <a href="/creations/' . $creation_data['title'] . '-' . $creation_data['token'] . '">' . $creation_data['title'] . ' • ' . $creation_data['category'] . '</a>
                  <div class="overlay-like">
                  <form class="like-form" name="like">
                  <input type="hidden" value="'.$_SESSION['user'].'" name="token_user"/>
                  <input type="hidden" value="'.$creation_data['token'].'" name="token_creation"/>
                  <p class="nbLikes">'.$nbLikes.'</p>
                  '.$likeBtn.'
                  </form>
                  </div>
                </div>
              </div>
            </div>';
        }
      }
    } else echo '<div class="grid-item add">
    <p>Aucun like pour le moment</p>
  </div>';
    echo '</div>
      </div>
    </main>';
  }
  ?>
  <?php include_once('../includes/footer.php'); ?>
  <script src="/src/js/profilTabBar.js"></script>
</body>

</html>