<?php
  class PedagangRegister{
    private $con;
    function __construct()
    {
        require_once realpath(dirname(__FILE__). '/..') . '/DbConnect.php';
        //require_once 'carimamang.tutorial-sourcecode.com/DbConnect.php';
        $db = new DbConnect();
        $this->con = $db->connect();
    }

    public function registerPedagang($username, $password, $name, $token, $idkategori, $caption){
       if(!$this->isUsernameExist($username)){
         if($stmt = $this->con->prepare("INSERT INTO pedagang (username_pedagang, password_pedagang,
                                                            nama_pedagang, token_pedagang,
                                                            id_kategori, caption, status_lokasi, status_dagang
                                                          ) VALUES (?,?,?,?,?,?,0,0)")){
            $stmt->bind_param("ssssis",$username, $password, $name, $token, $idkategori, $caption);
            if($stmt->execute()){
               return "berhasil"; //sukses
      			}else{
      				// printf("Errormessage: %s\n", $this->con->error);
      				return $this->con->error." ini ".$username; //gagal
      			}
         }
       }else{
         return "dobel"; //udah ada data
       }
    }

    private function isUsernameExist($username){
        $stmt = $this->con->prepare("SELECT username_pedagang FROM pedagang WHERE username_pedagang = ?");
        $stmt->bind_param("s",$username);
        $stmt->execute();
        $stmt->store_result();
        $num_rows = $stmt->num_rows;
        $stmt->close();
        return $num_rows > 0;
    }
  }
?>
