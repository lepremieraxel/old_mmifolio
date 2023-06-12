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
    <?php include_once('src/includes/header.php')?>
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
          <a href="/">Ajoute tes créations <i class="ri-add-box-line"></i></a>
        </button>
      </article>
      <article class="galery-container" id="most-recents">
        <h3 class="home">Récemment ajoutés</h3>
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
        <button class="cta"><a href="/">Découvrir <i class="ri-add-box-line"></i></a></button>
      </article>
    </main>
    <?php include_once('src/includes/footer.php');?>
  </body>
</html>
