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
      <?php include('../php/displayPage.php'); displayPage();?>
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
    <script src="/src/js/galerySelector.js"></script>
  </body>
</html>
