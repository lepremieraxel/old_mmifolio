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
    <title>page — mmifolio</title>
  </head>
  <body>
  <?php include_once('../includes/header.php')?>
    <main id="page">
      <a href="/" class="close-btn"><i class="ri-close-line"></i> Fermer</a>
      <div class="user-infos">
        <a href="/" class="user">
          <img src="/assets/img_dev/profil.png" alt="photo de profil de user">
          <p>• Axel Marcial • <span>@lepremieraxel</span></p>
        </a>
        <div class="like">
          <p>356</p>
          <button><i class="ri-heart-3-line"></i></button>
        </div>
      </div>
      <div class="creation-infos">
        <p>Titre de la création</p>
        <p>Catégorie • Date</p>
      </div>
      <img src="/assets/img_dev/img3.jpg" alt="apercu" class="apercu">
      <p class="description">Lorem ipsum dolor sit amet consectetur adipisicing elit. Veritatis ex quam perferendis. Adipisci labore harum cupiditate autem, nihil fuga error voluptatibus odio doloremque nisi cum blanditiis sapiente quis veniam reprehenderit? Lorem ipsum dolor sit amet consectetur adipisicing elit. Aliquam, optio at magnam consequuntur tempora cumque recusandae a, temporibus quidem non debitis quo expedita, necessitatibus culpa! Tenetur ea expedita eaque quidem?</p>
      <div class="galery">
        <img src="/assets/img_dev/img1.png" alt="image de galerie 1">
        <div class="galery-selector">
          <img src="/assets/img_dev/img1.png" alt="image de galerie 1" class="galery-active">
          <img src="/assets/img_dev/img2.png" alt="image de galerie 2">
          <img src="/assets/img_dev/img4.png" alt="image de galerie 4">
          <img src="/assets/img_dev/img4.png" alt="image de galerie 4">
          <img src="/assets/img_dev/img4.png" alt="image de galerie 4">
        </div>
      </div>
    </main>
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
