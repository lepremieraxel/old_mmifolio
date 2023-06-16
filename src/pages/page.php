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
  <?php include_once('../includes/header_include.php')?>
    <main id="page">
      <?php 
      if(isset($_GET['e']) && !empty($_GET['e'])){
        $err = htmlspecialchars($_GET['e']);
        switch($err){
          case 'add':
            echo '<div class="form-alert form-success">
              <i class="ri-error-warning-line"></i>
              <p>Votre création a bien été ajouté.</p>
              <button onclick="this.parentElement.remove()"><i class="ri-close-line"></i></button>
            </div>';
            break;
          case 'update':
            echo '<div class="form-alert form-success">
              <i class="ri-error-warning-line"></i>
              <p>Votre création a bien été mise à jour.</p>
              <button onclick="this.parentElement.remove()"><i class="ri-close-line"></i></button>
            </div>';
            break;
          default:
            echo '';
            break;
        }
      }
      include('../php/displayPage.php'); displayPage();?>
    </main>
    <?php include_once('../includes/footer.php');?>
    <script src="/src/js/galerySelector.js"></script>
  </body>
</html>
