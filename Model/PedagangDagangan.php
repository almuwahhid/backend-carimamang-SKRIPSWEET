<?php
/**
 * 29/06/2017
 */
class PedagangDagangan
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
  public function getData($username){

    if($this->auth->isLogin($username)){
      $stmt = $this->con->prepare("SELECT * FROM dagangan
                                    WHERE username_pedagang = ?");
      $stmt->bind_param("s",$username);
      $stmt->execute();
      $result = $stmt->get_result();
      if($result->num_rows>0){
        $this->respon["data"] = array();
        while($row = $result->fetch_assoc()){
          $data = array();
          $data["id_dagangan"] = $row["id_dagangan"];
          $data["nama_dagangan"] = $row["nama_dagangan"];
          $data["harga_dagangan"] = $row["harga_dagangan"];
          $data["keterangan"] = $row["keterangan"];
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
