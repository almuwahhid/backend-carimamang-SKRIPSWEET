<?php
/**
 * 30/06/2017
 */
class PedagangUbahNama
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
  public function setData($username, $nama_pedagang){
    if($this->auth->isLogin($username)){
      $stmt = $this->con->prepare("UPDATE pedagang SET
        nama_pedagang = ?
        WHERE username_pedagang=?");
        $stmt->bind_param("ss", $nama_pedagang, $username);
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
