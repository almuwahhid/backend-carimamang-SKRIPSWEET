<?php
  require_once realpath(dirname(__FILE__). '/..') .'/Model/KonsumenRegister.php';
  // require_once 'carimamang.tutorial-sourcecode.com/Model/PedagangModel.php';
  $response = array();
  if($_SERVER['REQUEST_METHOD']=='GET'){
    $username = $_GET['username'];
    $password = md5($_GET['password']);
    $name = $_GET['nama_konsumen'];
    $token = $_GET['token'];
    $jk = setJK($_GET['jk']);

    $db = new KonsumenRegister();

    $result = $db->registerKonsumen($username, $password, $name, $token, $jk);
    if($result == "berhasil"){
       $response['status'] = 1;
       $response['message'] = 'Device registered successfully';
     }elseif($result == "dobel"){
       $response['status'] = 2;
       $response['message'] = 'Device already registered';
     }else{
       $response['status'] = 0;
       $response['message'] = $result;
     }
  }else{
    $response['error']= 404;
    $response['message']='Invalid Request...';
  }
  echo json_encode($response);


  function setJK($data){
    switch ($data) {
      case 'Laki - Laki':
        return 1;
        break;
      case 'Perempuan':
        return 2;
        break;
    }
  }
?>
