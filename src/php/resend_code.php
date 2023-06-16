<?php

require_once('../config/config.php');
session_start();

$contentType = isset($_SERVER["CONTENT_TYPE"]) ? trim($_SERVER["CONTENT_TYPE"]) : '';

if ($contentType === "application/json") {
  $content = trim(file_get_contents("php://input"));
  $decoded = json_decode($content, true);

  if(!is_array($decoded)) {
    echo '{"error":"not_decoded"}';
  } else {
    $token_user = $decoded['token_user'];

    $select_user = $db->prepare('SELECT * FROM users WHERE token = ?');
    $select_user->execute(array($token_user));
    $data_user = $select_user->fetch();
    $count_user = $select_user->rowCount();

    if($count_user > 0){
      if($_SESSION['user'] == $data_user['token']){
        if($data_user['is_verif'] == 0){
          $myemail = 'hello@axelmarcial.com';
          $subject = "Code de vérification - mmifolio";
          $body = "Votre code de vérification : ".$data_user['verif_code']."";
          $headers = "From: $myemail\n";
          mail($data_user['email'], $subject, $body, $headers);
          echo '{"error":"sent"}';
        } else echo '{"error":"user_already_verif"}';
      } else echo '{"error":"user_not_connected"}';
    } else echo '{"error":"user_inexist"}';
  }
} else echo '{"error":"content_type"}';