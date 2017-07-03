<?php
require_once realpath(dirname(__FILE__). '/..') .'/Model/PedagangAntreanDetail.php';
  if($_SERVER['REQUEST_METHOD']=='POST'){
    $id_request = $_POST['id_request'];

    $db = new PedagangAntreanDetail();
    $result = $db->updateRequest($id_request);
    $response = $result;

  }else{
    $response['status']= 404;
    $response['message']='Invalid Request...';
  }
  echo json_encode($response);
?>
