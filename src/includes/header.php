<header>
  <button class="burger"><span></span><span></span><span></span></button>
  <a href="/"><h1 class="logo">mmi<span>folio</span></h1></a>
  <nav class="main-nav">
    <a class="nav-item" href="/src/config/unlog.php">Se déconnecter</a>
    <a href="/" class="nav-item">Accueil</a>
    <a href="/src/pages/decouvrir.php" class="nav-item">Découvrir</a>
    <a href="/src/pages/categories.php" class="nav-item">Catégories</a>
    <a href="/src/pages/archives.php" class="nav-item">Archives</a>
    <a href="/src/new/ajouter.php" class="nav-item add-nav-item">Déposer une création</a>
    <div class="separator"></div>
    <?php 
      require_once('/Users/axelm/Desktop/mmifolio/src/config/config.php');
      if(session_status() == 1){
        session_start();
        $_SESSION['connected'] = false;
      }
      if(isset($_SESSION['connected']) && $_SESSION['connected'] = true){
        $check = $db->prepare('SELECT * FROM users WHERE token = ?');
        $check->execute(array($_SESSION['user']));
        $user_data = $check->fetch();
        $count = $check->rowCount();
        if($count > 0){
          if($user_data['avatar'] == null){
            $avatar = '/assets/img/avatar.png';
          } else {
            $avatar = 'data:'.$user_data['avatar_type'].';base64,'.base64_encode($user_data['avatar']);
          }
          echo '<a class="profil-btn" href="/src/profil/profil.php?user='.$user_data['username'].'&token='.$user_data['token'].'"><img src="'.$avatar.'" alt="profile picture"><p>Voir le profil</p></a>';
        } else {
          echo '<button class="cta gradient-cta"><a href="/src/account/login.php">Se connecter <i class="ri-user-line"></i></a></button>';
        }
      }
      ?>
  </nav>
</header>