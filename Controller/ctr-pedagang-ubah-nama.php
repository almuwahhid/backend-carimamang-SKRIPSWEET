<?php
require_once realpath(dirname(__FILE__). '/..') .'/Model/PedagangUbahNama.php';
  if($_SERVER['REQUEST_METHOD']=='POST'){
    $username = $_POST['username'];
    $nama_pedagang = $_POST['nama_pedagang'];

    $db = new PedagangUbahNama();
    $result = $db->setData($username, $nama_pedagang);
    $response = $result;
  }else{
    $response['status']= 404;
    $response['message']='Invalid Request...';
  }
  echo json_encode($response);
?>
