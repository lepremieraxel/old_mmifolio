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
    <title>accueil — mmifolio</title>
  </head>
  <body>
    <?php 
    include_once('src/includes/header.php');
    ?>
    <main>
      <article id="hero">
        <div class="hero-text">
          <h2>Explore les créations</h2>
          <p>
            Lorem ipsum dolor sit, amet consectetur adipisicing elit. Fugit
            consequatur ipsa maxime voluptatem iste atque facere dolores maiores
            provident quia a, nobis, ab, earum voluptatibus laudantium alias?
            Est, hic officiis.
          </p>
        </div>
        <button class="cta hero-add-btn">
          <a href="/src/new/ajouter.php">Ajoute tes créations <i class="ri-add-box-line"></i></a>
        </button>
      </article>
      <article class="galery-container" id="most-recents">
        <h3 class="home">Récemment ajoutés</h3>
        <div class="grid-galery">
          <?php 
            $_SESSION['last_page'] = $_SERVER['REQUEST_URI'];
          include('src/php/displayCreations.php');
          displayHome(8);?>
        </div>
        <button class="cta"><a href="/src/pages/decouvrir.php">Découvrir <i class="ri-add-box-line"></i></a></button>
      </article>
    </main>
    <?php include_once('src/includes/footer.php');?>
  </body>
</html>
