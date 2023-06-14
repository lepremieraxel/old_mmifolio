<?php

require_once('../config/config.php');

if(isset($_POST['update_creation'])){
  if(isset($_POST['title']) && !empty($_POST['title']) && strlen($_POST['title']) <= 100){
    if(isset($_POST['category']) && !empty($_POST['category'])){
      if(isset($_POST['date']) && !empty($_POST['date'])){
        if(isset($_POST['description']) && !empty($_POST['description']) && strlen($_POST['description']) <= 1000){
          
          if(isset($_FILES['photo']) && $_FILES['photo']['error'] == 0 && $_FILES['photo']['size'] > 0 && $_FILES['photo']['size'] <= 5000000){
            $file = $_FILES['photo']['tmp_name'];
            $avatar = file_get_contents($file);
            $avatar_type = mime_content_type($file);
          } else {
            if($count_avatar > 0){
              $avatar = $current_avatar['avatar'];
              $avatar_type = $current_avatar['avatar_type'];
            } else {
              $avatar = '';
              $avatar_type = '';
            }
          }

        } else header('Location:/src/new/modifier.php?e=description'); die();
      } else header('Location:/src/new/modifier.php?e=date'); die();
    } else header('Location:/src/new/modifier.php?e=category'); die();
  } else header('Location:/src/new/modifier.php?e=title'); die();
}