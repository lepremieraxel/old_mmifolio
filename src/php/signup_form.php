<?php

require_once('../config/config.php');

$regExpUsername = "/^(?!\.|\d|_)[a-z0-9._]{1,30}$/";
$regExpEmail = "/^[a-z]+\.[a-z]+@iut-tarbes\.fr$/";
$regExpPasswd = "/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@,?;.:\-_\!+=])[a-zA-Z\d@,?;.:\!-_+=]{8,30}$/";

if(isset($_POST['fullname']) && !empty($_POST['fullname']) && $_POST['fullname'] !== ' ' && strlen($_POST['fullname']) >= 3 && strlen($_POST['fullname']) <= 50){
  if(isset($_POST['promo']) && !empty($_POST['promo']) && $_POST['promo'] !== ' '){
    if(isset($_POST['username']) && !empty($_POST['username']) && $_POST['username'] !== ' ' && strlen($_POST['username']) >= 1 && strlen($_POST['username']) <= 30){
      if(isset($_POST['email']) && !empty($_POST['email']) && $_POST['email'] !== ' ' && strlen($_POST['email']) >= 1 && strlen($_POST['email']) <= 254 && filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
        if(isset($_POST['passwd']) && !empty($_POST['passwd']) && $_POST['passwd'] !== ' ' && strlen($_POST['passwd']) >= 8 && strlen($_POST['passwd']) <= 30 && isset($_POST['repasswd']) && !empty($_POST['repasswd']) && $_POST['repasswd'] !== ' ' && strlen($_POST['repasswd']) >= 8 && strlen($_POST['repasswd']) <= 30){
          if($_POST['passwd'] == $_POST['repasswd']){
            
            if(preg_match($regExpUsername, strtolower($_POST['username']))){
              if(preg_match($regExpEmail, strtolower($_POST['email']))){
                if(preg_match($regExpPasswd, $_POST['passwd'])){
                  
                  $fullname = htmlspecialchars($_POST['fullname']);
                  $promo = htmlspecialchars($_POST['promo']);
                  $username = htmlspecialchars(strtolower($_POST['username']));
                  $email = htmlspecialchars(strtolower($_POST['email']));
                  $passwd = htmlspecialchars($_POST['passwd']);
                  $repasswd = htmlspecialchars($_POST['repasswd']);
                  
                  $avatar = "";
                  $avatar_type = "";
                  $cost = ['cost' => 12];
                  $token = bin2hex(openssl_random_pseudo_bytes(5));
                  $verif_code = strtoupper(bin2hex(openssl_random_pseudo_bytes(3)));
                  $is_verif = 0;
                  
                  $selectE = $db->prepare('SELECT * FROM users WHERE email = ?');
                  $selectE->execute(array($email));
                  $countE = $selectE->rowCount();
                  if($countE > 0){
                    header('Location:/account/signup/email_exist'); die();
                  }
                  $selectU = $db->prepare('SELECT * FROM users WHERE username = ?');
                  $selectU->execute(array($username));
                  $countU = $selectU->rowCount();
                  if($countU > 0){
                    header('Location:/account/signup/username_exist'); die();
                  }
                  
                  if(isset($_FILES['profile-picture']) && $_FILES['profile-picture']['error'] == 0 && $_FILES['profile-picture']['size'] > 0 && $_FILES['profile-picture']['size'] <= 5000000){
                    $file = $_FILES['profile-picture']['tmp_name'];
                    $avatar = file_get_contents($file);
                    $avatar_type = mime_content_type($file);
                  }
                  
                  $insert = $db->prepare('INSERT INTO users (token, verif_code, is_verif, email, fullname, username, password, promo, avatar, avatar_type) VALUES(:token, :verif_code, :is_verif, :email, :fullname, :username, :password, :promo, :avatar, :avatar_type)');
                  $insert->execute(array(
                    'token' => $token,
                    'verif_code' => $verif_code,
                    'is_verif' => $is_verif,
                    'email' => $email,
                    'fullname' => $fullname,
                    'username' => $username,
                    'password' => password_hash($passwd, PASSWORD_BCRYPT, $cost),
                    'promo' => $promo,
                    'avatar' => $avatar,
                    'avatar_type' => $avatar_type
                  ));
                  if($insert){
                    $myemail = 'hello@axelmarcial.com';
                    $subject = "Code de vérification - mmifolio";
                    $body = "Votre code de vérification : $verif_code";
                    $headers = "From: $myemail\n";
                    mail($email, $subject, $body, $headers);
                    header('Location:/account/verification?token='.$token.''); die();
                  } else header('Location:/account/signup/server_err'); die();

                } else header('Location:/account/signup/password_invalid'); die();
              } else header('Location:/account/signup/email_invalid'); die();
            } else header('Location:/account/signup/username_invalid'); die();
          } else header('Location:/account/signup/password_diff'); die();
        } else header('Location:/account/signup/password'); die();
      } else header('Location:/account/signup/email'); die();
    } else header('Location:/account/signup/username'); die();
  } else header('Location:/account/signup/promo'); die();
} else header('Location:/account/signup/fullname'); die();