<?php
require_once realpath(dirname(__FILE__). '/..') .'/Model/KonsumenAntreanHapus.php';
  if($_SERVER['REQUEST_METHOD']=='POST'){
    $id_request = $_POST['id_request'];

    $db = new KonsumenAntreanHapus();
    $result = $db->hapusRequest($id_request);
    $response['status'] = $result;
  }else{
    $response['status']= 404;
    $response['message']='Invalid Request...';
  }
  echo json_encode($response);
?>
