<?php
require_once realpath(dirname(__FILE__). '/..') .'/Model/PedagangLogin.php';
  $response = array();
  if($_SERVER['REQUEST_METHOD']=='POST'){
    $password = md5($_POST['password']);
    $username = $_POST['username'];
    $token = $_POST['token'];

    $db = new PedagangLogin();
    $result = $db->loginPedagang($username, $password);
    if($result){
      if($token != "undefined"){
        $result2 = $db->updateToken($username, $token);
        if($result2){
          $response['status'] = 1;
          $response['message'] = 'Berhasil Login';
        }else{
          $response['status'] = 2;
          $response['message'] = 'Berhasil Login';
        }
      }else{
        $response['status'] = 1;
        $response['message'] = 'Berhasil Login';
      }
    }else{
      $response['status'] = 0;
      $response['message'] = 'Gagal Login';
    }
  }else{
    $response['error']= 404;
    $response['message']='Invalid Request...';
  }
  echo json_encode($response);
?>
