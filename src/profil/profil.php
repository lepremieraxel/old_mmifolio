
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
    <title>profil — mmifolio</title>
  </head>
  <body>
  <?php include_once('../includes/header.php')?>
  <?php
    require_once('../config/config.php');
    $check = $db->prepare('SELECT * FROM users WHERE token = ?');
    $check->execute(array($_GET['token']));
    $user_data = $check->fetch();
    $count = $check->rowCount();

    $select = $db->prepare('SELECT * FROM creations WHERE token_user = ?');
    $select->execute(array($user_data['token']));
    $user_creations = $select->fetchAll();
    $nbCreations = $select->rowCount();

    if($count > 0){
      if($user_data['avatar'] !== ''){
        $avatar = 'data:'.$user_data['avatar_type'].';base64,'.base64_encode($user_data['avatar']);
      } else $avatar = '/assets/img/avatar.png';
      echo '<main id="profil">
      <div class="user-container">
        <div class="user-avatar">
          <img src="'.$avatar.'" alt="photo de profil de '.$user_data['fullname'].'">
        </div>
        <div class="user-infos">
          <div class="user-line">
            <div class="user-name">
              <p class="fullname">'.$user_data['fullname'].'</p>
              <p class="username">@'.$user_data['username'].'</p>
            </div>
            ';
            if($_SESSION['user'] == $_GET['token']){
              echo '<button class="cta"><a href="/src/profil/settings.php?user='.$user_data['username'].'&token='.$user_data['token'].'">Paramètres <i class="ri-settings-3-line"></i></a></button>';
            } else echo '';
          echo '</div>
          <div class="user-bio">
            <p class="user-bio-title">Bio</p>
            <p class="user-bio-text">'.$user_data['bio'].'</p>
          </div>
        </div>
      </div>
      <div class="creations-container">
        <div class="tab-bar">';
        if($_SESSION['user'] == $_GET['token']){
          echo '<p class="active">Tes créations • '.$nbCreations.'</p><p>Créations likés • 0</p>';
        } else {
          echo '<p class="active">Ses créations • '.$nbCreations.'</p>';
        }
        echo '</div>
        <div class="grid-galery grid-profil">';
        if($_SESSION['user'] == $_GET['token']){
          echo '<div class="grid-item add">
            <button class="gradient-cta cta"><a href="/src/new/ajouter.php">Déposer une création <i class="ri-add-box-line"></i></a></button>
          </div>';
        } else echo '';
        if($_SESSION['user'] == $_GET['token'] && $nbCreations > 0){
          foreach($user_creations as $line_creation){
            $media = $db->prepare('SELECT * FROM medias WHERE token = ?');
            $media->execute(array($line_creation['apercu']));
            $media_data = $media->fetch();
            $media_count = $media->rowCount();
            if($media_count > 0){
              $apercu = 'data:'.$media_data['type'].';base64,'.base64_encode($media_data['data']);
            } else $apercu = '/assets/img/default_img.png';

            echo '<div class="grid-item">
            <img
              class="grid-item-img"
              src="'.$apercu.'"
              alt="img apercu"
            />
            <div class="grid-item-overlay overlay-user">
              <a href="/src/pages/page.php?title='.$line_creation['title'].'&token='.$line_creation['token'].'">
                <img src="'.$avatar.'" alt="profile picture de '.$user_data['fullname'].'" />
                <p>• '.$user_data['fullname'].'</p>
              </a>';
              if($_SESSION['user'] == $_GET['token']){
                echo '<a href="/" class="edit-btn"><i class="ri-edit-fill"></i></a>';
              } else echo '';
            echo '</div>
            <div class="grid-item-overlay overlay-infos">
              <div class="overlay-line">
                <a href="/src/pages/page.php?title='.$line_creation['title'].'&token='.$line_creation['token'].'">'.$line_creation['title'].' • '.$line_creation['category'].'</a>
                <div class="overlay-like">
                  <p>356</p>
                  <button>
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                      <path
                        d="M16.5 3C19.5376 3 22 5.5 22 9C22 16 14.5 20 12 21.5C9.5 20 2 16 2 9C2 5.5 4.5 3 7.5 3C9.35997 3 11 4 12 5C13 4 14.64 3 16.5 3Z"
                      ></path>
                    </svg>
                  </button>
                </div>
              </div>
            </div>
          </div>';
          }
        }
        if($_SESSION['user'] !== $_GET['token'] && $nbCreations <= 0){
          echo '<div class="grid-item add">
          <p>Aucune création pour le moment</p>
        </div>';
        }
          echo '</div>
      </div>
    </main>';
    }
  ?>
    <footer>
      <div class="footer-up-container">
        <a href="/" class="logo"
          ><p>mmi<span>folio</span></p></a
        >
        <div class="nav-container">
          <nav>
            <p class="nav-title">Explorer</p>
            <a href="/">Accueil</a>
            <a href="/">Découvrir</a>
            <a href="/">Catégories</a>
            <a href="/">Archives</a>
            <a href="/">Déposer une création</a>
          </nav>
          <nav>
            <p class="nav-title">À propos</p>
            <a href="/">Se connecter</a>
            <a href="/">S'inscrire</a>
            <a href="/">Contact</a>
            <a href="/">Rejoindre le projet</a>
            <a href="/">Mentions légales</a>
          </nav>
          <nav>
            <p class="nav-title">Liens utiles</p>
            <a href="/">Emploi du temps</a>
            <a href="/">Webmail IUT</a>
            <a href="/">Moodle</a>
            <a href="/">Festival MMI</a>
            <a href="/">Site IUT</a>
          </nav>
        </div>
      </div>
      <p class="footer-line">
        mmi<span>folio</span> • 2023 • par mmi, pour mmi • by
        <a href="https://axelmarcial.com">lepremieraxel</a>
      </p>
    </footer>
  </body>
</html>