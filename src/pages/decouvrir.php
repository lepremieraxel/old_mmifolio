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
    <title>découvrir — mmifolio</title>
  </head>
  <body>
  <?php include_once('../includes/header_include.php')?>
    <main>
      <article class="galery-container" id="most-recents">
        <div class="galery-title">
          <h3>Découvrir</h3>
        </div>
        <div class="grid-galery">
        <?php 
          $_SESSION['last_page'] = $_SERVER['REQUEST_URI'];
          include('../php/displayCreations.php');
          displayDiscover();
        ?>
        </div>
      </article>
    </main>
    <?php include_once('../includes/footer.php');?>
  </body>
</html>
