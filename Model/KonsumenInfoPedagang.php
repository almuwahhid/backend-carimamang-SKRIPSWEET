<?php
/**
 * 14/06/2017
 */
class KonsumenInfoPedagang
{
  private $con;
  private $auth;
  public $respon = array();

  function __construct()
  {
    require_once realpath(dirname(__FILE__). '/..') . '/DbConnect.php';
    $db = new DbConnect();
    $this->con = $db->connect();
  }
  public function ambilData($username){
    $stmt = $this->con->prepare("SELECT * FROM pedagang
                                  JOIN kategori_pedagang ON pedagang.id_kategori = kategori_pedagang.id_kategori
                                  WHERE username_pedagang = ?");
    $stmt->bind_param("s",$username);
    $stmt->execute();
    $result = $stmt->get_result();
    if($result->num_rows>0){
      while($row = $result->fetch_assoc()){
        $this->respon["username_pedagang"] = $row["username_pedagang"];
        $this->respon["nama_pedagang"] = $row["nama_pedagang"];
        $this->respon["caption"] = $row["caption"];
        $this->respon["nama_kategori"] = $row["nama_kategori"];
      }
      $this->respon["status"] = 1;
    }else{
      $this->respon["status"] = 2;
    }

    $stmt->close();
    return $this->respon;
  }
}

?>
