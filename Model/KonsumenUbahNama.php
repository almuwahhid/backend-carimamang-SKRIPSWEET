<?php
/**
 * 30/06/2017
 */
class KonsumenUbahNama
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
  public function setData($username, $nama_konsumen){
    if($this->auth->isLogin($username)){
      $stmt = $this->con->prepare("UPDATE konsumen SET
        nama_konsumen = ?
        WHERE username_konsumen=?");
        $stmt->bind_param("ss", $nama_konsumen, $username);
        if($stmt->execute()){
          $stmt->close();
          $this->respon["status"] = 1;
        }else{
          $stmt->close();
          $this->respon["status"] = 0;
        }
      }else{
        $this->respon["status"] = 2;
      }
      return $this->respon;
    }
}
?>
