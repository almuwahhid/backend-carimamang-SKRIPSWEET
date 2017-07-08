<?php
require_once realpath(dirname(__FILE__). '/..') .'/Model/KonsumenAntreanDetail.php';
  if($_SERVER['REQUEST_METHOD']=='POST'){
    $id_request = $_POST['id_request'];

    $db = new KonsumenAntreanDetail();
    $result = $db->ambilData($id_request);
    $response = $result;
  }else{
    $response['status']= 404;
    $response['message']='Invalid Request...';
  }
  echo json_encode($response);
?>
