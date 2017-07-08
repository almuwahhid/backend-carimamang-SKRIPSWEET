<?php
require_once realpath(dirname(__FILE__). '/..') .'/Model/KonsumenUbahPassword.php';
  if($_SERVER['REQUEST_METHOD']=='POST'){
    $username = $_POST['username'];
    $password = md5($_POST['password']);
    $password_lama = md5($_POST['password_lama']);

    $db = new KonsumenUbahPassword();
    $result = $db->setData($username, $password, $password_lama);
    $response = $result;
  }else{
    $response['status']= 404;
    $response['message']='Invalid Request...';
  }
  echo json_encode($response);
?>
