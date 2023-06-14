<?php

session_start();
$_SESSION['user'] = '';
$_SESSION['connected'] = false;
header('Location:/'); die();