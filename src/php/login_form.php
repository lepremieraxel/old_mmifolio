<?php

require_once('../config/config.php');

if(isset($_POST['login']) && !empty($_POST['login'])){
  if(isset($_POST['passwd']) && !empty($_POST['passwd'])){

    $login = htmlspecialchars(strtolower($_POST['login']));
    $passwd = htmlspecialchars($_POST['passwd']);

    $check = $db->prepare('SELECT password, token FROM users WHERE email = ? OR username = ?');
    $check->execute(array($login, $login));
    $count = $check->rowCount();
    $data_user = $check->fetch();

    if($count > 0){
      if(password_verify($passwd, $data_user['password'])){
        session_start();
        $_SESSION['user'] = $data_user['token'];
        $_SESSION['connected'] = true;
        header('Location:/'); die();
      } else header('Location:/src/account/login.php?e=passwd_incorrect'); die();
    } else header('Location:/src/account/login.php?e=login_inexist'); die();
  } else header('Location:/src/account/login.php?e=passwd'); die();
} else header('Location:/src/account/login.php?e=login'); die();