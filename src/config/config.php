<?php

try {
  $db = new PDO('mysql:host=localhost;dbname=mmifolio;charset=utf8', 'root', '');
} catch (Exception $e) {
  die('Error : ' . $e->getMessage());
}