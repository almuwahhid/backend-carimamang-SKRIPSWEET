<?php
/**
 * 14/06/2017
 */
class PedagangWaitingList
{
  private $con;
  private $auth;
  public $respon = array();

  function __construct()
  {
    require_once realpath(dirname(__FILE__). '/..') . '/DbConnect.php';
    require_once realpath(dirname(__FILE__)) . '/Auth/AuthPedagang.php';
    $db = new DbConnect();
    $this->con = $db->connect();
    $this->auth = new AuthPedagang($this->con);
  }
  public function getData($username, $date){

    if($this->auth->isLogin($username)){
      $stmt = $this->con->prepare("SELECT * FROM request
                                    JOIN konsumen ON request.username_konsumen = konsumen.username_konsumen
                                    WHERE username_pedagang = ?
                                    AND tanggal_req = ?
                                    AND status_req = 0");
      $stmt->bind_param("ss",$username, $date);
      $stmt->execute();
      $result = $stmt->get_result();
      $this->respon["data"] = array();
      while($row = $result->fetch_assoc()){
          $data = array();
          $data["id_request"] = $row["id_request"];
          $data["nama_konsumen"] = $row["nama_konsumen"];
          $data["lat"] = $row["lattitude_konsumen"];
          $data["lng"] = $row["longitude_konsumen"];
          $data["message"] = $row["pesan_req"];
          $data["waktu"] = $row["waktu_req"];
          array_push($this->respon["data"], $data);
      }
      $this->respon["status"] = 1;
      $stmt->close();
    }else{
      $this->respon["status"] = 2;
    }
    return $this->respon;
  }
}

?>
