<?php

require_once('../config/config.php');

$regExpPasswd = "/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@,?;.:\-_\!+=])[a-zA-Z\d@,?;.:\!-_+=]{8,30}$/";

if(isset($_POST['t']) && !empty($_POST['t'])){
  if(isset($_POST['passwd']) && !empty($_POST['passwd']) && $_POST['passwd'] !== ' ' && strlen($_POST['passwd']) >= 8 && strlen($_POST['passwd']) <= 30){
    if(isset($_POST['repasswd']) && !empty($_POST['repasswd']) && $_POST['repasswd'] !== ' ' && strlen($_POST['repasswd']) >= 8 && strlen($_POST['repasswd']) <= 30){
      if($_POST['passwd'] == $_POST['repasswd']){
        if(preg_match($regExpPasswd, $_POST['passwd'])){
          
          $passwd = htmlspecialchars($_POST['passwd']);
          $cost = ['cost' => 12];
          $passwd = password_hash($passwd, PASSWORD_BCRYPT, $cost);
          $token = $_POST['t'];

          $select =$db->prepare('SELECT token_user FROM forgot_passwd WHERE token = ?');
          $select->execute(array($token));
          $token_user = $select->fetch();
          $count_forgot = $select->rowCount();

          if($count_forgot > 0){

            $update = $db->prepare('UPDATE users SET password = ? WHERE token = ?');
            $update->execute(array($passwd, $token_user['token']));

            if($update){

              $delete = $db->prepare('DELETE FROM forgot_passwd WHERE token = ?');
              $delete->execute(array($token));

              header('Location:/account/login/passwd_update'); die();
            } else header('Location:/account/reset-password/'.$token.'/server_err'); die();
          } else header('Location:/'); die();
        } else header('Location:/account/reset-password/'.$token.'/passwd_invalid'); die();
      } else header('Location:/account/reset-password/'.$token.'/passwd_diff'); die();
    } else header('Location:/account/reset-password/'.$token.'/repasswd'); die();
  } else header('Location:/account/reset-password/'.$token.'/passwd'); die();
} else header('Location:/'); die();