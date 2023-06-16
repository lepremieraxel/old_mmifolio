<header>
  <button class="burger"><span></span><span></span><span></span></button>
  <a href="/"><h1 class="logo">mmi<span>folio</span></h1></a>
  <nav class="main-nav">
    <a href="/" class="nav-item">Accueil</a>
    <a href="/pages/decouvrir" class="nav-item">Découvrir</a>
    <a href="/pages/categories" class="nav-item">Catégories</a>
    <a href="/pages/archives" class="nav-item">Archives</a>
    <a href="/add/" class="nav-item add-nav-item add-btn">Déposer une création</a>
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
          echo '<a class="profil-btn" href="/profil/'.$user_data['username'].'-'.$user_data['token'].'"><img src="'.$avatar.'" alt="profile picture"><p>Voir le profil</p></a>';
        } else {
          echo '<button class="cta gradient-cta"><a href="/account/login">Se&nbsp;connecter&nbsp;<i class="ri-user-line"></i></a></button>';
        }
      }
      ?>
  </nav>
</header>