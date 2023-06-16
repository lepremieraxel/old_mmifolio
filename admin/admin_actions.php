<?php

require_once('../src/config/config.php');

if(isset($_POST['category_id'])){
  $delete = $db->prepare('DELETE FROM categories WHERE id = ?');
  $delete->execute(array($_POST['category_id']));
  if($delete){
    header('Location:/admin/admin.php?e=delete'); die();
  } else header('Location:/admin/admin.php?e=server_err'); die();
}

if(isset($_POST['promo_id'])){
  $delete = $db->prepare('DELETE FROM promo WHERE id = ?');
  $delete->execute(array($_POST['promo_id']));
  if($delete){
    header('Location:/admin/admin.php?e=delete'); die();
  } else header('Location:/admin/admin.php?e=server_err'); die();
}

if(isset($_POST['category'])){
  $category = htmlspecialchars($_POST['category']);
  $category_flat = strtolower($category);
  $category_flat = str_replace(' ', '-', $category_flat);
  $delete_chara = array('à'=>'a', 'á'=>'a', 'â'=>'a', 'ã'=>'a', 'ä'=>'a', 'å'=>'a', 'æ'=>'a', 'ç'=>'c', 'è'=>'e', 'é'=>'e', 'ê'=>'e', 'ë'=>'e', 'ì'=>'i', 'í'=>'i', 'î'=>'i', 'ï'=>'i', 'ñ'=>'n', 'ù'=>'u', 'ú'=>'u', 'û'=>'u');
  $category_flat = strtr($category_flat, $delete_chara);

  $insert = $db->prepare('INSERT INTO categories (name, flat_name) VALUES (:name, :flat_name)');
  $insert->execute(array('name' => $category, 'flat_name' => $category_flat));
  if($insert){
    header("Location:/admin/admin.php?e=added"); die();
  } else header("Location:/admin/admin.php?e=server_err"); die();
}

if(isset($_POST['promo'])){
  $promo = htmlspecialchars($_POST['promo']);
  $promo_flat = strtolower($promo);
  $promo_flat = str_replace(' ', '', $promo_flat);
  $delete_chara = array('à'=>'a', 'á'=>'a', 'â'=>'a', 'ã'=>'a', 'ä'=>'a', 'å'=>'a', 'æ'=>'a', 'ç'=>'c', 'è'=>'e', 'é'=>'e', 'ê'=>'e', 'ë'=>'e', 'ì'=>'i', 'í'=>'i', 'î'=>'i', 'ï'=>'i', 'ñ'=>'n', 'ù'=>'u', 'ú'=>'u', 'û'=>'u', '(' => '-', ')' => '');
  $promo_flat = strtr($promo_flat, $delete_chara);

  $insert = $db->prepare('INSERT INTO promo (name, flat_name) VALUES (:name, :flat_name)');
  $insert->execute(array('name' => $promo, 'flat_name' => $promo_flat));
  if($insert){
    header("Location:/admin/admin.php?e=added"); die();
  } else header("Location:/admin/admin.php?e=server_err"); die();
}