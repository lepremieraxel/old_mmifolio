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
    $token_creation = $decoded['token_creation'];

    $select_user = $db->prepare('SELECT * FROM users WHERE token = ?');
    $select_user->execute(array($token_user));
    $data_user = $select_user->fetch();
    $count_user = $select_user->rowCount();

    if($count_user > 0){
      if($_SESSION['user'] == $data_user['token']){
        if($data_user['is_verif'] == 1){
          $select_like = $db->prepare('SELECT COUNT(*) FROM likes WHERE token_user = ? AND token_creation = ?');
          $select_like->execute(array($token_user, $token_creation));
          $isLiked = $select_like->fetchColumn();
          if($isLiked < 1){
            $insert = $db->prepare('INSERT INTO likes (token_user, token_creation) VALUES (:token_user, :token_creation)');
            $insert->execute(array('token_user' => $token_user, 'token_creation' => $token_creation));
            if($insert){
              $select_nb = $db->prepare('SELECT COUNT(*) FROM likes WHERE token_creation = ?');
              $select_nb->execute(array($token_creation));
              $nbLikes = $select_nb->fetchColumn();
              echo '{"error":"liked", "likes":'.$nbLikes.'}';
            } else echo '{"error":"server_err"}';
          } else {
            $delete = $db->prepare('DELETE FROM likes WHERE token_user = ? AND token_creation = ?');
            $delete->execute(array($token_user, $token_creation));
            if($delete){
              $select_nb = $db->prepare('SELECT COUNT(*) FROM likes WHERE token_creation = ?');
              $select_nb->execute(array($token_creation));
              $nbLikes = $select_nb->fetchColumn();
              echo '{"error":"unliked", "likes":'.$nbLikes.'}';
            } else echo '{"error":"server_err"}';
          }
        } else echo '{"error":"user_not_verif"}';
      } else echo '{"error":"user_not_connected"}';
    } else echo '{"error":"user_inexist"}';
  }
} else echo '{"error":"content_type"}';