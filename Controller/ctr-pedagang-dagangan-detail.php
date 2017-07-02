<?php
require_once realpath(dirname(__FILE__). '/..') .'/Model/PedagangDaganganDetail.php';
  if($_SERVER['REQUEST_METHOD']=='POST'){
    $username = $_POST['username'];
    $id_dagangan = $_POST['id_dagangan'];
    $db = new PedagangDaganganDetail();
    $result = $db->setData($username, $id_dagangan);
    $response = $result;
  }else{
    $response['status']= 404;
    $response['message']='Invalid Request...';
  }
  echo json_encode($response);
?>
