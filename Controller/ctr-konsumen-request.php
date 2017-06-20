<?php
  require_once realpath(dirname(__FILE__). '/..') .'/Model/KonsumenRequest.php';
  require_once realpath(dirname(__FILE__). '/..') .'/Firebase.php';
  require_once realpath(dirname(__FILE__). '/..') .'/Push.php';

  $response = array();
  $dataRequest = array();

  if($_SERVER['REQUEST_METHOD']=='POST'){
    $dataRequest["username_pedagang"] = $_POST['username_pedagang'];
    $dataRequest["username_konsumen"] = $_POST['username_konsumen'];
    $dataRequest["tanggal_req"] = "";
    $dataRequest["waktu_req"] = "";
    $dataRequest["pesan_req"] = $_POST['pesan_req'];
    $dataRequest["lattitude_konsumen"] = $_POST['lattitude_konsumen'];
    $dataRequest["longitude_konsumen"] = $_POST['longitude_konsumen'];

    $db = new KonsumenRequest();
    $result = $db->setRequest($_POST['username_konsumen'], $dataRequest);
    if($result == "berhasil"){
      $push = null;
      $token = $db->getTokenByUsername(username_konsumen);
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
