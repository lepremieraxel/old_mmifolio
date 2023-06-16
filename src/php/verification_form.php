<?php

require_once('../config/config.php');

if(isset($_POST['otp1'])){
  
  $otp = $_POST['otp1'].$_POST['otp2'].$_POST['otp3'].$_POST['otp4'].$_POST['otp5'].$_POST['otp6'];

  $select = $db->prepare('SELECT verif_code FROM users WHERE token = ?');
  $select->execute(array($_POST['token']));
  $verif_code = $select->fetch();
  
  if($otp == $verif_code['verif_code']){
    $update = $db->prepare('UPDATE users SET is_verif = 1 WHERE token = ?');
    $update->execute(array($_POST['token']));

    if($update){

      session_start();
      $_SESSION['user'] = $_POST['token'];
      $_SESSION['connected'] = true;
      header('Location:/');

    } else header('Location:/account/verification/'.$_POST['token'].'&e=server_err'); die();
  } else header('Location:/account/verification/'.$_POST['token'].'&e=otp_invalid'); die();
} else header('Location:/account/verification/'.$_POST['token'].'&e=otp'); die();