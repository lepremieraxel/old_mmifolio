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
  <?php include_once('../includes/header.php')?>
    <main>
      <article class="galery-container" id="most-recents">
        <div class="galery-title">
          <h3>Découvrir</h3>
          <form action="" method="post">
            <label for="orderby">Trier par :&nbsp;
              <select name="orderby" id="orderby">
                <option value="add-date">Date d'ajout</option>
                <option value="likes">Nombre de likes</option>
                <option value="alphabet">Ordre alphabétique</option>
              </select>
            </label>
            <button class="order-submit"><i class="ri-send-plane-2-line"></i></button>
          </form>
        </div>
        <div class="grid-galery">
          <div class="grid-item">
            <img
              class="grid-item-img"
              src="/assets/img_dev/img1.png"
              alt="img test"
            />
            <div class="grid-item-overlay overlay-user">
              <a href="/">
                <img src="/assets/img_dev/profil.png" alt="profile picture" />
                <p>• Axel Marcial</p>
              </a>
            </div>
            <div class="grid-item-overlay overlay-infos">
              <div class="overlay-line">
                <a href="/">Titre de la création • Catégorie</a>
                <div class="overlay-like">
                  <p>356</p>
                  <button>
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                      <path
                        d="M16.5 3C19.5376 3 22 5.5 22 9C22 16 14.5 20 12 21.5C9.5 20 2 16 2 9C2 5.5 4.5 3 7.5 3C9.35997 3 11 4 12 5C13 4 14.64 3 16.5 3Z"
                      ></path>
                    </svg>
                  </button>
                </div>
              </div>
            </div>
          </div>
          <div class="grid-item">
            <img
              class="grid-item-img"
              src="/assets/img_dev/img2.png"
              alt="img test"
            />
            <div class="grid-item-overlay overlay-user">
              <a href="/">
                <img src="/assets/img_dev/profil.png" alt="profile picture" />
                <p>• Axel Marcial</p>
              </a>
            </div>
            <div class="grid-item-overlay overlay-infos">
              <div class="overlay-line">
                <a href="/">Titre de la création • Catégorie</a>
                <div class="overlay-like">
                  <p>356</p>
                  <button>
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                      <path
                        d="M16.5 3C19.5376 3 22 5.5 22 9C22 16 14.5 20 12 21.5C9.5 20 2 16 2 9C2 5.5 4.5 3 7.5 3C9.35997 3 11 4 12 5C13 4 14.64 3 16.5 3Z"
                      ></path>
                    </svg>
                  </button>
                </div>
              </div>
            </div>
          </div>
          <div class="grid-item">
            <img
              class="grid-item-img"
              src="/assets/img_dev/img3.jpg"
              alt="img test"
            />
            <div class="grid-item-overlay overlay-user">
              <a href="/">
                <img src="/assets/img_dev/profil.png" alt="profile picture" />
                <p>• Axel Marcial</p>
              </a>
            </div>
            <div class="grid-item-overlay overlay-infos">
              <div class="overlay-line">
                <a href="/">Titre de la création • Catégorie</a>
                <div class="overlay-like">
                  <p>356</p>
                  <button>
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                      <path
                        d="M16.5 3C19.5376 3 22 5.5 22 9C22 16 14.5 20 12 21.5C9.5 20 2 16 2 9C2 5.5 4.5 3 7.5 3C9.35997 3 11 4 12 5C13 4 14.64 3 16.5 3Z"
                      ></path>
                    </svg>
                  </button>
                </div>
              </div>
            </div>
          </div>
          <div class="grid-item">
            <img
              class="grid-item-img"
              src="/assets/img_dev/img4.png"
              alt="img test"
            />
            <div class="grid-item-overlay overlay-user">
              <a href="/">
                <img src="/assets/img_dev/profil.png" alt="profile picture" />
                <p>• Axel Marcial</p>
              </a>
            </div>
            <div class="grid-item-overlay overlay-infos">
              <div class="overlay-line">
                <a href="/">Titre de la création • Catégorie</a>
                <div class="overlay-like">
                  <p>356</p>
                  <button>
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                      <path
                        d="M16.5 3C19.5376 3 22 5.5 22 9C22 16 14.5 20 12 21.5C9.5 20 2 16 2 9C2 5.5 4.5 3 7.5 3C9.35997 3 11 4 12 5C13 4 14.64 3 16.5 3Z"
                      ></path>
                    </svg>
                  </button>
                </div>
              </div>
            </div>
          </div>
          <div class="grid-item">
            <img
              class="grid-item-img"
              src="/assets/img_dev/img5.png"
              alt="img test"
            />
            <div class="grid-item-overlay overlay-user">
              <a href="/">
                <img src="/assets/img_dev/profil.png" alt="profile picture" />
                <p>• Axel Marcial</p>
              </a>
            </div>
            <div class="grid-item-overlay overlay-infos">
              <div class="overlay-line">
                <a href="/">Titre de la création • Catégorie</a>
                <div class="overlay-like">
                  <p>356</p>
                  <button>
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                      <path
                        d="M16.5 3C19.5376 3 22 5.5 22 9C22 16 14.5 20 12 21.5C9.5 20 2 16 2 9C2 5.5 4.5 3 7.5 3C9.35997 3 11 4 12 5C13 4 14.64 3 16.5 3Z"
                      ></path>
                    </svg>
                  </button>
                </div>
              </div>
            </div>
          </div>
          <div class="grid-item">
            <img
              class="grid-item-img"
              src="/assets/img_dev/img6.jpg"
              alt="img test"
            />
            <div class="grid-item-overlay overlay-user">
              <a href="/">
                <img src="/assets/img_dev/profil.png" alt="profile picture" />
                <p>• Axel Marcial</p>
              </a>
            </div>
            <div class="grid-item-overlay overlay-infos">
              <div class="overlay-line">
                <a href="/">Titre de la création • Catégorie</a>
                <div class="overlay-like">
                  <p>356</p>
                  <button>
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                      <path
                        d="M16.5 3C19.5376 3 22 5.5 22 9C22 16 14.5 20 12 21.5C9.5 20 2 16 2 9C2 5.5 4.5 3 7.5 3C9.35997 3 11 4 12 5C13 4 14.64 3 16.5 3Z"
                      ></path>
                    </svg>
                  </button>
                </div>
              </div>
            </div>
          </div>
          <div class="grid-item">
            <img
              class="grid-item-img"
              src="/assets/img_dev/img7.png"
              alt="img test"
            />
            <div class="grid-item-overlay overlay-user">
              <a href="/">
                <img src="/assets/img_dev/profil.png" alt="profile picture" />
                <p>• Axel Marcial</p>
              </a>
            </div>
            <div class="grid-item-overlay overlay-infos">
              <div class="overlay-line">
                <a href="/">Titre de la création • Catégorie</a>
                <div class="overlay-like">
                  <p>356</p>
                  <button>
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                      <path
                        d="M16.5 3C19.5376 3 22 5.5 22 9C22 16 14.5 20 12 21.5C9.5 20 2 16 2 9C2 5.5 4.5 3 7.5 3C9.35997 3 11 4 12 5C13 4 14.64 3 16.5 3Z"
                      ></path>
                    </svg>
                  </button>
                </div>
              </div>
            </div>
          </div>
          <div class="grid-item">
            <img
              class="grid-item-img"
              src="/assets/img_dev/img8.png"
              alt="img test"
            />
            <div class="grid-item-overlay overlay-user">
              <a href="/">
                <img src="/assets/img_dev/profil.png" alt="profile picture" />
                <p>• Axel Marcial</p>
              </a>
            </div>
            <div class="grid-item-overlay overlay-infos">
              <div class="overlay-line">
                <a href="/">Titre de la création • Catégorie</a>
                <div class="overlay-like">
                  <p>356</p>
                  <button>
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                      <path
                        d="M16.5 3C19.5376 3 22 5.5 22 9C22 16 14.5 20 12 21.5C9.5 20 2 16 2 9C2 5.5 4.5 3 7.5 3C9.35997 3 11 4 12 5C13 4 14.64 3 16.5 3Z"
                      ></path>
                    </svg>
                  </button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </article>
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
