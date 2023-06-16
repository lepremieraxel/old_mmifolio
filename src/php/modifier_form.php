<?php

require_once('../config/config.php');

$old_title = $_POST['old_title'];
$token = $_POST['token_creation'];

if(isset($_POST['delete_creation'])){
  $token = $_POST['delete_token_creation'];
  $redirect = $_POST['delete_creation_redirect'];
  $delete_creation = $db->prepare('DELETE FROM creations WHERE token = ?');
  $delete_creation->execute(array($token));
  if($delete_creation){
    header('Location:/profil/'.$redirect.'&e=delete');
  } else header('Location:/update/'.$old_title.'-'.$token.'-'.$_GET['token_user'].'&e=server_err');
}

if(isset($_POST['update_creation'])){
  if(isset($_POST['title']) && !empty($_POST['title']) && strlen($_POST['title']) <= 100){
    if(isset($_POST['category']) && !empty($_POST['category'])){
      if(isset($_POST['date']) && !empty($_POST['date'])){
        if(isset($_POST['description']) && !empty($_POST['description']) && strlen($_POST['description']) <= 1000){
            
          $title = $_POST['title'];
          $category_flat = htmlspecialchars($_POST['category']);
          $date = htmlspecialchars($_POST['date']);
          $description = $_POST['description'];
          $link = htmlspecialchars($_POST['link']);

          $select_cat = $db->prepare('SELECT * FROM categories WHERE flat_name = ?');
          $select_cat->execute(array($category_flat));
          $category_data = $select_cat->fetch();
          $category = $category_data['name'];

          $update = $db->prepare('UPDATE creations SET title = ?, category = ?, category_flat = ?, description = ?, date = ?, link = ? WHERE token = ?');
          $update->execute(array($title, $category, $category_flat, $description, $date, $link, $token));

          $select_tokens = $db->prepare('SELECT apercu, galery1, galery2, galery3, galery4, galery5 FROM creations WHERE token = ?');
          $select_tokens->execute(array($token));
          $tokens = $select_tokens->fetch();

          if(isset($_FILES['apercu']) && $_FILES['apercu']['error'] == 0 && $_FILES['apercu']['size'] > 0 && $_FILES['apercu']['size'] <= 5000000){
            $apercu_file = $_FILES['apercu']['tmp_name'];
            $apercu = file_get_contents($apercu_file);
            $apercu_type = mime_content_type($apercu_file);
            $apercu_token = bin2hex(openssl_random_pseudo_bytes(5));

            $update_creation = $db->prepare('UPDATE creations SET apercu = ? WHERE token = ?');
            $update_creation->execute(array($apercu_token, $token));

            if($tokens['apercu'] !== ''){
              $delete_media = $db->prepare('DELETE FROM medias WHERE token = ?');
              $delete_media->execute(array($tokens['apercu']));
            }

            $insert_media = $db->prepare('INSERT INTO medias (token, token_creation, data, type) VALUES (:token, :token_creation, :data, :type)');
            $insert_media->execute(array(
              'token' => $apercu_token,
              'token_creation' => $token,
              'data' => $apercu,
              'type' => $apercu_type
            ));
          }
          if(isset($_FILES['galery1']) && $_FILES['galery1']['error'] == 0 && $_FILES['galery1']['size'] > 0 && $_FILES['galery1']['size'] <= 5000000){
            $galery1_file = $_FILES['galery1']['tmp_name'];
            $galery1 = file_get_contents($galery1_file);
            $galery1_type = mime_content_type($galery1_file);
            $galery1_token = bin2hex(openssl_random_pseudo_bytes(5));
            $update_creation = $db->prepare('UPDATE creations SET galery1 = ? WHERE token = ?');
            $update_creation->execute(array($galery1_token, $token));
            
            if($tokens['galery1'] !== ''){
              $delete_media = $db->prepare('DELETE FROM medias WHERE token = ?');
              $delete_media->execute(array($tokens['galery1']));
            }

            $insert_media = $db->prepare('INSERT INTO medias (token, token_creation, data, type) VALUES (:token, :token_creation, :data, :type)');
            $insert_media->execute(array(
              'token' => $galery1_token,
              'token_creation' => $token,
              'data' => $galery1,
              'type' => $galery1_type
            ));
          }
          if(isset($_FILES['galery2']) && $_FILES['galery2']['error'] == 0 && $_FILES['galery2']['size'] > 0 && $_FILES['galery2']['size'] <= 5000000){
            $galery2_file = $_FILES['galery2']['tmp_name'];
            $galery2 = file_get_contents($galery2_file);
            $galery2_type = mime_content_type($galery2_file);
            $galery2_token = bin2hex(openssl_random_pseudo_bytes(5));
            $update_creation = $db->prepare('UPDATE creations SET galery2 = ? WHERE token = ?');
            $update_creation->execute(array($galery2_token, $token));
            
            if($tokens['galery2'] !== ''){
              $delete_media = $db->prepare('DELETE FROM medias WHERE token = ?');
              $delete_media->execute(array($tokens['galery2']));
            }

            $insert_media = $db->prepare('INSERT INTO medias (token, token_creation, data, type) VALUES (:token, :token_creation, :data, :type)');
            $insert_media->execute(array(
              'token' => $galery2_token,
              'token_creation' => $token,
              'data' => $galery2,
              'type' => $galery2_type
            ));
          }
          if(isset($_FILES['galery3']) && $_FILES['galery3']['error'] == 0 && $_FILES['galery3']['size'] > 0 && $_FILES['galery3']['size'] <= 5000000){
            $galery3_file = $_FILES['galery3']['tmp_name'];
            $galery3 = file_get_contents($galery3_file);
            $galery3_type = mime_content_type($galery3_file);
            $galery3_token = bin2hex(openssl_random_pseudo_bytes(5));
            $update_creation = $db->prepare('UPDATE creations SET galery3 = ? WHERE token = ?');
            $update_creation->execute(array($galery3_token, $token));
            
            if($tokens['galery3'] !== ''){
              $delete_media = $db->prepare('DELETE FROM medias WHERE token = ?');
              $delete_media->execute(array($tokens['galery3']));
            }

            $insert_media = $db->prepare('INSERT INTO medias (token, token_creation, data, type) VALUES (:token, :token_creation, :data, :type)');
            $insert_media->execute(array(
              'token' => $galery3_token,
              'token_creation' => $token,
              'data' => $galery3,
              'type' => $galery3_type
            ));
          }
          if(isset($_FILES['galery4']) && $_FILES['galery4']['error'] == 0 && $_FILES['galery4']['size'] > 0 && $_FILES['galery4']['size'] <= 5000000){
            $galery4_file = $_FILES['galery4']['tmp_name'];
            $galery4 = file_get_contents($galery4_file);
            $galery4_type = mime_content_type($galery4_file);
            $galery4_token = bin2hex(openssl_random_pseudo_bytes(5));
            $update_creation = $db->prepare('UPDATE creations SET galery4 = ? WHERE token = ?');
            $update_creation->execute(array($galery4_token, $token));
            
            if($tokens['galery4'] !== ''){
              $delete_media = $db->prepare('DELETE FROM medias WHERE token = ?');
              $delete_media->execute(array($tokens['galery4']));
            }

            $insert_media = $db->prepare('INSERT INTO medias (token, token_creation, data, type) VALUES (:token, :token_creation, :data, :type)');
            $insert_media->execute(array(
              'token' => $galery4_token,
              'token_creation' => $token,
              'data' => $galery4,
              'type' => $galery4_type
            ));
          }
          if(isset($_FILES['galery5']) && $_FILES['galery5']['error'] == 0 && $_FILES['galery5']['size'] > 0 && $_FILES['galery5']['size'] <= 5000000){
            $galery5_file = $_FILES['galery5']['tmp_name'];
            $galery5 = file_get_contents($galery5_file);
            $galery5_type = mime_content_type($galery5_file);
            $galery5_token = bin2hex(openssl_random_pseudo_bytes(5));
            $update_creation = $db->prepare('UPDATE creations SET galery5 = ? WHERE token = ?');
            $update_creation->execute(array($galery5_token, $token));
            
            if($tokens['galery5'] !== ''){
              $delete_media = $db->prepare('DELETE FROM medias WHERE token = ?');
              $delete_media->execute(array($tokens['galery5']));
            }

            $insert_media = $db->prepare('INSERT INTO medias (token, token_creation, data, type) VALUES (:token, :token_creation, :data, :type)');
            $insert_media->execute(array(
              'token' => $galery5_token,
              'token_creation' => $token,
              'data' => $galery5,
              'type' => $galery5_type
            ));
          }

          if(isset($_POST['delete_galery2'])){
            $update_galery = $db->prepare('UPDATE creations SET galery2 = "" WHERE token = ?');
            $update_galery->execute(array($token));
            $delete_galery = $db->prepare('DELETE FROM medias WHERE token = ?');
            $delete_galery->execute(array($tokens['galery2']));
          }
          if(isset($_POST['delete_galery3'])){
            $update_galery = $db->prepare('UPDATE creations SET galery3 = "" WHERE token = ?');
            $update_galery->execute(array($token));
            $delete_galery = $db->prepare('DELETE FROM medias WHERE token = ?');
            $delete_galery->execute(array($tokens['galery3']));
          }
          if(isset($_POST['delete_galery4'])){
            $update_galery = $db->prepare('UPDATE creations SET galery4 = "" WHERE token = ?');
            $update_galery->execute(array($token));
            $delete_galery = $db->prepare('DELETE FROM medias WHERE token = ?');
            $delete_galery->execute(array($tokens['galery4']));
          }
          if(isset($_POST['delete_galery5'])){
            $update_galery = $db->prepare('UPDATE creations SET galery5 = "" WHERE token = ?');
            $update_galery->execute(array($token));
            $delete_galery = $db->prepare('DELETE FROM medias WHERE token = ?');
            $delete_galery->execute(array($tokens['galery5']));
          }

          if($update){
            header('Location:/creations/'.$title.'-'.$token.'&e=update'); die();
          } else header('Location:/update/'.$old_title.'-'.$token.'-'.$_GET['token_user'].'&e=server_err'); die();
        } else header('Location:/update/'.$old_title.'-'.$token.'-'.$_GET['token_user'].'&e=description'); die();
      } else header('Location:/update/'.$old_title.'-'.$token.'-'.$_GET['token_user'].'&e=date'); die();
    } else header('Location:/update/'.$old_title.'-'.$token.'-'.$_GET['token_user'].'&e=category'); die();
  } else header('Location:/update/'.$old_title.'-'.$token.'-'.$_GET['token_user'].'&e=title'); die();
}