<?php
  class PedagangLogin{
    private $con;
    function __construct()
    {
        require_once realpath(dirname(__FILE__). '/..') . '/DbConnect.php';
        //require_once 'carimamang.tutorial-sourcecode.com/DbConnect.php';
        $db = new DbConnect();
        $this->con = $db->connect();
    }

    public function loginPedagang($username, $password){
      $stmt = $this->con->prepare("SELECT username_pedagang FROM pedagang WHERE username_pedagang = ? AND password_pedagang = ?");
      $stmt->bind_param("ss",$username, $password);
      $stmt->execute();
      $stmt->store_result();
      $num_rows = $stmt->num_rows;
      $stmt->close();
      return $num_rows > 0;
    }

    public function updateToken($username, $token){
      $stmt = $this->con->prepare("UPDATE pedagang SET
                          token_pedagang = ?
                          WHERE username_pedagang=?");
      $stmt->bind_param("ss", $token, $username);
      if($stmt->execute()){
        $stmt->close();
         return 1;
      }else{
        $stmt->close();
        return 0; //gagal
      }
    }
  }
?>
