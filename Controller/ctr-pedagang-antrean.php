<?php
require_once realpath(dirname(__FILE__). '/..') .'/Model/PedagangAntrean.php';
  if($_SERVER['REQUEST_METHOD']=='POST'){
    $username = $_POST['username'];

    $t=time();
    $tanggal_now = date("Y-m-d", $t);
    $waktu_now = date("H:m", $t);

    $db = new PedagangAntrean();
    $result = $db->getData($username, $tanggal_now);
    $response = $result;

  }else{
    $response['status']= 404;
    $response['message']='Invalid Request...';
  }
  echo json_encode($response);
?>
