<?php

require_once('../config/config.php');
session_start();

if(isset($_POST['title']) && !empty($_POST['title']) && strlen($_POST['title']) <= 100){
  if(isset($_POST['category']) && !empty($_POST['category'])){
    if(isset($_POST['description']) && !empty($_POST['description']) && strlen($_POST['description']) <= 1000){
      if(isset($_POST['date']) && !empty($_POST['date'])){
        if(isset($_FILES['apercu']) && $_FILES['apercu']['error'] == 0 && $_FILES['apercu']['size'] > 0 && $_FILES['apercu']['size'] <= 5000000){
          if(isset($_FILES['galery']) && $_FILES['galery']['error'][0] == 0 && $_FILES['galery']['size'][0] > 0 && $_FILES['galery']['size'][0] <= 5000000 && sizeof($_FILES['galery']['name']) <= 5){


            $title = $_POST['title'];
            $category_flat = htmlspecialchars($_POST['category']);
            $description = $_POST['description'];
            $url = htmlspecialchars($_POST['url']);
            $date = htmlspecialchars($_POST['date']);
            $galery = $_FILES['galery'];
            $token = bin2hex(openssl_random_pseudo_bytes(5));
            $apercu_token = '';
            $galery1_token = '';
            $galery2_token = '';
            $galery3_token = '';
            $galery4_token = '';
            $galery5_token = '';
            $insert_err = [];

            $select_cat = $db->prepare('SELECT * FROM categories WHERE flat_name = ?');
            $select_cat->execute(array($category_flat));
            $category_data = $select_cat->fetch();
            $category = $category_data['name'];
            
            $insert = $db->prepare('INSERT INTO creations (token, token_user, title, category, category_flat, description, date, link, apercu, galery1, galery2, galery3, galery4, galery5) VALUES(:token, :token_user, :title, :category, :category_flat, :description, :date, :link, :apercu, :galery1, :galery2, :galery3, :galery4, :galery5)');
            $insert->execute(array(
              'token' => $token,
              'token_user' => $_SESSION['user'],
              'title' => $title,
              'category' => $category,
              'category_flat' => $category_flat,
              'description' => $description,
              'date' => $date,
              'link' => $url,
              'apercu' => $apercu_token,
              'galery1' => $galery1_token,
              'galery2' => $galery2_token,
              'galery3' => $galery3_token,
              'galery4' => $galery4_token,
              'galery5' => $galery5_token
            ));
            
            $apercu_file = $_FILES['apercu']['tmp_name'];
            $apercu = file_get_contents($apercu_file);
            $apercu_type = mime_content_type($apercu_file);
            $apercu_token = bin2hex(openssl_random_pseudo_bytes(5));
            $update_creation = $db->prepare('UPDATE creations SET apercu = ? WHERE token = ?');
            $update_creation->execute(array($apercu_token, $token));
            $insert_media = $db->prepare('INSERT INTO medias (token, token_creation, data, type) VALUES(:token, :token_creation, :data, :type)');
              $insert_media->execute(array(
                'token' => $apercu_token,
                'token_creation' => $token,
                'data' => $apercu,
                'type' => $apercu_type
              ));
              if($insert_media){
                array_push($insert_err, true);
              } else {
                array_push($insert_err, false);
              }


            if(sizeof($galery['name']) > 0){
              $galery1_file = $_FILES['galery']['tmp_name'][0];
              $galery1 = file_get_contents($galery1_file);
              $galery1_type = mime_content_type($galery1_file);
              $galery1_token = bin2hex(openssl_random_pseudo_bytes(5));
              $update_creation = $db->prepare('UPDATE creations SET galery1 = ? WHERE token = ?');
              $update_creation->execute(array($galery1_token, $token));
              $insert_media = $db->prepare('INSERT INTO medias (token, token_creation, data, type) VALUES(:token, :token_creation, :data, :type)');
              $insert_media->execute(array(
                'token' => $galery1_token,
                'token_creation' => $token,
                'data' => $galery1,
                'type' => $galery1_type
              ));
              if($insert_media){
                array_push($insert_err, true);
              } else {
                array_push($insert_err, false);
              }
            }
            if(sizeof($galery['name']) > 1){
              $galery2_file = $_FILES['galery']['tmp_name'][1];
              $galery2 = file_get_contents($galery2_file);
              $galery2_type = mime_content_type($galery2_file);
              $galery2_token = bin2hex(openssl_random_pseudo_bytes(5));
              $update_creation = $db->prepare('UPDATE creations SET galery2 = ? WHERE token = ?');
              $update_creation->execute(array($galery2_token, $token));
              $insert_media = $db->prepare('INSERT INTO medias (token, token_creation, data, type) VALUES(:token, :token_creation, :data, :type)');
              $insert_media->execute(array(
                'token' => $galery2_token,
                'token_creation' => $token,
                'data' => $galery2,
                'type' => $galery2_type
              ));
              if($insert_media){
                array_push($insert_err, true);
              } else {
                array_push($insert_err, false);
              }
            }
            if(sizeof($galery['name']) > 2){
              $galery3_file = $_FILES['galery']['tmp_name'][2];
              $galery3 = file_get_contents($galery3_file);
              $galery3_type = mime_content_type($galery3_file);
              $galery3_token = bin2hex(openssl_random_pseudo_bytes(5));
              $update_creation = $db->prepare('UPDATE creations SET galery3 = ? WHERE token = ?');
              $update_creation->execute(array($galery3_token, $token));
              $insert_media = $db->prepare('INSERT INTO medias (token, token_creation, data, type) VALUES(:token, :token_creation, :data, :type)');
              $insert_media->execute(array(
                'token' => $galery3_token,
                'token_creation' => $token,
                'data' => $galery3,
                'type' => $galery3_type
              ));
              if($insert_media){
                array_push($insert_err, true);
              } else {
                array_push($insert_err, false);
              }
            }
            if(sizeof($galery['name']) > 3){
              $galery4_file = $_FILES['galery']['tmp_name'][3];
              $galery4 = file_get_contents($galery4_file);
              $galery4_type = mime_content_type($galery4_file);
              $galery4_token = bin2hex(openssl_random_pseudo_bytes(5));
              $update_creation = $db->prepare('UPDATE creations SET galery4 = ? WHERE token = ?');
              $update_creation->execute(array($galery4_token, $token));
              $insert_media = $db->prepare('INSERT INTO medias (token, token_creation, data, type) VALUES(:token, :token_creation, :data, :type)');
              $insert_media->execute(array(
                'token' => $galery4_token,
                'token_creation' => $token,
                'data' => $galery4,
                'type' => $galery4_type
              ));
              if($insert_media){
                array_push($insert_err, true);
              } else {
                array_push($insert_err, false);
              }
            }
            if(sizeof($galery['name']) > 4){
              $galery5_file = $_FILES['galery']['tmp_name'][4];
              $galery5 = file_get_contents($galery5_file);
              $galery5_type = mime_content_type($galery5_file);
              $galery5_token = bin2hex(openssl_random_pseudo_bytes(5));
              $update_creation = $db->prepare('UPDATE creations SET galery5 = ? WHERE token = ?');
              $update_creation->execute(array($galery5_token, $token));
              $insert_media = $db->prepare('INSERT INTO medias (token, token_creation, data, type) VALUES(:token, :token_creation, :data, :type)');
              $insert_media->execute(array(
                'token' => $galery5_token,
                'token_creation' => $token,
                'data' => $galery5,
                'type' => $galery5_type
              ));
              if($insert_media){
                array_push($insert_err, true);
              } else {
                array_push($insert_err, false);
              }
            }
            $select_date = $db->prepare('SELECT * FROM year WHERE name = ?');
            $select_date->execute(array($date));
            $count_date = $select_date->rowCount();
            if($count_date < 1){
              $insert_date = $db->prepare('INSERT INTO year (name) VALUES(:name)');
              $insert_date->execute(array('name' => $date));
              if($insert_date){
                array_push($insert_err, true);
              } else {
                array_push($insert_err, false);
              }
            }


            if($insert && !in_array(false, $insert_err)){
              header('Location:/creations/'.str_replace(" ", "-", strtolower($title)).'-'.$token.'&e=add'); die();
            } else header('Location:/add/server_err'); die();

          } else header('Location:/add/galery'); die();
        } else header('Location:/add/apercu'); die();
      } else header('Location:/add/date'); die();
    } else header('Location:/add/description'); die();
  } else header('Location:/add/category'); die();
} else header('Location:/add/title'); die();