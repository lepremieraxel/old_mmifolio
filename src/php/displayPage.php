<?php

require_once('../config/config.php');

function displayPage()
{
  global $db;
  if (isset($_GET['token_creation']) && !empty($_GET['token_creation'])) {
    $select_creation = $db->prepare('SELECT * FROM creations WHERE token = ?');
    $select_creation->execute(array($_GET['token_creation']));
    $creation_data = $select_creation->fetch();
    $creation_count = $select_creation->rowCount();
    if ($creation_count > 0) {
      $select_user = $db->prepare('SELECT * FROM users WHERE token = ?');
      $select_user->execute(array($creation_data['token_user']));
      $user_data = $select_user->fetch();
      $user_count = $select_user->rowCount();
      if ($user_count > 0) {
        if ($user_data['avatar'] !== '') {
          $avatar = 'data:' . $user_data['avatar_type'] . ';base64,' . base64_encode($user_data['avatar']);
        } else $avatar = '/assets/img/avatar.png';

        $apercu_select = $db->prepare('SELECT * FROM medias WHERE token = ?');
        $apercu_select->execute(array($creation_data['apercu']));
        $apercu_data = $apercu_select->fetch();
        $apercu_count = $apercu_select->rowCount();
        if($apercu_count > 0){
          $apercu_type = explode('/', $apercu_data['type']);
          $apercu_type = $apercu_type[0];
          if($apercu_type == "image"){
            $apercu = '<img class="apercu" src="data:'.$apercu_data['type'].';base64,'.base64_encode($apercu_data['data']).'" alt="img apercu"/>';
          }
          if($apercu_type == "video"){
            $apercu = '<video class="apercu" src="data:'.$apercu_data['type'].';base64,'.base64_encode($apercu_data['data']).'" autoplay loop muted></video>';
          }
        } else $apercu = '<img class="apercu" src="/assets/img/default_img.png" alt="img apercu"/>';


        echo '
        <div class="tool-bar">
          <a href="'.$_SESSION['last_page'].'" class="close-btn"><i class="ri-close-line"></i> Fermer</a>';
        if($_SESSION['user'] == $user_data['token']){
          echo '<a href="/" class="edit-btn"><i class="ri-edit-fill"></i>
          </a>';
        }
        echo '</div>
        <div class="user-infos">
        <a href="/src/profil/profil.php?user=' . $user_data['username'] . '&token=' . $user_data['token'] . '" class="user">
        <img src="' . $avatar . '" alt="photo de profil de ' . $user_data['fullname'] . '">
        <p>• ' . $user_data['fullname'] . ' • <span>@' . $user_data['username'] . '</span></p>
        </a>
        <div class="like">
        <p>356</p>
        <button><i class="ri-heart-3-line"></i></button>
        </div>
        </div>
        <div class="creation-infos">
        <p>' . $creation_data['title'] . '</p>
        <p>' . $creation_data['category'] . ' • ' . $creation_data['date'] . '</p>
        </div>
        '.$apercu.'
        <p class="description">' . $creation_data['description'] . '</p>
        <div class="galery">
        ';
        if ($creation_data['galery1'] !== '') {
          $select_galery1 = $db->prepare('SELECT * FROM medias WHERE token = ?');
          $select_galery1->execute(array($creation_data['galery1']));
          $galery1_data = $select_galery1->fetch();
          $galery1_count = $select_galery1->rowCount();
          if($galery1_count > 0){
            $galery1_type = explode('/', $galery1_data['type']);
            $galery1_type = $galery1_type[0];
            if($galery1_type == "image"){
              $galery1 = '<img class="apercu" src="data:'.$galery1_data['type'].';base64,'.base64_encode($galery1_data['data']).'" alt="img de galerie 1"/>';
              $galery1_selector = '<img class="galery-active" src="data:'.$galery1_data['type'].';base64,'.base64_encode($galery1_data['data']).'" alt="img de galeri 1" onclick="changeImg(this);"/>';
              echo '<div id="mainGaleryContainer">'.$galery1.'</div>';
            }
            if($galery1_type == "video"){
              $galery1 = '<video class="apercu" src="data:'.$apercu_data['type'].';base64,'.base64_encode($galery1_data['data']).'" autoplay loop muted></video>';
              $galery1_selector = '<video class="galery-active" src="data:'.$apercu_data['type'].';base64,'.base64_encode($galery1_data['data']).'" autoplay loop muted onclick="changeImg(this);"></video>';
              echo '<div id="mainGaleryContainer">'.$galery1.'</div>';
            }
          } else {
            $galery1 = '<img class="apercu" src="/assets/img/default_img.png" alt="img de galerie 1"/>';
            $galery1_selector = '<img class="galery-active" src="/assets/img/default_img.png" alt="img de galerie 1" onclick="changeImg(this);"/>';
            echo '<div id="mainGaleryContainer">'.$galery1.'</div>';
          }

          if ($creation_data['galery2'] !== '') {
            $select_galery2 = $db->prepare('SELECT * FROM medias WHERE token = ?');
            $select_galery2->execute(array($creation_data['galery2']));
            $galery2_data = $select_galery2->fetch();
            $galery2_count = $select_galery2->rowCount();
            if($galery2_count > 0){
              $galery2_type = explode('/', $galery2_data['type']);
              $galery2_type = $galery2_type[0];
              if($galery2_type == "image"){
                $galery2 = '<img src="data:'.$galery2_data['type'].';base64,'.base64_encode($galery2_data['data']).'" alt="img de galerie 2" onclick="changeImg(this);"/>';
                echo '<div class="galery-selector">
                ' . $galery1_selector . '
                ' . $galery2;
              }
              if($galery2_type == "video"){
                $galery2 = '<video src="data:'.$apercu_data['type'].';base64,'.base64_encode($galery2_data['data']).'" autoplay loop muted onclick="changeImg(this);"></video>';
                echo '<div class="galery-selector">
                ' . $galery1_selector . '
                ' . $galery2;
              }
            } else {
              $galery2 = '<img src="/assets/img/default_img.png" alt="img de galerie 2" onclick="changeImg(this);"/>';
              echo '<div class="galery-selector">
                ' . $galery1_selector . '
                ' . $galery2;
            }
          }

          if ($creation_data['galery3'] !== '') {
            $select_galery3 = $db->prepare('SELECT * FROM medias WHERE token = ?');
            $select_galery3->execute(array($creation_data['galery3']));
            $galery3_data = $select_galery3->fetch();
            $galery3_count = $select_galery3->rowCount();
            if ($galery3_count > 0) {
              $galery3 = 'data:' . $galery3_data['type'] . ';base64,' . base64_encode($galery3_data['data']);
              echo '<img src="' . $galery3 . '" alt="image de galerie 3" onclick="changeImg(this);">';
            }
          }

          if ($creation_data['galery4'] !== '') {
            $select_galery4 = $db->prepare('SELECT * FROM medias WHERE token = ?');
            $select_galery4->execute(array($creation_data['galery4']));
            $galery4_data = $select_galery4->fetch();
            $galery4_count = $select_galery4->rowCount();
            if ($galery4_count > 0) {
              $galery4 = 'data:' . $galery4_data['type'] . ';base64,' . base64_encode($galery4_data['data']);
              echo '<img src="' . $galery4 . '" alt="image de galerie 4" onclick="changeImg(this);">';
            }
          }

          if ($creation_data['galery5'] !== '') {
            $select_galery5 = $db->prepare('SELECT * FROM medias WHERE token = ?');
            $select_galery5->execute(array($creation_data['galery5']));
            $galery5_data = $select_galery5->fetch();
            $galery5_count = $select_galery5->rowCount();
            if ($galery5_count > 0) {
              $galery5 = 'data:' . $galery5_data['type'] . ';base64,' . base64_encode($galery5_data['data']);
              echo '<img src="' . $galery5 . '" alt="image de galerie 5" onclick="changeImg(this);">';
            }
          }
        }
        echo '</div>
      </div>';
      }
    }
  }
}
