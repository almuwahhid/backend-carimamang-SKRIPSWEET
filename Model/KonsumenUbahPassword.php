<?php
/**
 * 30/06/2017
 */
class KonsumenUbahPassword
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
  public function setData($username, $password, $pwlama){
    if($this->auth->isLogin($username) && $this->isPasswordExist($username, $pwlama)){
      $stmt = $this->con->prepare("UPDATE konsumen SET
        password_konsumen = ?
        WHERE username_konsumen=?");
        $stmt->bind_param("ss", $password, $username);
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
    private function isPasswordExist($username, $password){
        $stmt = $this->con->prepare("SELECT password_konsumen FROM konsumen WHERE username_konsumen = ? AND password_konsumen =?");
        $stmt->bind_param("ss",$username, $password);
        $stmt->execute();
        $stmt->store_result();
        $num_rows = $stmt->num_rows;
        $stmt->close();
        return $num_rows > 0;
    }
}
?>
