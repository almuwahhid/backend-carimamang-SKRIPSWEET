<?php
require_once realpath(dirname(__FILE__). '/..') .'/Model/PedagangWaitingListDetail.php';
  if($_SERVER['REQUEST_METHOD']=='GET'){
    $id_request = $_GET['id_request'];
    $status = $_GET['status'];
    $message = $_GET['message'];

    $db = new PedagangWaitingListDetail();
    $result = $db->updateRequest($id_request, $status, $message);
    $response = $result;

  }else{
    $response['status']= 404;
    $response['message']='Invalid Request...';
  }
  echo json_encode($response);
?>
