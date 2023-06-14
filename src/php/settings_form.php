<?php

require_once('../config/config.php');


if(isset($_POST['general-form'])){
  $general_token = $_POST['general_user_token'];
  if(isset($_POST['username']) && !empty($_POST['username']) && $_POST['username'] !== ' ' && strlen($_POST['username']) >= 1 && strlen($_POST['username']) <= 30){
    if(isset($_POST['email']) && !empty($_POST['email']) && $_POST['email'] !== ' ' && strlen($_POST['email']) >= 1 && strlen($_POST['email']) <= 254 && filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
      
      $regExpUsername = "/^(?!\.|\d|_)[a-z0-9._]{1,30}$/";
      $regExpEmail = "/^[a-z]+\.[a-z]+@iut-tarbes\.fr$/";
      
      if(preg_match($regExpUsername, strtolower($_POST['username']))){
        if(preg_match($regExpEmail, strtolower($_POST['email']))){
          
          $username = htmlspecialchars($_POST['username']);
          $email = htmlspecialchars($_POST['email']);
          
          $update_general = $db->prepare('UPDATE users SET email = ?, username = ? WHERE token = ?');
          $update_general->execute(array($email, $username, $general_token));
          if($update_general){
            header('Location:/src/profil/profil.php?user='.$username.'&token='.$general_token.'&e=general'); die();
          } else header('Location:/src/profil/settings.php?user='.$username.'&token='.$general_token.'&e=server_err'); die();
        } else header('Location:/src/profil/settings.php?user='.$username.'&token='.$general_token.'&e=email_invalid'); die();
      } else header('Location:/src/profil/settings.php?user='.$username.'&token='.$general_token.'&e=username_invalid'); die();
    } else header('Location:/src/profil/settings.php?user='.$username.'&token='.$general_token.'&e=email'); die();
  } else header('Location:/src/profil/settings.php?user='.$username.'&token='.$general_token.'&e=username'); die();
}

if(isset($_POST['profil-form'])){
  $profil_token = $_POST['profil_user_token'];
  $profil_redirect = $_POST['profil_redirect'];
  if(isset($_POST['fullname']) && !empty($_POST['fullname']) && $_POST['fullname'] !== ' ' && strlen($_POST['fullname']) >= 3 && strlen($_POST['fullname']) <= 50){

    $select_avatar = $db->prepare('SELECT avatar, avatar_type FROM users WHERE token = ?');
    $select_avatar->execute(array($profil_token));
    $current_avatar = $select_avatar->fetch();
    $count_avatar = $select_avatar->rowCount();

    $fullname = htmlspecialchars($_POST['fullname']);
    $bio = htmlspecialchars($_POST['bio']);
    $website = htmlspecialchars($_POST['website']);
    $portfolio = htmlspecialchars($_POST['portfolio']);
    $instagram = htmlspecialchars($_POST['instagram']);
    $github = htmlspecialchars($_POST['github']);
    $dribbble = htmlspecialchars($_POST['dribbble']);
    $behance = htmlspecialchars($_POST['behance']);
    
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

    $update_profil = $db->prepare('UPDATE users SET fullname = ?, bio = ?, avatar = ?, avatar_type = ?, website = ?, portfolio = ?, instagram = ?, github = ?, dribbble = ?, behance = ? WHERE token = ?');
    $update_profil->execute(array($fullname, $bio, $avatar, $avatar_type, $website, $portfolio, $instagram, $github, $dribbble, $behance, $profil_token));
    if($update_profil){
      header('Location:/src/profil/profil.php?'.$profil_redirect.'&e=profil'); die();
    } else header('Location:/src/profil/settings.php?'.$profil_redirect.'&e=server_err'); die();
  } else header('Location:/src/profil/settings.php?'.$profil_redirect.''); die();
}

if(isset($_POST['delete-photo'])){
  $delete_photo_token = $_POST['delete_photo_user_token'];
  $delete_photo_redirect = $_POST['delete_photo_redirect'];
  $avatar = '';
  $avatar_type = '';

  $update_delete_photo = $db->prepare('UPDATE users SET avatar = ?, avatar_type = ? WHERE token = ?');
  $update_delete_photo->execute(array($avatar, $avatar_type, $delete_photo_token));

  if($update_delete_photo){
    header('Location:/src/profil/profil.php?'.$delete_photo_redirect.'&e=delete_photo'); die();
  } else header('Location:/src/profil/settings.php?'.$delete_photo_redirect.'&e=server_err'); die();
}

if(isset($_POST['password-form'])){
  $password_token = $_POST['password_user_token'];
  $password_redirect = $_POST['password_redirect'];
  $regExpPasswd = "/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@,?;.:\-_\!+=])[a-zA-Z\d@,?;.:\!-_+=]{8,30}$/";
  if(isset($_POST['oldpasswd']) && !empty($_POST['oldpasswd'])){
    if(isset($_POST['newpasswd']) && !empty($_POST['newpasswd']) && $_POST['newpasswd'] !== ' ' && strlen($_POST['newpasswd']) >= 8 && strlen($_POST['newpasswd']) <= 30){
      if(isset($_POST['oldpasswd']) && !empty($_POST['oldpasswd']) && $_POST['oldpasswd'] !== ' ' && strlen($_POST['oldpasswd']) >= 8 && strlen($_POST['oldpasswd']) <= 30){
        if($_POST['newpasswd'] == $_POST['renewpasswd']){
          if(preg_match($regExpPasswd, $_POST['newpasswd'])){

            $cost = ['cost' => 12];
            $oldpasswd = htmlspecialchars($_POST['oldpasswd']);
            $newpasswd = htmlspecialchars($_POST['newpasswd']);
            $newpasswd = password_hash($newpasswd, PASSWORD_BCRYPT, $cost);

            $select_password = $db->prepare('SELECT password FROM users WHERE token = ?');
            $select_password->execute(array($password_token));
            $oldpasswd_server = $select_password->fetch();

            if(password_verify($oldpasswd, $oldpasswd_server['password'])){

              $update_password = $db->prepare('UPDATE users SET password = ? WHERE token = ?');
              $update_password->execute(array($newpasswd, $password_token));

              if($update_password){
                header('Location:/src/profil/profil.php?'.$password_redirect.'&e=passwd'); die();
              } else header('Location:/src/profil/settings.php?'.$password_redirect.'&e=server_err'); die();
            } else header('Location:/src/profil/settings.php?'.$password_redirect.'&e=oldpasswd_invalid'); die();
          } else header('Location:/src/profil/settings.php?'.$password_redirect.'&e=newpasswd_invalid'); die();
        } else header('Location:/src/profil/settings.php?'.$password_redirect.'&e=passwd_diff'); die();
      } else header('Location:/src/profil/settings.php?'.$password_redirect.'&e=renewpasswd'); die();
    } else header('Location:/src/profil/settings.php?'.$password_redirect.'&e=newpasswd'); die();
  } else header('Location:/src/profil/settings.php?'.$password_redirect.'&e=oldpasswd'); die();
}

if(isset($_POST['data_creations'])){
  $data_creations_token = $_POST['data_creations_user_token'];
  $data_creations_redirect = $_POST['data_creations_redirect'];

  $delete_creations = $db->prepare('DELETE FROM creations WHERE token_user = ?');
  $delete_creations->execute(array($data_creations_token));
  if($delete_creations){
    header('Location:/src/profil/profil.php?'.$data_creations_redirect.'&e=delete_creations'); die();
  } else header('Location:/src/profil/settings.php?'.$data_creations_redirect.'&e=server_err'); die();
}

if(isset($_POST['data_likes'])){
  $data_likes_token = $_POST['data_likes_user_token'];
  $data_likes_redirect = $_POST['data_likes_redirect'];

  $delete_likes = $db->prepare('DELETE FROM likes WHERE token_user = ?');
  $delete_likes->execute(array($data_likes_token));
  if($delete_likes){
    header('Location:/src/profil/profil.php?'.$data_likes_redirect.'&e=delete_likes'); die();
  } else header('Location:/src/profil/settings.php?'.$data_likes_redirect.'&e=server_err'); die();
}

if(isset($_POST['data_account'])){
  $data_account_token = $_POST['data_account_user_token'];
  $data_account_redirect = $_POST['data_account_redirect'];

  $delete_account = $db->prepare('DELETE FROM users WHERE token = ?');
  $delete_account->execute(array($data_account_token));
  if($delete_account){
    $_SESSION['user'] = '';
    header('Location:/'); die();
  } else header('Location:/src/profil/settings.php?'.$data_account_redirect.'&e=server_err'); die();
}