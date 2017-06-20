<?php
  class KonsumenRegister{
    private $con;
    function __construct()
    {
        require_once realpath(dirname(__FILE__). '/..') . '/DbConnect.php';
        $db = new DbConnect();
        $this->con = $db->connect();
    }

    public function registerKonsumen($username, $password, $name, $token, $jk){
       if(!$this->isUsernameExist($username)){
         if($stmt = $this->con->prepare("INSERT INTO konsumen (username_konsumen, password_konsumen,
                                                            nama_konsumen, token_konsumen, jk)
                                                            VALUES (?,?,?,?,?)")){
            $stmt->bind_param("ssssi",$username, $password, $name, $token, $jk);
            if($stmt->execute()){
               return "berhasil";
      			}else{
      				return $this->con->error." ini ".$username; //gagal
      			}
         }
       }else{
         return "dobel";
       }
    }

    private function isUsernameExist($username){
        $stmt = $this->con->prepare("SELECT username_konsumen FROM konsumen WHERE username_konsumen = ?");
        $stmt->bind_param("s",$username);
        $stmt->execute();
        $stmt->store_result();
        $num_rows = $stmt->num_rows;
        $stmt->close();
        return $num_rows > 0;
    }
  }
?>
