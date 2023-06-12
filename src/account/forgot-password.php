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
    <title>mot de passe oublié — mmifolio</title>
  </head>
  <body class="account">
    <header>
      <a href="/"><h1 class="logo">mmi<span>folio</span></h1></a>
    </header>
    <main>
      <h2>Mot de passe oublié</h2>
      <p>Tu vas recevoir un mail avec un lien qui te renverra sur une page pour réinitialiser ton mot de passe et en définir un nouveau.</p>
      <form action="">
        <div class="input-container">
          <label for="forgot">Adresse email*</label>
          <input type="email" name="forgot" id="forgot" required placeholder="prenom.nom@iut-tarbes.fr">
        </div>
        <button class="form-btn">Recevoir</button>
        <div class="link-line">
          <p>Tu n'es pas encore membre ? <a href="/src/account/signup.php" class="gradient-text">S'inscrire</a></p>
          <a href="/src/account/login.php   " class="gradient-text">Se connecter.</a>
        </div>
      </form>
    </main>
  </body>
</html>
