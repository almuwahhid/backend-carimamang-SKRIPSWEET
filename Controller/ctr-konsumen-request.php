<?php
  require_once realpath(dirname(__FILE__). '/..') .'/Model/KonsumenRequest.php';
  require_once realpath(dirname(__FILE__). '/..') .'/Firebase.php';
  require_once realpath(dirname(__FILE__). '/..') .'/Push.php';

  $response = array();
  $dataRequest = array();
  date_default_timezone_set('Asia/Jakarta');
  $t=time();
  $tanggal_now = date("Y-m-d", $t);
  $waktu_now = date("H:m", $t);


  if($_SERVER['REQUEST_METHOD']=='GET'){
    $dataRequest["username_pedagang"] = $_GET['username_pedagang'];
    $dataRequest["username_konsumen"] = $_GET['username_konsumen'];
    $dataRequest["tanggal_req"] = $tanggal_now;
    $dataRequest["waktu_req"] = $waktu_now;
    $dataRequest["pesan_req"] = $_GET['pesan_req'];
    $dataRequest["lattitude_konsumen"] = $_GET['lattitude_konsumen'];
    $dataRequest["longitude_konsumen"] = $_GET['longitude_konsumen'];

    $db = new KonsumenRequest();
    $result = $db->setRequest($_GET['username_konsumen'], $dataRequest);
    if($result == "berhasil"){
      $push = null;
      $token = $db->getTokenByUsername($dataRequest["username_pedagang"]);
      $push = new Push("Request Jualan", "1 Permintaan Masuk");
      $firebase = new firebase();

      $dataPush = $push->getPush();

      $response['data'] = $firebase->send($token, $dataPush);
    }
  }else{
    $response['status']= 404;
    $response['message']='Invalid Request...';
  }
  echo json_encode($response);
?>
