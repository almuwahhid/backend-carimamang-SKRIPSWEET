<?php
  require_once realpath(dirname(__FILE__). '/..') .'/Model/PedagangRegister.php';
  // require_once 'carimamang.tutorial-sourcecode.com/Model/PedagangModel.php';
  $response = array();
  if($_SERVER['REQUEST_METHOD']=='POST'){
    $name = $_POST['nama_pedagang'];
    $password = md5($_POST['password']);
    $username = $_POST['username'];
    $caption = $_POST['caption'];
    $token = $_POST['token'];
    $id_kategori = setId_kategori($_POST['kategori']);

    $db = new PedagangRegister();

    $result = $db->registerPedagang($username, $password, $name, $token, $id_kategori, $caption);
    if($result == "berhasil"){
       $response['error'] = 0;
       $response['message'] = 'Device registered successfully';
     }elseif($result == "dobel"){
       $response['error'] = 1;
       $response['message'] = 'Device already registered';
     }else{
       $response['error'] = 2;
       $response['message'] = $result;
     }
  }else{
    $response['error']= 404;
    $response['message']='Invalid Request...';
  }
  echo json_encode($response);

  function setId_kategori($data){
    switch ($data) {
      case 'Bakso':
        return 1;
        break;
      case 'Nasi Goreng':
        return 2;
        break;
      case 'Sayuran':
        return 3;
        break;
      case 'Camilan':
        return 4;
        break;
      case 'Minuman':
        return 5;
        break;
      case 'Lain Lain':
        return 6;
        break;
    }
  }
?>
