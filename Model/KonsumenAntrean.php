<?php
/**
 * 14/06/2017
 */
class KonsumenAntrean
{
  private $con;
  private $auth;
  public $respon = array();

  function __construct()
  {
    require_once realpath(dirname(__FILE__). '/..') . '/DbConnect.php';
    require_once realpath(dirname(__FILE__)) . '/Auth/AuthKonsumen.php';
    $db = new DbConnect();
    $this->con = $db->connect();
    $this->auth = new AuthKonsumen($this->con);
  }
  public function ambilData($username, $date){

    if($this->auth->isLogin($username)){
      $stmt = $this->con->prepare("SELECT * FROM request
                                    JOIN pedagang ON request.username_pedagang = pedagang.username_pedagang
                                    JOIN kategori_pedagang ON pedagang.id_kategori = kategori_pedagang.id_kategori
                                    WHERE username_konsumen = ?
                                    AND tanggal_req = ?");
      $stmt->bind_param("ss",$username, $date);
      $stmt->execute();
      $result = $stmt->get_result();
      if($result->num_rows>0){
        $this->respon["data"] = array();
        while($row = $result->fetch_assoc()){
          $data = array();
          $data["id_request"] = $row["id_request"];
          $data["username_pedagang"] = $row["username_pedagang"];
          $data["nama_pedagang"] = $row["nama_pedagang"];
          $data["waktu"] = $row["waktu_req"];
          $data["message"] = $row["pesan_req"];
          $data["status_req"] = $row["status_req"];
          $data["nama_kategori"] = $row["nama_kategori"];
          array_push($this->respon["data"], $data);
        }
        $this->respon["status"] = 1;
      }else{
        $this->respon["status"] = 2;
      }

      $stmt->close();
    }else{
      $this->respon["status"] = 3;
    }
    return $this->respon;
  }
}

?>
