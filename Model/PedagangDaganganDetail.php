<?php
/**
 * 29/06/2017
 */
class PedagangDaganganDetail
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
  public function setData($username, $id_dagangan){

    if($this->auth->isLogin($username)){
      $stmt = $this->con->prepare("DELETE FROM dagangan
                                    WHERE id_dagangan = ?");
      $stmt->bind_param("s",$id_dagangan);
      if($stmt->execute()){
        $stmt->close();
        $this->respon["status"] = 1;
      }else{
        $stmt->close();
        $this->respon["status"] = 2;
      }
    }else{
      $this->respon["status"] = 0;
    }
    return $this->respon;
  }
}

?>
