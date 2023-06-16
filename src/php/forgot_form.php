<?php

require_once('../config/config.php');

$regExpEmail = "/^[a-z]+\.[a-z]+@iut-tarbes\.fr$/";

if(isset($_POST['email']) && !empty($_POST['email']) && $_POST['email'] !== ' ' && strlen($_POST['email']) >= 1 && strlen($_POST['email']) <= 254 && filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
  if(preg_match($regExpEmail, strtolower($_POST['email']))){

    $email = htmlspecialchars(strtolower($_POST['email']));

    $select = $db->prepare('SELECT token FROM users WHERE email = ?');
    $select->execute(array($email));
    $token_user = $select->fetch();
    $count = $select->rowCount();

    if($count > 0){
      
      $token_forgot = bin2hex(openssl_random_pseudo_bytes(5));
      $link = 'https://mmifolio.axelmarcial.com/account/reset-password/'.$token_forgot.'';

      $insert = $db->prepare('INSERT INTO forgot_passwd (token, token_user) VALUES (:token, :token_user)');
      $insert->execute(array('token' => $token_forgot, 'token_user' => $token_user['token']));

      if($insert){
        $myemail = 'hello@axelmarcial.com';
        $to = $email;
        $subject = "Reinitialisation du mot de passe - mmifolio";
        $body = "Cliquez sur ce lien pour reinitialiser votre mot de passe : $link";
        $headers = "From: $myemail\n";
        mail($to, $subject, $body, $headers);
        header('Location:/account/forgot-password/send'); die();
      } else header('Location:/account/forgot-password/server_err'); die();
    } else header('Location:/account/forgot-password/email_inexist'); die();
  } else header('Location:/account/forgot-password/email_invalid'); die();
} else header('Location:/account/forgot-password/email'); die();