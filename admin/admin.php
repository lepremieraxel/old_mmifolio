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
    <title>admin — mmifolio</title>
  </head>
  <body>
    <?php 
    include_once('../src/includes/header_include.php');
    require_once('../src/config/config.php');
    ?>
    <main id="admin">
    <h2>Administration</h2>
    <div class="line-table">
      <div class="table">
        <h3>Catégories</h3>
        <table>
          <thead>
            <tr>
              <th>ID</th>
              <th>Name</th>
              <th>Name flat</th>
              <th><i class="ri-delete-bin-line"></i></th>
            </tr>
          </thead>
          <tbody>
            <?php
            foreach ($db->query('SELECT * FROM categories') as $category) {
              echo '<tr>
                <td>'.$category['id'].'</td>
                <td>'.$category['name'].'</td>
                <td>'.$category['flat_name'].'</td>
                <td><form action="/admin/admin_actions.php" method="post"><input type="hidden" name="category_id" value="'.$category['id'].'"/><button type="submit"><i class="ri-delete-bin-line"></i></button></form></td>
              </tr>';
            }
            ?>
          </tbody>
        </table>
        <form action="/admin/admin_actions.php" method="post" class="add-admin">
          <input type="text" name="category" placeholder="Catégorie">
          <button><i class="ri-send-plane-line"></i></button>
        </form>
      </div>
      <div class="table">
        <h3>Promo</h3>
        <table>
          <thead>
            <tr>
              <th>ID</th>
              <th>Name</th>
              <th>Name flat</th>
              <th><i class="ri-delete-bin-line"></i></th>
            </tr>
          </thead>
          <tbody>
            <?php
            foreach ($db->query('SELECT * FROM promo') as $promo) {
              echo '<tr>
                <td>'.$promo['id'].'</td>
                <td>'.$promo['name'].'</td>
                <td>'.$promo['flat_name'].'</td>
                <td><form action="/admin/admin_actions.php" method="post"><input type="hidden" name="promo_id" value="'.$promo['id'].'"/><button type="submit"><i class="ri-delete-bin-line"></i></button></form></td>
              </tr>';
            }
            ?>
          </tbody>
        </table>
        <form action="/admin/admin_actions.php" method="post" class="add-admin">
          <input type="text" name="promo" placeholder="Promo" required>
          <button><i class="ri-send-plane-line"></i></button>
        </form>
      </div>
    </div>
    </main>
    <?php include_once('../src/includes/footer.php');?>
  </body>
</html>
