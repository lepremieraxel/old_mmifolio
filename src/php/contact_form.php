<?php

if(isset($_POST['fullname']) && !empty($_POST['fullname'])){
  if(isset($_POST['reason']) && !empty($_POST['reason'])){
    if(isset($_POST['email']) && !empty($_POST['email'])){
      if(isset($_POST['message']) && !empty($_POST['message'])){

        $fullname = htmlspecialchars($_POST['fullname']);
        $reason = htmlspecialchars($_POST['reason']);
        $email = htmlspecialchars($_POST['email']);
        $message = htmlspecialchars($_POST['message']);

        $myemail = 'hello@axelmarcial.com';
        $subject = "[mmifolio] - $reason - $fullname";
        $body = "Message de $fullname - $email\n
        Raison : $reason.\n
        Message :\n
        $message";
        $headers = "From: $myemail\n";
        mail($email, $subject, $body, $headers);

        header('Location:/contact/send'); die();
      } else header('Location:/contact/message'); die();
    } else header('Location:/contact/email'); die();
  } else header('Location:/contact/reason'); die();
} else header('Location:/contact/fullname'); die();