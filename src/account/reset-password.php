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
    <title>réinitialiser le mot de passe — mmifolio</title>
  </head>
  <body class="account">
    <header>
      <a href="/"><h1 class="logo">mmi<span>folio</span></h1></a>
    </header>
    <main>
      <h2>Réinitialiser le mot de passe</h2>
      <form action="" id="reset">
        <div class="input-line">
          <div class="input-container">
            <label for="passwd">Mot de passe*</label>
            <input type="password" name="passwd" id="passwd" required placeholder="•••••••••••••••">
            <small>De 8 à 30 caractères. Minimum 1 minuscule, 1 majuscule, 1 chiffre et 1 symbole.</small>
          </div>
          <div class="input-container">
            <label for="repasswd">Confirmer*</label>
            <input type="password" name="repasswd" id="repasswd" required placeholder="•••••••••••••••">
          </div>
        </div>
        <button class="form-btn">Changer</button>
        <div class="link-line">
          <p>Tu n'es pas encore membre ? <a href="/src/account/signup.php" class="gradient-text">S'inscrire</a></p>
          <a href="/src/account/login.php" class="gradient-text">Se connecter.</a>
        </div>
      </form>
    </main>
  </body>
</html>
