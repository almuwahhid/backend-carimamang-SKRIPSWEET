<?php
require_once realpath(dirname(__FILE__). '/..') .'/Model/PedagangDagangan.php';
  if($_SERVER['REQUEST_METHOD']=='POST'){
    $username = $_POST['username'];
    $db = new PedagangDagangan();
    $result = $db->getData($username);
    $response = $result;
  }else{
    $response['status']= 404;
    $response['message']='Invalid Request...';
  }
  echo json_encode($response);
?>
