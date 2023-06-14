<?php

require_once('/Users/axelm/Desktop/mmifolio/src/config/config.php');

function displayArchiveDetails()
{
  if (isset($_GET['year']) && !empty($_GET['year'])) {
    global $db;
    $select_year = $db->prepare('SELECT * FROM year WHERE name = ?');
    $select_year->execute(array($_GET['year']));
    $year = $select_year->fetch();
    $select = $db->prepare('SELECT * FROM creations WHERE date = ?');
    $select->execute(array($year['name']));
    $data = $select->fetchAll();
    $count = $select->rowCount();
    if ($count > 0) {

      echo '<article class="galery-container">
        <div class="galery-title">
          <h3>' . $year['name'] . '</h3>
        </div>
        <div class="grid-galery">';
      foreach ($data as $line) {
        $apercu_select = $db->prepare('SELECT * FROM medias WHERE token = ?');
        $apercu_select->execute(array($line['apercu']));
        $apercu_data = $apercu_select->fetch();
        $apercu_count = $apercu_select->rowCount();

        $user_select = $db->prepare('SELECT * FROM users WHERE token = ?');
        $user_select->execute(array($line['token_user']));
        $user_data = $user_select->fetch();

        if ($apercu_count > 0) {
          $apercu_type = explode('/', $apercu_data['type']);
          $apercu_type = $apercu_type[0];
          if ($apercu_type == "image") {
            $apercu = '<img class="grid-item-img" src="data:' . $apercu_data['type'] . ';base64,' . base64_encode($apercu_data['data']) . '" alt="img apercu"/>';
          }
          if ($apercu_type == "video") {
            $apercu = '<video class="grid-item-img" src="data:' . $apercu_data['type'] . ';base64,' . base64_encode($apercu_data['data']) . '" autoplay loop muted></video>';
          }
        } else $apercu = '<img class="grid-item-img" src="/assets/img/default_img.png" alt="img apercu"/>';

        if ($user_data['avatar'] !== '') {
          $avatar = 'data:' . $user_data['avatar_type'] . ';base64,' . base64_encode($user_data['avatar']);
        } else $avatar = '/assets/img/avatar.png';

        echo '
              <div class="grid-item">
                '.$apercu.'
                <div class="grid-item-overlay overlay-user">
                  <a href="/src/profil/profil.php?user=' . $user_data['username'] . '&token=' . $user_data['token'] . '">
                  <img src="' . $avatar . '" alt="photo de profil" />
                  <p>• ' . $user_data['fullname'] . '</p>
                  </a>
                </div>
                <div class="grid-item-overlay overlay-infos">
                  <div class="overlay-line">
                    <a href="/src/pages/page.php?title=' . $line['title'] . '&token_creation=' . $line['token'] . '">' . $line['title'] . ' • ' . $line['category'] . '</a>
                    <div class="overlay-like">
                      <p>356</p>
                      <button><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M16.5 3C19.5376 3 22 5.5 22 9C22 16 14.5 20 12 21.5C9.5 20 2 16 2 9C2 5.5 4.5 3 7.5 3C9.35997 3 11 4 12 5C13 4 14.64 3 16.5 3Z"></path></svg></button>
                    </div>
                  </div>
                </div>
              </div>';
      }
      echo '</div>
            </article>';
    }
  } else echo '<article class="galery-container">
  <div class="galery-title">
    <h3>Aucune catégorie sélectionnée.</h3>
  </div>
  </article>';
}

function displayArchives($nb)
{
  global $db;
  $select_year = $db->query('SELECT * FROM year');
  $years = $select_year->fetchAll();
  foreach ($years as $year) {
    $select = $db->prepare('SELECT * FROM creations WHERE date = ? LIMIT ' . $nb);
    $select->execute(array($year['name']));
    $data = $select->fetchAll();
    $count = $select->rowCount();
    if ($count > 0) {

      echo '<article class="galery-container">
      <div class="galery-title">
        <h3>' . $year['name'] . '</h3>
        <button class="cta"><a href="/src/pages/archive-details.php?year=' . $year['name'] . '">En voir plus <i class="ri-add-line"></i></a></button>
      </div>
      <div class="grid-galery">';
      foreach ($data as $line) {
        $apercu_select = $db->prepare('SELECT * FROM medias WHERE token = ?');
        $apercu_select->execute(array($line['apercu']));
        $apercu_data = $apercu_select->fetch();
        $apercu_count = $apercu_select->rowCount();

        $user_select = $db->prepare('SELECT * FROM users WHERE token = ?');
        $user_select->execute(array($line['token_user']));
        $user_data = $user_select->fetch();

        if ($apercu_count > 0) {
          $apercu_type = explode('/', $apercu_data['type']);
          $apercu_type = $apercu_type[0];
          if ($apercu_type == "image") {
            $apercu = '<img class="grid-item-img" src="data:' . $apercu_data['type'] . ';base64,' . base64_encode($apercu_data['data']) . '" alt="img apercu"/>';
          }
          if ($apercu_type == "video") {
            $apercu = '<video class="grid-item-img" src="data:' . $apercu_data['type'] . ';base64,' . base64_encode($apercu_data['data']) . '" autoplay loop muted></video>';
          }
        } else $apercu = '<img class="grid-item-img" src="/assets/img/default_img.png" alt="img apercu"/>';

        if ($user_data['avatar'] !== '') {
          $avatar = 'data:' . $user_data['avatar_type'] . ';base64,' . base64_encode($user_data['avatar']);
        } else $avatar = '/assets/img/avatar.png';

        echo '<div class="grid-item">';
        echo $apercu;
        echo '<div class="grid-item-overlay overlay-user">
          <a href="/src/profil/profil.php?user=' . $user_data['username'] . '&token=' . $user_data['token'] . '">
          <img src="' . $avatar . '" alt="photo de profil" />
          <p>• ' . $user_data['fullname'] . '</p>
          </a>
          </div>
          <div class="grid-item-overlay overlay-infos">
          <div class="overlay-line">
          <a href="/src/pages/page.php?title=' . $line['title'] . '&token_creation=' . $line['token'] . '">' . $line['title'] . ' • ' . $line['category'] . '</a>
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
          </div>';
      }
      echo '</div>
          </article>';
    }
  }
}

function displayCategoryDetails()
{
  if (isset($_GET['cat']) && !empty($_GET['cat'])) {
    global $db;
    $select_cat = $db->prepare('SELECT * FROM categories WHERE flat_name = ?');
    $select_cat->execute(array($_GET['cat']));
    $category = $select_cat->fetch();
    $select = $db->prepare('SELECT * FROM creations WHERE category_flat = ?');
    $select->execute(array($category['flat_name']));
    $data = $select->fetchAll();
    $count = $select->rowCount();
    if ($count > 0) {

      echo '<article class="galery-container">
        <div class="galery-title">
          <h3>' . $category['name'] . '</h3>
        </div>
        <div class="grid-galery">';
      foreach ($data as $line) {
        $apercu_select = $db->prepare('SELECT * FROM medias WHERE token = ?');
        $apercu_select->execute(array($line['apercu']));
        $apercu_data = $apercu_select->fetch();
        $apercu_count = $apercu_select->rowCount();

        $user_select = $db->prepare('SELECT * FROM users WHERE token = ?');
        $user_select->execute(array($line['token_user']));
        $user_data = $user_select->fetch();

        if ($apercu_count > 0) {
          $apercu_type = explode('/', $apercu_data['type']);
          $apercu_type = $apercu_type[0];
          if ($apercu_type == "image") {
            $apercu = '<img class="grid-item-img" src="data:' . $apercu_data['type'] . ';base64,' . base64_encode($apercu_data['data']) . '" alt="img apercu"/>';
          }
          if ($apercu_type == "video") {
            $apercu = '<video class="grid-item-img" src="data:' . $apercu_data['type'] . ';base64,' . base64_encode($apercu_data['data']) . '" autoplay loop muted></video>';
          }
        } else $apercu = '<img class="grid-item-img" src="/assets/img/default_img.png" alt="img apercu"/>';

        if ($user_data['avatar'] !== '') {
          $avatar = 'data:' . $user_data['avatar_type'] . ';base64,' . base64_encode($user_data['avatar']);
        } else $avatar = '/assets/img/avatar.png';

        echo '<div class="grid-item">';
        echo $apercu;
        echo '<div class="grid-item-overlay overlay-user">
              <a href="/src/profil/profil.php?user=' . $user_data['username'] . '&token=' . $user_data['token'] . '">
              <img src="' . $avatar . '" alt="photo de profil" />
              <p>• ' . $user_data['fullname'] . '</p>
              </a>
              </div>
              <div class="grid-item-overlay overlay-infos">
              <div class="overlay-line">
              <a href="/src/pages/page.php?title=' . $line['title'] . '&token_creation=' . $line['token'] . '">' . $line['title'] . ' • ' . $line['category'] . '</a>
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
              </div>';
      }
      echo '</div>
            </article>';
    }
  } else echo '<article class="galery-container">
  <div class="galery-title">
    <h3>Aucune catégorie sélectionnée.</h3>
  </div>
  </article>';
}

function displayCategory($nb)
{
  global $db;
  $select_cat = $db->query('SELECT * FROM categories');
  $categories = $select_cat->fetchAll();
  foreach ($categories as $category) {
    $select = $db->prepare('SELECT * FROM creations WHERE category_flat = ? LIMIT ' . $nb);
    $select->execute(array($category['flat_name']));
    $data = $select->fetchAll();
    $count = $select->rowCount();
    if ($count > 0) {

      echo '<article class="galery-container">
      <div class="galery-title">
        <h3>' . $category['name'] . '</h3>
        <button class="cta"><a href="/src/pages/category-details.php?cat=' . $category['flat_name'] . '">En voir plus <i class="ri-add-line"></i></a></button>
      </div>
      <div class="grid-galery">';
      foreach ($data as $line) {
        $apercu_select = $db->prepare('SELECT * FROM medias WHERE token = ?');
        $apercu_select->execute(array($line['apercu']));
        $apercu_data = $apercu_select->fetch();
        $apercu_count = $apercu_select->rowCount();

        $user_select = $db->prepare('SELECT * FROM users WHERE token = ?');
        $user_select->execute(array($line['token_user']));
        $user_data = $user_select->fetch();

        if ($apercu_count > 0) {
          $apercu_type = explode('/', $apercu_data['type']);
          $apercu_type = $apercu_type[0];
          if ($apercu_type == "image") {
            $apercu = '<img class="grid-item-img" src="data:' . $apercu_data['type'] . ';base64,' . base64_encode($apercu_data['data']) . '" alt="img apercu"/>';
          }
          if ($apercu_type == "video") {
            $apercu = '<video class="grid-item-img" src="data:' . $apercu_data['type'] . ';base64,' . base64_encode($apercu_data['data']) . '" autoplay loop muted></video>';
          }
        } else $apercu = '<img class="grid-item-img" src="/assets/img/default_img.png" alt="img apercu"/>';

        if ($user_data['avatar'] !== '') {
          $avatar = 'data:' . $user_data['avatar_type'] . ';base64,' . base64_encode($user_data['avatar']);
        } else $avatar = '/assets/img/avatar.png';

        echo '<div class="grid-item">';
        echo $apercu;
        echo '<div class="grid-item-overlay overlay-user">
            <a href="/src/profil/profil.php?user=' . $user_data['username'] . '&token=' . $user_data['token'] . '">
            <img src="' . $avatar . '" alt="photo de profil" />
            <p>• ' . $user_data['fullname'] . '</p>
            </a>
            </div>
            <div class="grid-item-overlay overlay-infos">
            <div class="overlay-line">
            <a href="/src/pages/page.php?title=' . $line['title'] . '&token_creation=' . $line['token'] . '">' . $line['title'] . ' • ' . $line['category'] . '</a>
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
            </div>';
      }
      echo '</div>
          </article>';
    }
  }
}

function displayDiscover()
{
  global $db;
  $select = $db->query('SELECT * FROM creations ORDER BY RAND()');
  $data = $select->fetchAll();
  foreach ($data as $line) {
    $apercu_select = $db->prepare('SELECT * FROM medias WHERE token = ?');
    $apercu_select->execute(array($line['apercu']));
    $apercu_data = $apercu_select->fetch();
    $apercu_count = $apercu_select->rowCount();

    $user_select = $db->prepare('SELECT * FROM users WHERE token = ?');
    $user_select->execute(array($line['token_user']));
    $user_data = $user_select->fetch();

    if ($apercu_count > 0) {
      $apercu_type = explode('/', $apercu_data['type']);
      $apercu_type = $apercu_type[0];
      if ($apercu_type == "image") {
        $apercu = '<img class="grid-item-img" src="data:' . $apercu_data['type'] . ';base64,' . base64_encode($apercu_data['data']) . '" alt="img apercu"/>';
      }
      if ($apercu_type == "video") {
        $apercu = '<video class="grid-item-img" src="data:' . $apercu_data['type'] . ';base64,' . base64_encode($apercu_data['data']) . '" autoplay loop muted></video>';
      }
    } else $apercu = '<img class="grid-item-img" src="/assets/img/default_img.png" alt="img apercu"/>';

    if ($user_data['avatar'] !== '') {
      $avatar = 'data:' . $user_data['avatar_type'] . ';base64,' . base64_encode($user_data['avatar']);
    } else $avatar = '/assets/img/avatar.png';

    echo '<div class="grid-item">';
    echo $apercu;
    echo '<div class="grid-item-overlay overlay-user">
      <a href="/src/profil/profil.php?user=' . $user_data['username'] . '&token=' . $user_data['token'] . '">
        <img src="' . $avatar . '" alt="photo de profil" />
        <p>• ' . $user_data['fullname'] . '</p>
      </a>
    </div>
    <div class="grid-item-overlay overlay-infos">
      <div class="overlay-line">
        <a href="/src/pages/page.php?title=' . $line['title'] . '&token_creation=' . $line['token'] . '">' . $line['title'] . ' • ' . $line['category'] . '</a>
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
  </div>';
  }
}

function displayHome($nb)
{
  global $db;
  $select = $db->query('SELECT * FROM creations LIMIT ' . $nb);
  $data = $select->fetchAll();
  foreach ($data as $line) {
    $apercu_select = $db->prepare('SELECT * FROM medias WHERE token = ?');
    $apercu_select->execute(array($line['apercu']));
    $apercu_data = $apercu_select->fetch();
    $apercu_count = $apercu_select->rowCount();

    $user_select = $db->prepare('SELECT * FROM users WHERE token = ?');
    $user_select->execute(array($line['token_user']));
    $user_data = $user_select->fetch();

    if ($apercu_count > 0) {
      $apercu_type = explode('/', $apercu_data['type']);
      $apercu_type = $apercu_type[0];
      if ($apercu_type == "image") {
        $apercu = '<img class="grid-item-img" src="data:' . $apercu_data['type'] . ';base64,' . base64_encode($apercu_data['data']) . '" alt="img apercu"/>';
      }
      if ($apercu_type == "video") {
        $apercu = '<video class="grid-item-img" src="data:' . $apercu_data['type'] . ';base64,' . base64_encode($apercu_data['data']) . '" autoplay loop muted></video>';
      }
    } else $apercu = '<img class="grid-item-img" src="/assets/img/default_img.png" alt="img apercu"/>';

    if ($user_data['avatar'] !== '') {
      $avatar = 'data:' . $user_data['avatar_type'] . ';base64,' . base64_encode($user_data['avatar']);
    } else $avatar = '/assets/img/avatar.png';

    echo '<div class="grid-item">';
    echo $apercu;
    echo '<div class="grid-item-overlay overlay-user">
      <a href="/src/profil/profil.php?user=' . $user_data['username'] . '&token=' . $user_data['token'] . '">
        <img src="' . $avatar . '" alt="photo de profil" />
        <p>• ' . $user_data['fullname'] . '</p>
      </a>
    </div>
    <div class="grid-item-overlay overlay-infos">
      <div class="overlay-line">
        <a href="/src/pages/page.php?title=' . $line['title'] . '&token_creation=' . $line['token'] . '">' . $line['title'] . ' • ' . $line['category'] . '</a>
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
  </div>';
  }
}
