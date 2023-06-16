<?php

require_once('../config/config.php');

if(isset($_POST['login']) && !empty($_POST['login'])){
  if(isset($_POST['passwd']) && !empty($_POST['passwd'])){

    $login = htmlspecialchars(strtolower($_POST['login']));
    $passwd = htmlspecialchars($_POST['passwd']);

    $check = $db->prepare('SELECT token, is_verif, password FROM users WHERE email = ? OR username = ?');
    $check->execute(array($login, $login));
    $count = $check->rowCount();
    $data_user = $check->fetch();

    if($count > 0){
      if(password_verify($passwd, $data_user['password'])){
        session_start();
        $_SESSION['user'] = $data_user['token'];
        $_SESSION['connected'] = true;
        header('Location:'.$_SESSION['last_page'].''); die();
      } else header('Location:/account/login/passwd_incorrect'); die();
    } else header('Location:/account/login/login_inexist'); die();
  } else header('Location:/account/login/passwd'); die();
} else header('Location:/account/login/login'); die();