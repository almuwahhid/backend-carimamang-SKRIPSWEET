<?php
  /**
   * 20/06/2017
   */
  class KonsumenRequest
  {
    private $con;
    private $auth;
    function __construct()
    {
      require_once realpath(dirname(__FILE__). '/..') . '/DbConnect.php';
      require_once realpath(dirname(__FILE__)) . '/Auth/AuthPedagang.php';
      $db = new DbConnect();
      $this->con = $db->connect();
      $this->auth = new AuthPedagang($this->con);
    }

    function setRequest($username, $data){
      if($stmt = $this->con->prepare("INSERT INTO request (username_konsumen, username_pedagang,
                                                         tanggal_req, pesan_req, status_req,
                                                         lattitude_konsumen, longitude_konsumen,
                                                         waktu_req)
                                                         VALUES (?,?,?,?,0,?,?,?)")){
        $stmt->bind_param("ssssdds",$data["username_konsumen"], $data["username_pedagang"], $data["tanggal_req"], $data["pesan_req"], $data["lattitude_konsumen"], $data["longitude_konsumen"], $data["waktu_req"]);
        if($stmt->execute()){
           return "berhasil";
        }else{
          return $this->con->error." ini ".$username; //gagal
        }
      }
    }

    function getTokenByUsername($username){
      $stmt = $this->con->prepare("SELECT token_pedagang FROM pedagang WHERE username_pedagang = ?");
      $stmt->bind_param("s",$username);
      $stmt->execute();
      $result = $stmt->get_result()->fetch_assoc();
      return array($result['token_pedagang']);
    }
  }

?>
