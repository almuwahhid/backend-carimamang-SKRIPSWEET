<?php
require_once realpath(dirname(__FILE__). '/..') .'/Model/PedagangWaitingListDetail.php';
require_once realpath(dirname(__FILE__). '/..') .'/Firebase.php';
require_once realpath(dirname(__FILE__). '/..') .'/Push.php';

$response = array();

  if($_SERVER['REQUEST_METHOD']=='GET'){
    $id_request = $_GET['id_request'];
    $status = $_GET['status'];
    $message = $_GET['message'];
    $username_konsumen = $_GET['username_konsumen'];
    $username_pedagang = $_GET['username_pedagang'];


    $db = new PedagangWaitingListDetail();
    $result = $db->updateRequest($id_request, $status, $message);
    if($result==1){
      $push = null;
      $token = $db->ambilTokenByUsername($username_konsumen);
      if($status==1){
        $push = new Push("Request Diterima", $db->ambilNamaPedagang($username_pedagang)." menerima permintaan Anda");
      }else{
        $push = new Push("Request Ditolak", $db->ambilNamaPedagang($username_pedagang)." menolak permintaan Anda");
      }
      $firebase = new firebase();
      $dataPush = $push->getPush();
      $response['data'] = $firebase->send($token, $dataPush);
      $response['status']= 1;
    }else{
      $response['status']= 0;
    }
    // $response = $result;

  }else{
    $response['status']= 404;
    $response['message']='Invalid Request...';
  }
  echo json_encode($response);
?>
