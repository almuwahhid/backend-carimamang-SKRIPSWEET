<?php
require_once realpath(dirname(__FILE__). '/..') .'/Model/KonsumenLogin.php';
  $response = array();
  if($_SERVER['REQUEST_METHOD']=='POST'){
    $password = md5($_POST['password']);
    $username = $_POST['username'];

    $db = new KonsumenLogin();
    $result = $db->loginKonsumen($username, $password);
    if($result){
      $response['error'] = 0;
      $response['message'] = 'Berhasil Login';
    }else{
      $response['error'] = 1;
      $response['message'] = 'Gagal Login';
    }
  }else{
    $response['error']= 404;
    $response['message']='Invalid Request...';
  }
  echo json_encode($response);
?>
