<?php
/**
 * 14/06/2017
 */
class PedagangAntreanDetail
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

  public function updateRequest($id_req){
    $stmt = $this->con->prepare("UPDATE request SET
      status_req = 2
      WHERE id_request = ?");
      $stmt->bind_param("i", $id_req);
      if($stmt->execute()){
        $stmt->close();
        $this->respon["status"] = 1;
      }else{
        $this->respon["status"] = 0;
      }
    return $this->respon;
  }
}
?>
