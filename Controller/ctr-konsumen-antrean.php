<?php
require_once realpath(dirname(__FILE__). '/..') .'/Model/KonsumenAntrean.php';
date_default_timezone_set('Asia/Jakarta');
  if($_SERVER['REQUEST_METHOD']=='POST'){
    $username = $_POST['username'];

    $t=time();
    $tanggal_now = date("Y-m-d", $t);
    $waktu_now = date("H:m", $t);

    $db = new KonsumenAntrean();
    $result = $db->ambilData($username, $tanggal_now);
    $response = $result;

  }else{
    $response['status']= 404;
    $response['message']='Invalid Request...';
  }
  echo json_encode($response);
?>
