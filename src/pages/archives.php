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
    <title>archives — mmifolio</title>
  </head>
  <body>
  <?php include_once('../includes/header.php')?>
    <main>
          <?php 
            $_SESSION['last_page'] = $_SERVER['REQUEST_URI'];
            include('../php/displayCreations.php');
            displayArchives(8);
          ?>
    </main>
    <?php include_once('../includes/footer.php');?>
  </body>
</html>
