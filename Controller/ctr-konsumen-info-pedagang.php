<?php
require_once realpath(dirname(__FILE__). '/..') .'/Model/KonsumenInfoPedagang.php';
  if($_SERVER['REQUEST_METHOD']=='POST'){
    $username_pedagang = $_POST['username_pedagang'];

    $db = new KonsumenInfoPedagang();
    $result = $db->ambilData($username_pedagang);
    $response = $result;
  }else{
    $response['status']= 404;
    $response['message']='Invalid Request...';
  }
  echo json_encode($response);
?>
