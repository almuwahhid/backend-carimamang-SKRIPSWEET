<?php
require_once realpath(dirname(__FILE__). '/..') .'/Model/KonsumenUbahNama.php';
  if($_SERVER['REQUEST_METHOD']=='GET'){
    $username = $_GET['username'];
    $nama_konsumen = $_GET['nama_konsumen'];

    $db = new KonsumenUbahNama();
    $result = $db->setData($username, $nama_konsumen);
    $response = $result;
  }else{
    $response['status']= 404;
    $response['message']='Invalid Request...';
  }
  echo json_encode($response);
?>
