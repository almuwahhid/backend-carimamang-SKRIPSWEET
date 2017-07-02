<?php
require_once realpath(dirname(__FILE__). '/..') .'/Model/PedagangDaganganTambah.php';
  if($_SERVER['REQUEST_METHOD']=='POST'){
    $username = $_POST['username'];
    $nama_dagangan = $_POST['nama_dagangan'];
    $harga_dagangan = $_POST['harga_dagangan'];
    $keterangan = $_POST['keterangan'];

    $db = new PedagangDaganganTambah();
    $result = $db->tambahDagangan($username, $nama_dagangan, $harga_dagangan, $keterangan);
    $response = $result;
  }else{
    $response['status']= 404;
    $response['message']='Invalid Request...';
  }
  echo json_encode($response);
?>
